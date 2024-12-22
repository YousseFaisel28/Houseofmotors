<?php
require_once '../controllers/AdminController.php'; // Include the AdminController

// Create an instance of the AdminController
$adminController = new AdminController();

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $car = $adminController->getCarById($car_id); // Fetch car details by ID

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission for editing
        $model = $_POST['model'];
        $manufacture_year = $_POST['manufacture_year'];
        $price = $_POST['price'];
        $image = $_FILES['img']['name'];

        // Move the uploaded image to the "images" folder if a new image is uploaded
        if ($image) {
            $target = '../images/' . basename($image);
            move_uploaded_file($_FILES['img']['tmp_name'], $target);
            $adminController->editCar($car_id, $model, $manufacture_year, $price, $image);
        } else {
            $adminController->editCar($car_id, $model, $manufacture_year, $price);
        }

        header('Location: BmwView.php'); // Redirect back to the BMW management page after editing
        exit();
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
    <title>Edit BMW Car</title>
    <link rel="stylesheet" href="../assets/css/manageuser.css">
</head>
<body>
    <a href="BmwView.php" class="back-btn">Back to BMW Cars</a>
    <div class="form-container">
        <h1>Edit BMW Car</h1>
        <form action="editCar.php?id=<?php echo $car['car_id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="model">Model:</label>
            <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>

            <label for="manufacture_year">Manufacture Year:</label>
            <input type="number" name="manufacture_year" id="manufacture_year" value="<?php echo htmlspecialchars($car['manufacture_year']); ?>" required>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($car['price']); ?>" required>

            <label for="img">Car Image (Leave empty if no change):</label>
            <input type="file" name="img" id="img" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
