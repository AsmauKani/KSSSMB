<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit(); // Add an exit to stop further execution
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $school_name = $_POST['school_name'];
        $principal = $_POST['principal'];
        $vice_principal = $_POST['vice_principal'];
        $exam_officer = $_POST['exam_officer'];

        // Store assigned roles and school name in session variables
        $_SESSION['school_name'] = $school_name;
        $_SESSION['principal'] = $principal;
        $_SESSION['vice_principal'] = $vice_principal;
        $_SESSION['exam_officer'] = $exam_officer;
        
        // Bind parameters
        $query = $dbh->prepare("INSERT INTO assign_role (school_name, principal, vice_principal, exam_officer) VALUES (:school_name, :principal, :vice_principal, :exam_officer)");
        $query->bindParam(':school_name', $school_name, PDO::PARAM_STR);
        $query->bindParam(':principal', $principal, PDO::PARAM_STR);
        $query->bindParam(':vice_principal', $vice_principal, PDO::PARAM_STR);
        $query->bindParam(':exam_officer', $exam_officer, PDO::PARAM_STR);
        
        
        // Execute query
        $query->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Roles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Assign Roles</h1>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
            <h2>Assigned Roles</h2>
            <h3><?php echo $_SESSION['school_name']; ?></h3>
            <p>Principal: <?php echo $_SESSION['principal']; ?></p>
            <p>Vice Principal: <?php echo $_SESSION['vice_principal']; ?></p>
            <p>Exam Officer: <?php echo $_SESSION['exam_officer']; ?></p>
        <?php else: ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="school_name">School Name:</label>
                <input type="text" id="school_name" name="school_name" required>

                <label for="principal">Principal:</label>
                <input type="text" id="principal" name="principal" required>

                <label for="vice_principal">Vice Principal:</label>
                <input type="text" id="vice_principal" name="vice_principal" required>

                <label for="exam_officer">Exam Officer:</label>
                <input type="text" id="exam_officer" name="exam_officer" required>

                <button type="submit" name="submit">Assign Roles</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
