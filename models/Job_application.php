<?php

class Job_application{
    private $db;
    private $application_id;
    private $user_id;
    private $job_id;
    private $date_applied;

    public function __construct() {
        $this->db = new Database();
    }

    public function getApplicationId() {
        return $this->application_id;
    }

    public function setApplicationId($application_id) {
        $this->application_id = $application_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getJobId() {
        return $this->job_id;
    }

    public function setJobId($job_id) {
        $this->job_id = $job_id;
    }

    public function getDateApplied() {
        return $this->date_applied;
    }

    public function setDateApplied($date_applied) {
        $this->date_applied = $date_applied;
    }

    public function createJobApplication() {
        $conn = $this->db->getConnection();

        // Prepare the SELECT query
        $sql = "SELECT * FROM job_applications WHERE user_id = :user_id AND job_id = :job_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':job_id', $this->job_id);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch();

        // If the result is not false, it means the combination already exists
        if ($result) {
            $this->db->closeConnection();
            return false;
        }

        // If the combination does not exist, proceed with the INSERT query
        $sql = "INSERT INTO job_applications (user_id, job_id, date_applied) VALUES (:user_id, :job_id, :date_applied)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':job_id', $this->job_id);
        $stmt->bindParam(':date_applied', $this->date_applied);
        $stmt->execute();

        $application_id = $conn->lastInsertId();

        $this->db->closeConnection();
        return $application_id;
    }

    public function deleteJobApplication() {
        $conn = $this->db->getConnection();

        $sql = "DELETE FROM job_applications WHERE application_id = :application_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':application_id', $this->application_id);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    public function getJobApplicationsByUserId($user_id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM job_applications WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $this->db->closeConnection();
        return $result;
    }
}
