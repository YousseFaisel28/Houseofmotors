<?php

require_once '../database/Dbh.php'; // Include the Database class

class RangeRoverModel {

    private $db;

    public function __construct() {
        $this->db = new Database(); // Instantiate the Database class
    }

    // Method to fetch Range Rover car details (manufacture_year, price, img, model)
    public function getRangeRoverCars() {
        // Database connection from the Database class
        $conn = $this->db->getConnection();

        // SQL query to get data from the 'range_rover' table, including 'model' column
        $query = "SELECT Manufacture_year, Price, img, Model FROM rangerover";

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