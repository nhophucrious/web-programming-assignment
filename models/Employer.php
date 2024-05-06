<?php
// Path: models/Employer.php

// -- employers
// CREATE TABLE `employers` (
//   `employer_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
//   `email_address` TEXT NOT NULL,
//   `password` CHAR(60) NOT NULL,
//   `employer_name` TEXT NOT NULL,
//   `address_id` INTEGER,
//   `status` BOOL NOT NULL,
//   FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`)
// );

class Employer {
    private $db;
    private $email;
    private $password;
    private $name;
    private $addressId;
    private $status;

    public function __construct() {
        $this->db = new Database();
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAddressId() {
        return $this->addressId;
    }

    public function setAddressId($addressId) {
        $this->addressId = $addressId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function createEmployer(){
        $conn = this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO employers (email_address, password, employer_name) VALUES (:email, :password, :name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':name', $this->name);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
}
