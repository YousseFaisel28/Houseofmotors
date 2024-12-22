<?php
require_once '../database/Dbh.php';

class ProductsModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Instantiate the Database class
    }

    /**
     * Add a new car part to the database with an image upload
     * @param string $partName
     * @param string $partDescription
     * @param float $price
     * @param int $stock
     * @param string $category
     * @param string|null $image The image file name
     * @return bool|string True on success, error message on failure
     */
    public function addCarPart($partName, $partDescription, $price, $stock, $category, $image = null) {
        $conn = $this->db->getConnection();

        // Set default image to null if no image uploaded
        $imagePath = $image ? "uploads/" . $image : null;

        $query = "INSERT INTO carparts (part_name, part_description, price, stock, category, part_image) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ssdiss', $partName, $partDescription, $price, $stock, $category, $imagePath);

            if ($stmt->execute()) {
                return true;
            } else {
                return "Error adding car part: " . $stmt->error;
            }
        } else {
            return "Statement preparation failed: " . $conn->error;
        }
    }
    // trial
    // public function addToCart ($product){


    // }

    
    public function updateCarPart($id, $partName, $partDescription, $price, $stock, $category, $image = null) {
        $conn = $this->db->getConnection();

        // Set default image to null if no image uploaded
        $imagePath = $image ? "uploads/" . $image : null;

        // Prepare query
        if ($imagePath) {
            $query = "UPDATE carparts SET part_name = ?, part_description = ?, price = ?, stock = ?, category = ?, part_image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssdissi', $partName, $partDescription, $price, $stock, $category, $imagePath, $id);
        } else {
            $query = "UPDATE carparts SET part_name = ?, part_description = ?, price = ?, stock = ?, category = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssdiss', $partName, $partDescription, $price, $stock, $category, $id);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error updating car part: " . $stmt->error;
        }
    }

 
    public function getAllCarParts() {
        $conn = $this->db->getConnection();

        $query = "SELECT id, part_name, part_description, price, stock, category, part_image, created_at FROM carparts";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC); // Return all rows as an associative array
        } else {
            return []; // Return an empty array if no parts are found
        }
    }


    public function getCarPartById($id) {
        $conn = $this->db->getConnection();

        $query = "SELECT * FROM carparts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function deleteCarPart($id) {
        $conn = $this->db->getConnection();

        $query = "DELETE FROM carparts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error deleting car part: " . $stmt->error;
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
