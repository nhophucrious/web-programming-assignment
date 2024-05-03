<?php

class Education {
    private $db;
    private $education_id;
    private $user_id;
    private $degree_name;
    private $institution_name;
    private $start_year;
    private $end_year;

    public function __construct() {
        $this->db = new Database();
    }

    // getters and setters
    public function getEducationId() {
        return $this->education_id;
    }

    public function setEducationId($education_id) {
        $this->education_id = $education_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getDegreeName() {
        return $this->degree_name;
    }

    public function setDegreeName($degree_name) {
        $this->degree_name = $degree_name;
    }

    public function getInstitutionName() {
        return $this->institution_name;
    }

    public function setInstitutionName($institution_name) {
        $this->institution_name = $institution_name;
    }

    public function getStartYear() {
        return $this->start_year;
    }

    public function setStartYear($start_year) {
        $this->start_year = $start_year;
    }

    public function getEndYear() {
        return $this->end_year;
    }

    public function setEndYear($end_year) {
        $this->end_year = $end_year;
    }

    // create education
    public function createEducation($user_id, $degree_name, $institution_name, $start_year, $end_year) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO education (user_id, degree_name, institution_name, start_year, end_year) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $degree_name);
        $stmt->bindParam(3, $institution_name);
        $stmt->bindParam(4, $start_year);
        $stmt->bindParam(5, $end_year);
        $stmt->execute();
        $education_id = $conn->lastInsertId();
        $this->db->closeConnection();
        return $education_id;
    }

    // delete education
    public function deleteEducation($education_id) {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM education WHERE education_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $education_id);
        $stmt->execute();
        $this->db->closeConnection();
    }

    // get education by user id
    public function getEducationByUserId($user_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM education WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $education = $stmt->fetchAll();
        $this->db->closeConnection();
        return $education;
    }

    

}
