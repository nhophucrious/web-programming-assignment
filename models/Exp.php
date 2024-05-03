<?php

class Exp {
    private $db;
    private $exp_id;
    private $exp_name;
    private $year_start;
    private $year_end;
    private $exp_description;
    private $user_id;

    public function __construct() {
        $this->db = new Database();
    }

    // getters and setters
    public function getExpId() {
        return $this->exp_id;
    }

    public function setExpId($exp_id) {
        $this->exp_id = $exp_id;
    }

    public function getExpName() {
        return $this->exp_name;
    }

    public function setExpName($exp_name) {
        $this->exp_name = $exp_name;
    }

    public function getYearStart() {
        return $this->year_start;
    }

    public function setYearStart($year_start) {
        $this->year_start = $year_start;
    }

    public function getYearEnd() {
        return $this->year_end;
    }

    public function setYearEnd($year_end) {
        $this->year_end = $year_end;
    }

    public function getExpDescription() {
        return $this->exp_description;
    }

    public function setExpDescription($exp_description) {
        $this->exp_description = $exp_description;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    // create experience
    public function createExp($exp_name, $year_start, $year_end, $exp_description, $user_id) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO exp (exp_name, year_start, year_end, exp_description, user_id) VALUES (:exp_name, :year_start, :year_end, :exp_description, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':exp_name', $exp_name);
        $stmt->bindParam(':year_start', $year_start);
        $stmt->bindParam(':year_end', $year_end);
        $stmt->bindParam(':exp_description', $exp_description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $this->db->closeConnection();
    }

    // get all experience by user id
    public function getExpByUserId($user_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM exp WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $experiences = $stmt->fetchAll();
        $this->db->closeConnection();
        return $experiences;
    }

    // delete experience
    public function deleteExp($exp_id) {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM exp WHERE exp_id = :exp_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':exp_id', $exp_id);
        $stmt->execute();
        $this->db->closeConnection();
    }
}
