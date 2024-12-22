<?php
require_once '../database/Dbh.php'; // Include the Database class

class AdminModel {

    private $db;

    public function __construct() {
        $this->db = new Database(); // Instantiate the Database class
    }
 // Method to fetch all users
 public function getAllUsers() {
    $conn = $this->db->getConnection();

    // Query to fetch all user data
    $query = "SELECT id, name, email FROM users";

    $result = $conn->query($query);

    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    // Fetch and return all users as an array
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}

    /**
     * Add a new user to the users table
     * @param string $name
     * @param string $email
     * @param string $password
     * @return bool|string True on success, error message on failure
     */
    
    public function addUser($name, $email, $password) {
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($query);

    if ($stmt) {
        $stmt->bind_param('sss', $name, $email, $password);
        return $stmt->execute(); // Returns true on success, false on failure
    } else {
        return false; // Query preparation failed
    }
}


    /**
     * Edit an existing user's details
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string|null $password If provided, update the password as well
     * @return bool|string True on success, error message on failure
     */
    public function editUser($id, $name, $email, $password = null) {
        $conn = $this->db->getConnection();

        if ($password) {
            // Hash the new password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi', $name, $email, $hashedPassword, $id);
        } else {
            $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssi', $name, $email, $id);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error updating user: " . $stmt->error;
        }
    }

    /**
     * Delete a user from the users table
     * @param int $id
     * @return bool|string True on success, error message on failure
     */
    public function deleteUser($id) {
        $conn = $this->db->getConnection();

        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error deleting user: " . $stmt->error;
        }
    }
    public function getAllMercedes() {
        $conn = $this->db->getConnection();

        // Query to fetch all Mercedes car data
        $query = "SELECT car_ID, model, manufacture_year, price, img FROM mercedes";

        $result = $conn->query($query);

        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        // Fetch and return all Mercedes cars as an array
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        return $cars;
    }
    public function getMercedesById($car_id) {
        $conn = $this->db->getConnection();
    
        // Query to fetch the car by its ID
        $query = "SELECT car_ID, model, manufacture_year, price, img FROM mercedes WHERE car_ID = ?";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $car_id); // Bind the car_id parameter
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Fetch the car data
                return $result->fetch_assoc();
            } else {
                return null; // No car found with the given ID
            }
        } else {
            return "Error fetching car: " . $stmt->error;
        }
    }
    // Method to add a new Mercedes car
    public function addMercedes($model, $manufacture_year, $price, $img) {
        $query = "INSERT INTO mercedes (model, manufacture_year, price, img) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ssss', $model, $manufacture_year, $price, $img);
            return $stmt->execute(); // Returns true on success, false on failure
        } else {
            return false; // Query preparation failed
        }
    }

    public function editMercedes($car_id, $model, $manufacture_year, $price, $img) {
        $conn = $this->db->getConnection();
    
        // Ensure the query uses proper data types
        $query = "UPDATE mercedes SET model = ?, manufacture_year = ?, price = ?, img = ? WHERE car_ID = ?";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);
        
        // Bind the parameters to the SQL statement
        $stmt->bind_param('ssisi', $model, $manufacture_year, $price, $img, $car_id);
        
        // Execute the query and check if it's successful
        if ($stmt->execute()) {
            return true; // If the update was successful
        } else {
            return "Error updating car: " . $stmt->error; // Return error if it fails
        }
    }
    

    // Method to delete a Mercedes car
    public function deleteMercedes($car_ID) {
        $query = "DELETE FROM mercedes WHERE car_ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $car_ID);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error deleting Mercedes: " . $stmt->error;
        }
    }

   /**
     * Fetch all car parts
     * @return array List of all car parts
     */
    public function getAllCarParts() {
        $conn = $this->db->getConnection();

        $query = "SELECT id, part_description, price, stock, category, created_at, part_image FROM carparts";
        $result = $conn->query($query);

        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        $carParts = [];
        while ($row = $result->fetch_assoc()) {
            $carParts[] = $row;
        }

        return $carParts;
    }

    /**
     * Fetch a single car part by ID
     * @param int $id
     * @return array|null Car part details or null if not found
     */
    public function getCarPartById($id) {
        $conn = $this->db->getConnection();

        $query = "SELECT id, part_description, price, stock, category, created_at, part_image FROM carparts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Return the car part as an associative array
        } else {
            return null;
        }
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
        $conn = $this->db->getConnection();

        $query = "INSERT INTO carparts (part_description, price, stock, category, created_at, part_image) VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sdiss', $description, $price, $stock, $category, $imagePath);

        return $stmt->execute();
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
        $conn = $this->db->getConnection();

        if ($imagePath) {
            $query = "UPDATE carparts SET part_description = ?, price = ?, stock = ?, category = ?, part_image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sdissi', $description, $price, $stock, $category, $imagePath, $id);
        } else {
            $query = "UPDATE carparts SET part_description = ?, price = ?, stock = ?, category = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sdisi', $description, $price, $stock, $category, $id);
        }

        return $stmt->execute();
    }

    /**
     * Delete a car part from the database
     * @param int $id
     * @return bool True on success, false on failure
     */
    public function deleteCarPart($id) {
        $conn = $this->db->getConnection();

        $query = "DELETE FROM carparts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
    public function getAllCars() {
        $conn = $this->db->getConnection();
    
        $query = "SELECT car_id, model, manufacture_year, price, img FROM bmw"; // Assuming the table name is "cars"
        $result = $conn->query($query);
    
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }
    
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }
    
        return $cars;
    }
    public function getCarById($car_id) {
        $conn = $this->db->getConnection();
    
        $query = "SELECT car_id, model, manufacture_year, price, img FROM bmw WHERE car_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $car_id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Return the car details as an associative array
        } else {
            return null;
        }
    }
    public function addCar($model, $manufacture_year, $price, $imagePath) {
        $conn = $this->db->getConnection();
    
        $query = "INSERT INTO bmw (model, manufacture_year, price, img) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssis', $model, $manufacture_year, $price, $imagePath);
    
        return $stmt->execute();
    }
    public function editCar($car_id, $model, $manufacture_year, $price, $imagePath = null) {
        $conn = $this->db->getConnection();
    
        if ($imagePath) {
            $query = "UPDATE bmw SET model = ?, manufacture_year = ?, price = ?, img = ? WHERE car_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssisi', $model, $manufacture_year, $price, $imagePath, $car_id);
        } else {
            $query = "UPDATE bmw SET model = ?, manufacture_year = ?, price = ? WHERE car_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssii', $model, $manufacture_year, $price, $car_id);
        }
    
        return $stmt->execute();
    }
    public function deleteCar($car_id) {
        $conn = $this->db->getConnection();
    
        $query = "DELETE FROM bmw WHERE car_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $car_id);
    
        return $stmt->execute();
    }
    
    // Destructor to close the database connection
    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
   
