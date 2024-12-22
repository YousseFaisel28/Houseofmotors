<?php
require_once '../models/user.php';
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
    public function getLoggedInUser() {
        
        if (isset($_SESSION['name'])) {
            return $_SESSION['name'];
        }
        return null;
    }

    // Handle user signup
    public function handleSignup($name, $email, $password) {
        $response = $this->userModel->signup($name, $email, $password);

        if ($response['success']) {
            // Redirect to login page after successful signup
            header("Location: ../views/login.php");
            exit; // Stop further execution after redirect
        } else {
            return $response['message']; // Return error message if signup fails
        }
    }
    public function handleLogin($username, $password) {
        // Validate empty fields
        if (empty($username) || empty($password)) {
            echo json_encode(["errMsg" => "Please fill all the fields."]);
            exit();
        }

        try {
            // Call the login method in UserModel
            $loginResult = $this->userModel->login($username, $password);

            // Handle login result
            if ($loginResult['status'] == 'success') {
                // Redirect user based on their role or homepage
                header("Location: " . $loginResult['redirect']);
                $_SESSION["name"]=$username;
                exit();
            } else {
                // Return error message if login failed
                echo "<script>alert('" . $loginResult['message'] . "'); window.location.href='login.php';</script>";
                exit();
            }

        } catch (Exception $e) {
            // Handle exceptions gracefully
            echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location.href='login.php';</script>";
            exit();
        }
    }
    /**
     * Process a car purchase.
     * 
     * @param int $userId The ID of the user making the purchase.
     * @param int $carId The ID of the car being purchased.
     * @param float $price The price of the car.
     * @param int $installments The number of installments for the purchase.
     * @return bool True if the purchase is successful, false otherwise.
     */
    public function purchaseCar($userId, $carId, $price, $installments) {
        // Calculate installment amount
        $installmentAmount = $price / $installments;

        // Record purchase in the database
        $isPurchased = $this->model->recordPurchase($userId, $carId, $price, $installments, $installmentAmount);

        if ($isPurchased) {
            $this->sendNotification($userId, "Purchase Successful! You have successfully purchased the car.");
            return true;
        }

        return false;
    }

    /**
     * Send a notification to the user.
     * 
     * @param int $userId The ID of the user.
     * @param string $message The notification message.
     */
    private function sendNotification($userId, $message) {
        $this->model->addNotification($userId, $message);
    }

    /**
     * Fetch all purchases for a user.
     * 
     * @param int $userId The ID of the user.
     * @return array An array of purchases.
     */
    public function getUserPurchases($userId) {
        return $this->model->getPurchasesByUserId($userId);
    }
}
