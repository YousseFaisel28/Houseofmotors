<?php
require_once '../database/Dbh.php'; // Include the Database class

class LamborghiniModel {

    private $db;

    public function __construct() {
        $this->db = new Database(); // Instantiate the Database class
    }

    // Method to fetch Lamborghini car details (manufacture_year, price, img, model)
    public function getLamborghiniCars() {
        // Database connection from the Database class
        $conn = $this->db->getConnection();

        // SQL query to get data from the 'lamborghini' table, including 'model' column
        $query = "SELECT manufacture_year, price, img, model FROM lamborghini";

        // Execute the query
        $result = $conn->query($query);

        // Check if the query was successful
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        // Fetch the results and store them in an array
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        // Return the array of car data
        return $cars;
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->db->closeConnection(); // Close the connection when done
    }
}
?>
