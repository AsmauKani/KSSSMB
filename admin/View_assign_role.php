<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Roles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Assigned Roles</h1>
        <?php
        // Check if the school name and roles are set in the session
        if (isset($_SESSION['school_name']) && isset($_SESSION['principal']) && isset($_SESSION['vice_principal']) && isset($_SESSION['exam_officer'])) {
            $school_name = $_SESSION['school_name'];
            $principal = $_SESSION['principal'];
            $vice_principal = $_SESSION['vice_principal'];
            $exam_officer = $_SESSION['exam_officer'];

            echo "<h2>$school_name</h2>";
            echo "<table>";
            echo "<tr><th>Role</th><th>Staff Member</th></tr>";
            echo "<tr><td>Principal</td><td>$principal</td></tr>";
            echo "<tr><td>Vice Principal</td><td>$vice_principal</td></tr>";
            echo "<tr><td>Exam Officer</td><td>$exam_officer</td></tr>";
            echo "</table>";
        } else {
            echo "<p>No roles have been assigned yet.</p>";
        }
        ?>
    </div>
</body>
</html>
