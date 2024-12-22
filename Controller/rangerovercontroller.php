<?php
require_once '../models/rangeroverModel.php'; // Include the RangeRoverModel

class RangeRoverController {

    private $model;

    // Constructor initializes the RangeRoverModel object
    public function __construct() {
        $this->model = new RangeRoverModel(); // Instantiate the RangeRoverModel
    }

    // Method to get all Range Rover cars from the model
    public function getRangeRoverCars() {
        return $this->model->getRangeRoverCars(); // Fetch data from the model
    }

    // Destructor to clean up
    public function __destruct() {
        // Any necessary clean-up can go here, although PHP will handle most of it automatically
    }
}
?>
