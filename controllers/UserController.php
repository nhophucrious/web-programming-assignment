<?php
require_once '../database/Database.php';
require_once '../models/User.php';

class UserController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser($email, $firstName, $lastName, $password) {
        $user = new User();
        $user->setEmail($email);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO users (email_address, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':password', $user->getPassword());
        $stmt->execute();

        // echo 'User created successfully';

        $this->db->closeConnection();
        return true;
    }
}