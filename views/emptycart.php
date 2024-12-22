<?php 
require_once '../database/Dbh.php'; // Include the Database class
session_start();

    $db = new Database();
    $conn = $db->getConnection(); // Get the connection from Database
$userid= $_SESSION['userid'];
    $stmt = $conn->prepare("Delete  FROM cart WHERE user_id = ?"); // Use prepare from the connection object

    $stmt->bind_param("s", $userid); // Bind the email parameter
    $stmt->execute();
    echo '<script>alert("Payment processed sucessfuly")</script>';
    // sleep(5000000000000);
    // header("location:products.php");

?>