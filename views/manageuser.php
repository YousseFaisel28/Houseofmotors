<?php
require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Fetch users using the public method
$users = $adminController->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/manageuser.css">
</head>
<body>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <div class="user-management">
        <h1>Manage Users</h1>
        <a href="adduser.php" class="add-user-btn">Add New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($users)) {
                    foreach ($users as $user) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($user['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                        echo '<td>';
                        echo '<a href="edituser.php?id=' . $user['id'] . '" class="edit-btn">Edit</a>';
                        echo '<a href="deleteuser.php?id=' . $user['id'] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No users found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
