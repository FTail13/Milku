<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'your_database_name'; // Replace with your database name
    private $username = 'your_username';     // Replace with your username
    private $password = 'your_password';     // Replace with your password
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
