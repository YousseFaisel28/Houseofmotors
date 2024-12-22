<?php
require_once '../models/LamborghiniModel.php'; // Include the LamborghiniModel

class LamborghiniController {

    private $model;

    // Constructor initializes the LamborghiniModel object
    public function __construct() {
        $this->model = new LamborghiniModel(); // Instantiate the LamborghiniModel
    }

    // Method to get all Lamborghini cars from the model
    public function getLamborghiniCars() {
        return $this->model->getLamborghiniCars(); // Fetch data from the model
    }

    // Destructor to clean up
    public function __destruct() {
        // Any necessary clean-up can go here, although PHP will handle most of it automatically
    }
}
?>
