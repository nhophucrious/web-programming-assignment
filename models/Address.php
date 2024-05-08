<?php

class Address {
    // Properties
    private $db;
    private $address_id;
    private $streetNo;
    private $streetName;
    private $ward;
    private $district;
    private $province;

    // Constructor
    public function __construct() {
        $this->db = new Database();
    }

    // Getters and Setters
    public function getAddressId() {
        return $this->address_id;
    }

    public function setAddressId($address_id) {
        $this->address_id = $address_id;
    }
    
    public function getStreetNo() {
        return $this->streetNo;
    }

    public function setStreetNo($streetNo) {
        $this->streetNo = $streetNo;
    }

    public function getStreetName() {
        return $this->streetName;
    }

    public function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    public function getWard() {
        return $this->ward;
    }

    public function setWard($ward) {
        $this->ward = $ward;
    }

    public function getDistrict() {
        return $this->district;
    }

    public function setDistrict($district) {
        $this->district = $district;
    }

    public function getProvince() {
        return $this->province;
    }

    public function setProvince($province) {
        $this->province = $province;
    }

    // Methods - in sql, street_number, street_name, ward, district, province
    public function createAddress() {
        $conn = $this->db->getConnection();
        $query = 'INSERT INTO address (street_number, street_name, ward, district, province) VALUES (:street_number, :street_name, :ward, :district, :province)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':street_number', $this->streetNo);
        $stmt->bindParam(':street_name', $this->streetName);
        $stmt->bindParam(':ward', $this->ward);
        $stmt->bindParam(':district', $this->district);
        $stmt->bindParam(':province', $this->province);

        $stmt->execute();

        // Get the ID of the newly created address
        $address_id = $conn->lastInsertId();

        $this->db->closeConnection();
        return $address_id;
    }

    // get address by id
    public function getAddress($address_id) {
        $conn = $this->db->getConnection();
        $query = 'SELECT * FROM address WHERE address_id = :address_id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':address_id', $address_id);
        $stmt->execute();
        $address = $stmt->fetch();

        // Set the properties of the Address object
        $this->address_id = $address['address_id'];
        $this->streetNo = $address['street_number'];
        $this->streetName = $address['street_name'];
        $this->ward = $address['ward'];
        $this->district = $address['district'];
        $this->province = $address['province'];

        $this->db->closeConnection();

        return $this;
    }

    // update address
    public function updateAddress($address_id, $streetNo, $streetName, $ward, $district, $province) {
        $conn = $this->db->getConnection();
        $query = 'UPDATE address SET street_number = :street_number, street_name = :street_name, ward = :ward, district = :district, province = :province WHERE address_id = :address_id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':address_id', $address_id);
        $stmt->bindParam(':street_number', $streetNo);
        $stmt->bindParam(':street_name', $streetName);
        $stmt->bindParam(':ward', $ward);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':province', $province);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
}
?>