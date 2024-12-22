<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Cars</title>
    <link rel="stylesheet" href="../assets/css/mercedes.css">
    <link rel="stylesheet" href='../assets\css\navbar.css'>
</head>
<body>
<?php include('../includes/navbar.php'); ?>

    <!-- Main Content -->
    <div class="car-container">
        <h1>BMW Cars</h1>
        <div class="cars">
            <?php
            // Include the controller to fetch the car data
            require_once '../controllers/BmwController.php';

            // Instantiate the controller and fetch the car details
            $bmwController = new BmwController();
            $cars = $bmwController->getBmwCars(); // Get the list of BMW cars

            // Check if cars data is available
            if (!empty($cars)) {
                // Loop through the cars and display the data
                foreach ($cars as $car) {
                    echo '<div class="car">';
                    // Display the image with .jpg extension
                    $imagePath = htmlspecialchars($car['img']); // Assuming the image field stores the image name (e.g., 'image.jpg')
                    echo '<img src="../assets/carimages/' . $imagePath . '" alt="' . htmlspecialchars($car['model']) . '">'; // Adjust image path if necessary
                    echo '<h2>' . htmlspecialchars($car['model']) . '</h2>';
                    echo '<p>Manufacture Year: ' . htmlspecialchars($car['manufacture_year']) . '</p>';
                    echo '<p>Price: $' . number_format($car['price'], 2) . '</p>';
                    echo '<button class="add-to-cart">Purchase</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No BMW cars found in the database.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p><strong>About Us</strong></p>
            <p>Welcome to House of Motors, where we provide the best cars and car parts for our customers.</p>
            <p><strong>Contact Us:</strong></p>
            <p>Email: <a href="mailto:houseofmotors@gmail.com">houseofmotors@gmail.com</a></p>
            <p>Phone: +201017057756</p>
        </div>
    </footer>
</body>
</html>
