<?php
require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Get car part ID from query parameters
$carPartId = $_GET['id'];

// Delete car part
$result = $adminController->deleteCarPart($carPartId);

if ($result) {
    echo '<p>Car part deleted successfully!</p>';
    header('Location: managecarparts.php');
    exit;
} else {
    echo '<p>Error deleting car part.</p>';
}
?>


