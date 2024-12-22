<?php
require_once '../models/CartModel.php'; // Include the CartModel

class CartController {

    private $model;

    public function __construct() {
        $this->model = new CartModel(); // Instantiate the CartModel
    }

    // Add car to the cart
    public function addToCart($user_id, $cart_id, $quantity) {
        $result = $this->model->addToCart($user_id, $cart_id, $quantity);
        return $result ? "Car added to cart successfully!" : "Error adding car to cart.";
    }

    // Get all items in the user's cart
    public function getCartItems($user_id) {
        return $this->model->getCartItems($user_id);
    }

    // Update the quantity of a car in the cart
    public function updateCartItem($user_id, $car_id, $quantity) {
        $result = $this->model->updateCartItem($user_id, $car_id, $quantity);
        return $result ? "Cart updated successfully." : "Error updating cart.";
    }

    // Remove a car from the cart
    public function removeFromCart($user_id, $car_id) {
        $result = $this->model->removeFromCart($user_id, $car_id);
        return $result ? "Car removed from cart." : "Error removing car from cart.";
    }

    // Clear the entire cart
    public function clearCart($user_id) {
        $result = $this->model->clearCart($user_id);
        return $result ? "Cart cleared successfully." : "Error clearing cart.";
    }
}
?>
