<?php

/*
-- jobs
CREATE TABLE `jobs` (
  `job_id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `employer_id` INTEGER,
  `job_name` TEXT,
  `job_level` TEXT,
  `job_type` TEXT,
  `job_location` TEXT COMMENT 'on-site or remote',
  `salary` INTEGER,
  `job_description` TEXT,
  `job_requirement` TEXT,
  `job_benefit` TEXT,
  `date_posted` DATETIME,
  FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`)
);

*/

class Job {
    private $db;
    private $job_id;
    private $employer_id;
    private $job_name;
    private $job_level;
    private $job_type;
    private $job_location;
    private $salary;
    private $job_description;
    private $job_requirement;
    private $job_benefit;
    private $date_posted;

    public function __construct() {
        $this->db = new Database;
    }

    // getters and setters
    public function getJobId() {
        return $this->job_id;
    }

    public function setJobId($job_id) {
        $this->job_id = $job_id;
    }

    public function getEmployerId() {
        return $this->employer_id;
    }

    public function setEmployerId($employer_id) {
        $this->employer_id = $employer_id;
    }

    public function getJobName() {
        return $this->job_name;
    }

    public function setJobName($job_name) {
        $this->job_name = $job_name;
    }

    public function getJobLevel() {
        return $this->job_level;
    }

    public function setJobLevel($job_level) {
        $this->job_level = $job_level;
    }

    public function getJobType() {
        return $this->job_type;
    }

    public function setJobType($job_type) {
        $this->job_type = $job_type;
    }

    public function getJobLocation() {
        return $this->job_location;
    }

    public function setJobLocation($job_location) {
        $this->job_location = $job_location;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getJobDescription() {
        return $this->job_description;
    }

    public function setJobDescription($job_description) {
        $this->job_description = $job_description;
    }

    public function getJobRequirement() {
        return $this->job_requirement;
    }

    public function setJobRequirement($job_requirement) {
        $this->job_requirement = $job_requirement;
    }

    public function getJobBenefit() {
        return $this->job_benefit;
    }

    public function setJobBenefit($job_benefit) {
        $this->job_benefit = $job_benefit;
    }

    public function getDatePosted() {
        return $this->date_posted;
    }

    public function setDatePosted($date_posted) {
        $this->date_posted = $date_posted;
    }

    // get all jobs
    public function getAllJobs() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM jobs";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $this->db->closeConnection();
        return $jobs;
    }

    // get job by id
    public function getJobById($job_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM jobs WHERE job_id = :job_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->execute();
        $job = $stmt->fetch();
        $this->db->closeConnection();
        return $job;
    }

    // get jobs by employer id
    public function getJobsByEmployerId($employer_id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM jobs WHERE employer_id = :employer_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $this->db->closeConnection();
        return $jobs;
    }

    // get job by page and page size
    public function getJobsByPage($page, $pageSize) {
        $conn = $this->db->getConnection();
        $startIndex = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM jobs LIMIT :startIndex, :pageSize";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
        $stmt->bindParam(':pageSize', $pageSize, PDO::PARAM_INT);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $this->db->closeConnection();
        return $jobs;
    }

    // get total job count
    public function getTotalJobCount() {
        $conn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) FROM jobs";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $totalJobCount = $stmt->fetchColumn();
        $this->db->closeConnection();
        return $totalJobCount;
    }

    // add job
    public function addJob($employer_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO jobs (employer_id, job_name, job_level, job_type, job_location, salary, job_description, job_requirement, job_benefit, date_posted) VALUES (:employer_id, :job_name, :job_level, :job_type, :job_location, :salary, :job_description, :job_requirement, :job_benefit, :date_posted)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':job_name', $job_name);
        $stmt->bindParam(':job_level', $job_level);
        $stmt->bindParam(':job_type', $job_type);
        $stmt->bindParam(':job_location', $job_location);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':job_requirement', $job_requirement);
        $stmt->bindParam(':job_benefit', $job_benefit);
        $stmt->bindParam(':date_posted', $date_posted);
        $stmt->execute();
        $this->db->closeConnection();
        return true;
    }

    // update job
    public function updateJob($job_id, $employer_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted) {
        $conn = $this->db->getConnection();
        $sql = "UPDATE jobs SET employer_id = :employer_id, job_name = :job_name, job_level = :job_level, job_type = :job_type, job_location = :job_location, salary = :salary, job_description = :job_description, job_requirement = :job_requirement, job_benefit = :job_benefit, date_posted = :date_posted WHERE job_id = :job_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':job_name', $job_name);
        $stmt->bindParam(':job_level', $job_level);
        $stmt->bindParam(':job_type', $job_type);
        $stmt->bindParam(':job_location', $job_location);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':job_requirement', $job_requirement);
        $stmt->bindParam(':job_benefit', $job_benefit);
        $stmt->bindParam(':date_posted', $date_posted);
        $stmt->execute();
        $this->db->closeConnection();
        return true;
    }

    // delete job
    public function deleteJob($job_id) {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM jobs WHERE job_id = :job_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->execute();
        $this->db->closeConnection();
        return true;
    }

    // search jobs
    public function searchJobs($query) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM jobs WHERE job_name LIKE :query OR job_type LIKE :query OR job_location LIKE :query OR job_level LIKE :query OR job_description LIKE :query";
        $stmt = $conn->prepare($sql);
        $queryWithWildcards = "%" . $query . "%";
        $stmt->bindParam(':query', $queryWithWildcards);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $this->db->closeConnection();
        return $jobs;
    }
}