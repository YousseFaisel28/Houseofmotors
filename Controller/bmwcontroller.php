<?php
require_once '../models/BmwModel.php'; // Include the BmwModel

class BmwController {

    private $model;

    // Constructor initializes the BmwModel object
    public function __construct() {
        $this->model = new BmwModel(); // Instantiate the BmwModel
    }

    // Method to get all BMW cars from the model
    public function getBmwCars() {
        return $this->model->getBmwCars(); // Fetch data from the model
    }

    // Destructor to clean up
    public function __destruct() {
        // Any necessary clean-up can go here, although PHP will handle most of it automatically
    }
}
?>
