<?php
session_start();


require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Check if 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Call the controller's deleteUser method to delete the user
    $result = $adminController->deleteUser($userId);

    if ($result) {
        // Redirect to manage users page with a success message
        echo "<script>alert('User deleted successfully!'); window.location.href='manageuser.php';</script>";
    } else {
        // Error message if something goes wrong
        echo "<script>alert('Error deleting user.'); window.location.href='manageuser.php';</script>";
    }
} else {
    // If no 'id' is provided, redirect to the manage users page
    echo "<script>alert('Invalid request!'); window.location.href='manageuser.php';</script>";
}
?>
