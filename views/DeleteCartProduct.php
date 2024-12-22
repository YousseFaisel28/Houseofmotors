<?php 
require_once '../database/Dbh.php'; // Include the Database class

if(isset($_GET['id'])){
    $db = new Database();
    $conn = $db->getConnection(); // Get the connection from Database

    $stmt = $conn->prepare("Delete  FROM cart WHERE product_id = ?"); // Use prepare from the connection object

    $stmt->bind_param("s", $_GET['id']); // Bind the email parameter
    $stmt->execute();
header("location:products.php");
}
?>