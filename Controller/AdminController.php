<?php
require_once '../models/AdminModel.php'; // Include the AdminModel

class AdminController {

    private $model;

    public function __construct() {
        $this->model = new AdminModel(); // Instantiate the AdminModel
    }
    public function getAllUsers() {
        return $this->model->getAllUsers(); // Calling the model method to fetch all users
    }
    /**
     * Add a new user by calling the AdminModel
     * @param string $name
     * @param string $email
     * @param string $password
     * @return string Success or error message
     */
    public function addUser($name, $email, $password) {
        $result = $this->model->addUser($name, $email, $password);
        return $result === true ? "User added successfully." : $result;
    }

    /**
     * Edit an existing user's details
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string|null $password
     * @return string Success or error message
     */
    public function editUser($id, $name, $email, $password = null) {
        $result = $this->model->editUser($id, $name, $email, $password);
        return $result === true ? "User updated successfully." : $result;
    }

    /**
     * Delete a user by calling the AdminModel
     * @param int $id
     * @return string Success or error message
     */
    public function deleteUser($id) {
        $result = $this->model->deleteUser($id);
        return $result === true ? "User deleted successfully." : $result;
    }
    // Add this method to your AdminController class
public function getMercedesById($car_id) {
    return $this->model->getMercedesById($car_id); // Call the model's method to fetch the car by its ID
}

// Method to fetch all Mercedes cars
public function getAllMercedes() {
    return $this->model->getAllMercedes();
}

// Method to add a new Mercedes car
public function addMercedes($model, $manufacture_year, $price, $img) {
    $result = $this->model->addMercedes($model, $manufacture_year, $price, $img);
    return $result === true ? "Mercedes car added successfully." : "Error adding Mercedes car.";
}
public function editMercedes($car_id, $model, $manufacture_year, $price, $img) {
    // Call the model's editMercedes function to update the car data
    return $this->model->editMercedes($car_id, $model, $manufacture_year, $price, $img);
}

// Method to delete a Mercedes car
public function deleteMercedes($car_ID) {
    $result = $this->model->deleteMercedes($car_ID);
    return $result === true ? "Mercedes car deleted successfully." : $result;
}


/**
     * Fetch all car parts
     * @return array List of all car parts
     */
    public function getAllCarParts() {
        return $this->model->getAllCarParts();
    }

    /**
     * Fetch a single car part by ID
     * @param int $id
     * @return array|null Car part details or null if not found
     */
    public function getCarPartById($id) {
        return $this->model->getCarPartById($id);
    }

    /**
     * Add a new car part to the database
     * @param string $description
     * @param float $price
     * @param int $stock
     * @param string $category
     * @param string $imagePath
     * @return bool True on success, false on failure
     */
    public function addCarPart($description, $price, $stock, $category, $imagePath) {
        return $this->model->addCarPart($description, $price, $stock, $category, $imagePath);
    }

    /**
     * Edit an existing car part in the database
     * @param int $id
     * @param string $description
     * @param float $price
     * @param int $stock
     * @param string $category
     * @param string|null $imagePath Optional, path to the new image
     * @return bool True on success, false on failure
     */
    public function editCarPart($id, $description, $price, $stock, $category, $imagePath = null) {
        return $this->model->editCarPart($id, $description, $price, $stock, $category, $imagePath);
    }

    /**
     * Delete a car part from the database
     * @param int $id
     * @return bool True on success, false on failure
     */
    public function deleteCarPart($id) {
        return $this->model->deleteCarPart($id);
    }
 // Fetch all cars
 public function getAllCars() {
    return $this->model->getAllCars(); // Get all cars from the model
}

// Fetch a single car by ID
public function getCarById($car_id) {
    return $this->model->getCarById($car_id); // Get a specific car by ID from the model
}

// Add a new car
public function addCar($model, $manufacture_year, $price, $imagePath) {
    return $this->model->addCar($model, $manufacture_year, $price, $imagePath); // Add car using the model
}

// Edit an existing car
public function editCar($car_id, $model, $manufacture_year, $price, $imagePath = null) {
    return $this->model->editCar($car_id, $model, $manufacture_year, $price, $imagePath); // Edit car using the model
}

// Delete a car
public function deleteCar($car_id) {
    return $this->model->deleteCar($car_id); // Delete car from the model
}
}
?>
