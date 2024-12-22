
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Parts</title>
    <link rel="stylesheet" href="../assets/css/product.css"> <!-- Make sure to create/modify a specific CSS file for car parts if needed -->
</head>
<body>
<?php include('../includes/navbar.php'); 

session_start();
?>
    <!-- Main Content -->
    <div class="car-container">
        <h1>Our Car Parts</h1>
       <form method="post" action="test.php?id=<?php echo $part['part_name'] ?>">
        <div class="products">
            <?php
            // Include the controller to fetch the car parts data
         
         /////////total//////////////
            echo $_SESSION['checkout'];
            
    ?>
        <a href = "emptyCart.php">Cash</a>
        <a href = '#'>Installments</a>
        </div>
        </form>
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
