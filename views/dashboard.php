<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

    <h1>Welcome, Admin</h1>
    <div class="container">
        <a href="manageuser.php">Manage Users</a>
        <a href="choosecartomanage.php">Manage Cars</a>
        <a href="Productmanager.php">Manage Products</a> <!-- Added Manage Products link -->
        <a href="Home.php">Logout</a>
    </div>

</body>
</html>

