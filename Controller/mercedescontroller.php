<?php
require_once '../models/mercedesmodel.php'; // Include the MercedesModel

class MercedesController {

    private $model;

    // Constructor initializes the MercedesModel object
    public function __construct() {
        $this->model = new MercedesModel(); // Instantiate the MercedesModel
    }

    // Method to get all Mercedes cars from the model
    public function getMercedesCars() {
        return $this->model->getMercedesCars(); // Fetch data from the model
    }

    // Destructor to clean up
    public function __destruct() {
        // Any necessary clean-up can go here, although PHP will handle most of it automatically
    }
}
?>
