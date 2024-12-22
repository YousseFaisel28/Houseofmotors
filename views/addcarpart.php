<?php
require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partDescription = $_POST['part_description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $partImage = $_FILES['part_image'];

    // Upload the image
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($partImage['name']);
    move_uploaded_file($partImage['tmp_name'], $uploadFile);

    // Add car part
    $result = $adminController->addCarPart($partDescription, $price, $stock, $category, $uploadFile);

    if ($result) {
        echo '<p>Car part added successfully!</p>';
    } else {
        echo '<p>Error adding car part.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Part</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <a href="Productmanger.php" class="back-btn">Back to Manage Car Parts</a>
    <h1>Add Car Part</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="part_description">Part Description:</label>
        <input type="text" id="part_description" name="part_description" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>
        
        <label for="part_image">Part Image:</label>
        <input type="file" id="part_image" name="part_image" required>
        
        <button type="submit">Add Car Part</button>
    </form>
</body>
</html>
