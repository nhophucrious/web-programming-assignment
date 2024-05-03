<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'web_programming_assignment';
    private $conn;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname; // Data Source Name
        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->initDatabase(); // Call initDatabase
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function initDatabase() {
        try {
            $sql = "SHOW TABLES LIKE 'users'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            // Check if the 'users' table exists
            if($stmt->rowCount() === 0) {
                // If the 'users' table does not exist, create it
                $sql = file_get_contents(__DIR__ . "/hiredcmut.sql");
                $this->conn->exec($sql);
                echo "Database and tables created successfully!";
            }
        } catch (PDOException $e) {
            die("Error initializing database: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>
