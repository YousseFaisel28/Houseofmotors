<?php
require_once '../controllers/AdminController.php'; // Include the controller

// Create an instance of the controller
$adminController = new AdminController();

// Fetch all cars using the controller's method
$cars = $adminController->getAllCars();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Cars</title>
    <link rel="stylesheet" href="../assets/css/manageuser.css">
</head>
<body>
    <!-- Back Button -->
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>

    <div class="car-management">
        <h1>Manage BMW Cars</h1>
        <table>
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Model</th>
                    <th>Manufacture Year</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($cars)) {
                    foreach ($cars as $car) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($car['car_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($car['model']) . '</td>';
                        echo '<td>' . htmlspecialchars($car['manufacture_year']) . '</td>';
                        echo '<td>' . htmlspecialchars($car['price']) . '</td>';
                        echo '<td><img src="../images/' . htmlspecialchars($car['img']) . '" alt="Car Image" width="100"></td>';
                        echo '<td>';
                        echo '<a href="editcar.php?id=' . $car['car_id'] . '" class="edit-btn">Edit</a>';
                        echo '<a href="deletecar.php?id=' . $car['car_id'] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this car?\')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No cars found.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Add Car Button -->
        <div class="add-car-btn-container">
            <a href="addcar.php" class="add-car-btn">Add New Car</a>
        </div>
    </div>
</body>
</html>
