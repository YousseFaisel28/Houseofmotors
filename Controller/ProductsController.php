<?php
require_once '../models/ProductsModel.php';

class ProductsController {
    private $model;

    public function __construct() {
        $this->model = new ProductsModel();
    }

    // Fetch all car parts
    public function getAllCarParts() {
        return $this->model->getAllCarParts();
    }

    // Add a new car part
    public function addCarPart($partName, $partDescription, $price, $stock, $category) {
        return $this->model->addCarPart($partName, $partDescription, $price, $stock, $category);
    }

    // Get a single car part by ID
    public function getCarPartById($id) {
        return $this->model->getCarPartById($id);
    }

    // Update car part details
    public function updateCarPart($id, $partName, $partDescription, $price, $stock, $category) {
        return $this->model->updateCarPart($id, $partName, $partDescription, $price, $stock, $category);
    }

    // Delete a car part
    public function deleteCarPart($id) {
        return $this->model->deleteCarPart($id);
    }
}
?>
