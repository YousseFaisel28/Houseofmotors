<?php
session_start();



require_once '../controllers/AdminController.php';
$controller = new AdminController();

// Fetch user details based on 'id' from the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch the user data using the controller
    $user = $controller->getAllUsers(); // Get all users to find the matching one
    $userDetails = null;
    foreach ($user as $u) {
        if ($u['id'] == $userId) {
            $userDetails = $u;
            break;
        }
    }

    if (!$userDetails) {
        echo "<script>alert('User not found!'); window.location.href='manageuser.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='manageuser.php';</script>";
    exit();
}

// Handle form submission for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // If password is empty, pass the existing password to the controller method
    if (empty($password)) {
        // Retain the existing password from the user details
        $password = null;
    }

    // Call the controller's editUser method
    $result = $controller->editUser($userId, $name, $email, $password);
    
    // Handle success or failure
    if ($result) {
        echo "<script>alert('User updated successfully!'); window.location.href='manageuser.php';</script>";
    } else {
        echo "<script>alert('Error updating user!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/adduser.css">
</head>
<body>

    <!-- Back Button -->
    <a href="manageuser.php" class="back-btn">Back to Manage Users</a>

    <!-- Form Container -->
    <div class="form-container">
        <h1>Edit User</h1>

        <!-- Edit User Form -->
        <form method="POST" action="edituser.php?id=<?= htmlspecialchars($userDetails['id']) ?>">
            <!-- Name Field -->
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($userDetails['name']) ?>" required>
            </div>

            <!-- Email Field -->
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userDetails['email']) ?>" required>
            </div>

            <!-- Password Field (Optional, leave empty to keep current) -->
            <div class="form-control">
                <label for="password">Password (Leave empty to keep current)</label>
                <input type="password" id="password" name="password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Update User</button>
        </form>
    </div>

</body>
</html>
