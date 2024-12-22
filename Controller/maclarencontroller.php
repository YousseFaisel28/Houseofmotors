<?php
require_once '../models/mclarenmodel.php'; // Include the McLarenModel

class McLarenController {

    private $model;

    // Constructor initializes the McLarenModel object
    public function __construct() {
        $this->model = new McLarenModel(); // Instantiate the McLarenModel
    }

    // Method to get all McLaren cars from the model
    public function getMcLarenCars() {
        return $this->model->getMcLarenCars(); // Fetch data from the model
    }

    // Destructor to clean up
    public function __destruct() {
        // Any necessary clean-up can go here, although PHP will handle most of it automatically
    }
}
?>
