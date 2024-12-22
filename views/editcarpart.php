<?php
require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Get car part ID from query parameters
$carPartId = $_GET['id'];
$carPart = $adminController->getCarPartById($carPartId);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partDescription = $_POST['part_description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $partImage = $_FILES['part_image'];

    // Handle image upload if a new image is provided
    $uploadFile = $carPart['part_image'];
    if (!empty($partImage['name'])) {
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . basename($partImage['name']);
        move_uploaded_file($partImage['tmp_name'], $uploadFile);
    }

    // Update car part
    $result = $adminController->editCarPart($carPartId, $partDescription, $price, $stock, $category, $uploadFile);

    if ($result) {
        echo '<p>Car part updated successfully!</p>';
    } else {
        echo '<p>Error updating car part.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Part</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <a href="Productmanager.php" class="back-btn">Back to Manage Car Parts</a>
    <h1>Edit Car Part</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="part_description">Part Description:</label>
        <input type="text" id="part_description" name="part_description" value="<?= htmlspecialchars($carPart['part_description']) ?>" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($carPart['price']) ?>" required>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($carPart['stock']) ?>" required>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($carPart['category']) ?>" required>
        
        <label for="part_image">Part Image:</label>
        <input type="file" id="part_image" name="part_image">
        <img src="<?= htmlspecialchars($carPart['part_image']) ?>" alt="Current Image" width="100">
        
        <button type="submit">Update Car Part</button>
    </form>
</body>
</html>
