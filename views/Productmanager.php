<?php
require_once '../controllers/AdminController.php';

// Initialize AdminController
$adminController = new AdminController();

// Fetch car parts using the public method
$carParts = $adminController->getAllCarParts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Car Parts</title>
    <link rel="stylesheet" href="../assets/css/ManageUser.css">
</head>
<body>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <div class="carparts-management">
        <h1>Manage Car Parts</h1>
        <a href="addcarpart.php" class="add-carpart-btn">Add New Car Part</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Part Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($carParts)) {
                    foreach ($carParts as $part) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($part['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($part['part_description']) . '</td>';
                        echo '<td>' . htmlspecialchars($part['price']) . '</td>';
                        echo '<td>' . htmlspecialchars($part['stock']) . '</td>';
                        echo '<td>' . htmlspecialchars($part['category']) . '</td>';
                        echo '<td><img src="' . htmlspecialchars($part['part_image']) . '" alt="Part Image" width="50"></td>';
                        echo '<td>';
                        echo '<a href="editcarpart.php?id=' . $part['id'] . '" class="edit-btn">Edit</a>';
                        echo '<a href="deletecarpart.php?id=' . $part['id'] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this part?\')">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No car parts found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
