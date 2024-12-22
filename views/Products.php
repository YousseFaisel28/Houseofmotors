<?php
require_once '../controllers/CartController.php';

$error = '';
$controller = new CartController();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
//     // $name = $_POST['name'] ?? '';
//     // $email = $_POST['email'] ?? '';
//     // $password = $_POST['password'] ?? '';
//         // $conn = $this->db->getConnection(); // Get the connection from Database

//         // Check if email already exists
//         $stmt = $conn->prepare("SELECT id FROM users WHERE name = ?"); // Use prepare from the connection object
//         $stmt->bind_param("s", $_SESSION["name"]); // Bind the email parameter
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $row = $result->fetch_assoc();
//         $id = $row['id'];
//     // $_user_id=$_SESSION["userid"];
//     $error = $controller->addToCart($id,1,1);
  
// }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Parts</title>
        <link rel="stylesheet" href="../assets/css/product.css"> <!-- Make sure to create/modify a specific CSS file for car parts if needed -->
    </head>
    <body>
    <?php include('../includes/navbar.php'); ?>


        <!-- Main Content -->
        <div class="car-container">
            <h1>Our Car Parts</h1>
        <form method="post" action="test.php?id=<?php echo $part['part_name'] ?>">
            <div class="products">
                <?php
                // Include the controller to fetch the car parts data
                require_once '../controllers/ProductsController.php';

                // Instantiate the controller and fetch the car parts details
                $productsController = new ProductsController();
                $carParts = $productsController->getAllCarParts(); // Get the list of car parts

                // Check if car parts data is available
                if (!empty($carParts)) {
                    // Loop through the car parts and display the data
                    foreach ($carParts as $part) {
                        echo '<div class="product">';
                        // Display the image with .jpg extension
                        $imagePath = htmlspecialchars($part['part_image']); // Assuming the image field stores the image name (e.g., 'image.jpg')
                        echo '<img src="../assets/carimages/' . $imagePath . '" alt="' . htmlspecialchars($part['part_name']) . '">'; // Adjust image path if necessary
                        echo '<h2>' . htmlspecialchars($part['part_name']) . '</h2>';
                        echo '<p>' . htmlspecialchars($part['part_description']) . '</p>';
                        echo '<p>Price: $' . number_format($part['price'], 2) . '</p>';
                        echo '<a class="add-to-cart" href="cart.php?id='.$part['id'].'">Add to Cart</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No car parts found in the database.</p>';
                }
                ?>
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
