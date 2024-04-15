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
        <h1>Assigned Roles</h1>
        <?php
        // Retrieve selected roles from the form
        $principal = $_POST['principal'];
        $vice_principal = $_POST['vice_principal'];

        // Display assigned roles
        echo "<p>Principal: $principal</p>";
        echo "<p>Vice Principal: $vice_principal</p>";
        ?>
    </div>
</body>
</html>
