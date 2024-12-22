<?php
require_once '../database/Dbh.php'; // Include the Database class

class CartModel {

    private $db;
    
    public function __construct() {
        $this->db = new Database(); // Initialize the Database class
    }

    // Add a car to the cart ppp
    public function addToCart($user_id, $product_id, $quantity) {
        $conn = $this->db->getConnection();

        // Check if the car already exists in the user's cart
        $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the car is already in the cart, update the quantity
            $query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ?  AND product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iii', $quantity, $user_id,$product_id);
        } else {
            // If not, insert the new item into the cart
            $query = "INSERT INTO cart (user_id, product_id  ,quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iii', $user_id, $product_id, $quantity);
        }

        return $stmt->execute();
    }

    // Fetch all items in the user's cart
    public function getCartItems($user_id) {
        $conn = $this->db->getConnection();
        $query = "SELECT c.car_id, c.quantity, m.model, m.price, m.img 
                  FROM cart c 
                  JOIN mercedes m ON c.car_id = m.car_ID 
                  WHERE c.user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    // Update the quantity of an item in the cart
    public function updateCartItem($user_id, $car_id, $quantity) {
        $conn = $this->db->getConnection();
        $query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND car_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $quantity, $user_id, $car_id);
        
        return $stmt->execute();
    }

    // Remove an item from the cart
    public function removeFromCart($user_id, $car_id) {
        $conn = $this->db->getConnection();
        $query = "DELETE FROM cart WHERE user_id = ? AND car_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $car_id);
        
        return $stmt->execute();
    }

    // Clear the entire cart
    public function clearCart($user_id) {
        $conn = $this->db->getConnection();
        $query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        
        return $stmt->execute();
    }

    // Destructor to close database connection
    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
