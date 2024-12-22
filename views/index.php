<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House of Motors</title>
    <link rel="stylesheet" href='../assets\css\homepage.css'>
    <link rel="stylesheet" href='../assets\css\navbar.css'> 
    

</head>
<body>
<?php include('../includes/navbar.php'); ?>
    <!-- Background Video Section -->
    <div class="hero-section">
        <video autoplay muted loop class="background-video">
            <!-- Video file path -->
            <source src="../assets/vedios/BMW M3 G80 _ CAP CUT _ CAR EDIT _ 4K (1080p60).mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="hero-content">
            <h1>We are the best car dealer you will find.</h1>
            <div class="hero-buttons">
                <!-- Updated link to cars.php -->
                <a href="cars.php" class="btn-primary">View Our Cars</a>
                <a href="products.php" class="btn-secondary">Product</a>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
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
