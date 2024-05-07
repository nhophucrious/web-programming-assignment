<?php

// -- job_application
// CREATE TABLE `job_applications` (
//   `application_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
//   `user_id` INTEGER,
//   `job_id` INTEGER,
//   `date_applied` DATETIME,
//   FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
//   FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`)
// );

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

        $result = $stmt->fetch();

        $this->db->closeConnection();
        return $result;
    }
}
