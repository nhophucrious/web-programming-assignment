<?php
// Path: models/Employer.php

class Employer {
    private $db;
    private $email;
    private $password;
    private $name;
    private $addressId;
    private $status;
    private $StreetNo;

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

        $sql = "INSERT INTO employers (email_address, password, employer_name, address_id) VALUES (:email, :password, :name, :address_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address_id', $this->addressId);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
}
