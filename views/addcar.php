<?php
require_once '../controllers/AdminController.php'; // Include the AdminController

// Create an instance of the AdminController
$adminController = new AdminController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
    $model = $_POST['model'];
    $manufacture_year = $_POST['manufacture_year'];
    $price = $_POST['price'];
    $image = $_FILES['img']['name'];

    // Move the uploaded image to the "images" folder
    $target = '../images/' . basename($image);
    move_uploaded_file($_FILES['img']['tmp_name'], $target);

    // Add the car to the database
    $adminController->addCar($model, $manufacture_year, $price, $image);
    header('Location: BmwView.php'); // Redirect back to the BMW management page after adding
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add BMW Car</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <a href="BmwView.php" class="back-btn">Back to BMW Cars</a>
    <div class="form-container">
        <h1>Add New BMW Car</h1>
        <form action="addCar.php" method="POST" enctype="multipart/form-data">
            <label for="model">Model:</label>
            <input type="text" name="model" id="model" required>

            <label for="manufacture_year">Manufacture Year:</label>
            <input type="number" name="manufacture_year" id="manufacture_year" required>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>

            <label for="img">Car Image:</label>
            <input type="file" name="img" id="img" accept="image/*" required>

            <button type="submit">Add Car</button>
        </form>
    </div>
</body>
</html>
