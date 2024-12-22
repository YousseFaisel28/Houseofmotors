<?php
require_once '../controllers/CartController.php';
require_once '../database/Dbh.php'; // Include the Database class
$db = new Database();
$error = '';
$controller = new CartController();
session_start();
$conn = $db->getConnection(); // Get the connection from Database
if(isset($_GET['id'])){

    $product_id=$_GET['id'];
         // $name = $_POST['name'] ?? '';
    // $email = $_POST['email'] ?? '';
    // $password = $_POST['password'] ?? '';
        $tet=$_SESSION['name'];
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE name = ?"); // Use prepare from the connection object
        $stmt->bind_param("s", $tet); // Bind the email parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    // $id = $row['id'];
    // $_user_id=$_SESSION["userid"];
    $_SESSION['userid']=$row['id'];
     $error = $controller->addToCart($row['id'],$product_id,1);

}


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
       <form method="post" action="test.php?id=<?php echo $part['part_name'] ?>">
        <div class="products">
            <?php
            // Include the controller to fetch the car parts data
            require_once '../controllers/ProductsController.php';

            // Instantiate the controller and fetch the car parts details
        
        
                // Instantiate the controller and fetch the car parts details
                $productsController = new ProductsController();
                $carParts = $productsController->getAllCarParts(); // Get the list of car parts
                $userid=$_SESSION['userid'];
                $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?"); // Use prepare from the connection object

                $stmt->bind_param("s", $userid); // Bind the email parameter
                $stmt->execute();
                $result = $stmt->get_result();
                // $row = $result->fetch_assoc();
                $checkout_total=0;
                while($row = $result->fetch_assoc()){
                        
                    $stmtt = $conn->prepare("select * from carparts where id = ?");
                    $stmtt->bind_param("s", $row['product_id']); // Bind the email parameter
                    $stmtt->execute();
                    $resultt = $stmtt->get_result();
                    $row2 = $resultt->fetch_assoc();
                    echo '<div class="product">';
                    // Display the image with .jpg extension
                    $imagePath = htmlspecialchars($row2['part_image']); // Assuming the image field stores the image name (e.g., 'image.jpg')
                    echo '<img src="../assets/carimages/' . $imagePath . '" alt="' . htmlspecialchars($row2['part_name']) . '">'; // Adjust image path if necessary
                    echo '<h2>' . htmlspecialchars($row2['part_name']) . '</h2>';
                    echo '<p>' . htmlspecialchars($row2['part_description']) . '</p>';
                    echo '<p>Price: $' . number_format($row2['price'], 2) . '</p>';
                    echo '<p>Quantity: ' . htmlspecialchars($row['quantity']) . '</p>';
                    echo '<a class="add-to-cart" href="DeleteCartProduct.php?id='.$row['product_id'].'">Delete Product</a>';
                    echo '</div>';
                    $ress=$row2['price']*$row["quantity"];
                    $checkout_total+=$ress;
                    $_SESSION['checkout']=$checkout_total;
                }
            
            ?>
        </div>
        </form>
        <a href="purchaseform.php">Checkout</a>
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
