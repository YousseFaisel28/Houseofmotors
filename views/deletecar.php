<?php
require_once '../controllers/AdminController.php'; // Include the AdminController

// Create an instance of the AdminController
$adminController = new AdminController();

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Call delete method in controller
    if ($adminController->deleteCar($car_id)) {
        header('Location: BmwView.php'); // Redirect back to the BMW management page after deletion
        exit();
    } else {
        echo "Error deleting the car.";
    }
} else {
    echo "Car ID not specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete BMW Car</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <a href="BmwView.php" class="back-btn">Back to BMW Cars</a>
    <div class="confirmation-container">
        <h1>Are you sure you want to delete this BMW car?</h1>
        <form action="deleteCar.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <button type="submit">Yes, Delete</button>
        </form>
        <a href="BmwView.php">Cancel</a>
    </div>
</body>
</html>
