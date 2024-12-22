<?php
class Database {
    private $host = "localhost";      // Database host
    private $user = "root";           // Database username (default for XAMPP)
    private $password = "";           // Database password (empty for XAMPP by default)
    private $dbname = "houseofmotors2";  // Your database name
    private $conn;

    public function __construct() {
        $this->connect();
    }

    // Establish connection to the database
    private function connect() {
        // Ensure all parameters are correctly set
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get the connection object
    public function getConnection() {
        return $this->conn;
    }

    // Close the connection (optional, PHP will close it automatically at the end of script execution)
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
