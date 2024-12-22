<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mclaren cars</title>
    <link rel="stylesheet" href="../assets/css/mercedes.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar">
        <div class="logo">house<span class="highlight">ofmotors</span></div>
        <ul class="nav-links">
            <li><a href="index.php">home</a></li>
            <li><a href="cars.php" class="nav-link">cars</a></li>
            <li><a href="products.php" class="nav-link">car parts</a></li>
        </ul>
        <a href="home.php" class="btn">logout</a>
    </nav>

    <!-- main content -->
    <div class="car-container">
        <h1>mclaren cars</h1>
        <div class="cars">
            <?php
            // include the controller to fetch the car data
            require_once '../controllers/maclarencontroller.php';

            // instantiate the controller and fetch the car details
            $mclarencontroller = new mclarencontroller();
            $cars = $mclarencontroller->getmclarenCars(); // get the list of mclaren cars

            // check if cars data is available
            if (!empty($cars)) {
                // loop through the cars and display the data
                foreach ($cars as $car) {
                    echo '<div class="car">';
                    // display the image with .jpg extension
                    $imagePath = htmlspecialchars($car['img']); // assuming the image field stores the image name (e.g., 'image.jpg')
                    echo '<img src="../assets/carimages/' . $imagePath . '" alt="' . htmlspecialchars($car['model']) . '">'; // adjust image path if necessary
                    echo '<h2>' . htmlspecialchars($car['model']) . '</h2>';
                    echo '<p>manufacture year: ' . htmlspecialchars($car['manufacture_year']) . '</p>';
                    echo '<p>price: $' . number_format($car['price'], 2) . '</p>';
                    echo '<button class="add-to-cart">Purchase</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>no mclaren cars found in the database.</p>';
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="footer-content">
            <p><strong>about us</strong></p>
            <p>welcome to house of motors, where we provide the best cars and car parts for our customers.</p>
            <p><strong>contact us:</strong></p>
            <p>email: <a href="mailto:houseofmotors@gmail.com">houseofmotors@gmail.com</a></p>
            <p>phone: +201017057756</p>
        </div>
    </footer>
</body>
</html>