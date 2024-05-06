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
    private $phoneNo;

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

    public function getPhoneNo(){
        return $this->phoneNo;
    }

    public function setPhoneNo($phoneNo) {
        $this->phoneNo = $phoneNo;
    }

    public function createEmployer(){
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM employers WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO employers (email_address, password, employer_name, address_id, phoneNo) VALUES (:email, :password, :name, :address_id, :phoneNo)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address_id', $this->addressId);
        $stmt->bindParam(':phoneNo', $this->phoneNo);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    public function signinEmployer($email, $password){
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM employers WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $employer = $stmt->fetch();

        if ($employer && password_verify($password, $employer['password'])) {
            $this->db->closeConnection();
            return $employer;
        } else {
            $this->db->closeConnection();
            return null;
        }
    }

    public function getEmployerDetails($employer_id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM employers WHERE employer_id = :employer_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->execute();
        $employer = $stmt->fetch();

        $this->db->closeConnection();
        return $employer;
    }

    public function updatePhoneNumber($employer_id, $phoneNo){
        $conn = $this->db->getConnection();

        $sql = "UPDATE employers SET phoneNo = :phoneNo WHERE employer_id = :employer_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
}