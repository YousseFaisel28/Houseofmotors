<?php
require_once '../database/Dbh.php';

class User {
    private $db;
    public function __construct() {
        $this->db = new Database(); // Instantiate the Database class
    }

    // Sign up method
    public function signup($name, $email, $password) {
        $conn = $this->db->getConnection(); // Get the connection from Database

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?"); // Use prepare from the connection object
        $stmt->bind_param("s", $email); // Bind the email parameter
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return ['success' => false, 'message' => 'Email already exists.'];
        }

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure the password
        $stmt->bind_param("sss", $name, $email, $hashedPassword); // Bind parameters
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return ['success' => true, 'message' => 'Sign up successful.'];
        } else {
            return ['success' => false, 'message' => 'Error during sign up.'];
        }
    }

   // Login method that checks both admin and user credentials
   public function login($username, $password) {
    $conn = $this->db->getConnection();

    // Admin Login Check
    if ($username === 'admin' && $password === '1234') {
        error_log("Admin login successful");
        $_SESSION["UserName"] = 'admin';
        $_SESSION["is_admin"] = 1; // Set the admin session variable
        return ['status' => 'success', 'redirect' => 'dashboard.php'];
    }

    // User Database Validation
    $stmt = $conn->prepare("SELECT name, password,id FROM users WHERE name = ?" );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $hashedPassword,$id);
        $stmt->fetch();
        $stmt->close();
        $_SESSION["name"] = $username;  // Store the 'name' from database

        if (password_verify($password, $hashedPassword)) {
            return ['status' => 'success', 'redirect' => 'index.php'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid username or password.'];
        }
    } else {
        $stmt->close();
        return ['status' => 'error', 'message' => 'Invalid username or password.'];
    }
}
public function recordPurchase($userId, $carId, $price, $installments, $installmentAmount) {
    $conn = $this->db->getConnection();
    $query = "INSERT INTO purchases (user_id, car_id, price, installments, installment_amount, purchase_date) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iidd', $userId, $carId, $price, $installments, $installmentAmount);

    return $stmt->execute();
}

public function addNotification($userId, $message) {
    $conn = $this->db->getConnection();
    $query = "INSERT INTO notifications (user_id, message, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $userId, $message);

    return $stmt->execute();
}

public function getPurchasesByUserId($userId) {
    $conn = $this->db->getConnection();
    $query = "SELECT * FROM purchases WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $purchases = [];
        while ($row = $result->fetch_assoc()) {
            $purchases[] = $row;
        }
        return $purchases;
    }

    return [];
}
}