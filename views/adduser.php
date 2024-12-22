<?php
require_once '../controllers/AdminController.php';

// Initialize the AdminController
$adminController = new AdminController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the addUser method
    $result = $adminController->addUser($name, $email, $password);

    // Check the result and show a success or error message
    if (is_array($result) && $result['success']) {
        echo "<script>alert('User added successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        $errorMessage = is_array($result) ? $result['message'] : 'Unexpected error occurred.';
        echo "<script>alert('Error: {$errorMessage}');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../assets/css/adduser.css">
</head>
<body>

    <!-- Back Button -->
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>

    <!-- Form Container -->
    <div class="form-container">
        <h1>Add User</h1>

        <!-- Add User Form -->
        <form method="POST" action="">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Add User</button>
        </form>
    </div>

</body>
</html>
