<?php

class JobController {
    public function addJob($employer_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted) {
        $job = new Job();
        $result = $job->addJob($employer_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted);
        if ($result) {
            // User created successfully
            $_SESSION['message'] = 'Job created successfully';
        } else {
            // Failed to create user
            $_SESSION['message'] = 'Failed to create job. Please try again';
        }
        header('Location: /web-programming-assignment/job-post');
        exit;
    }

    public function getAllJobs() {
        $job = new Job();
        $result = $job->getAllJobs();
        return $result;
    }

    public function searchJobs($query) {
        $job = new Job();
        $result = $job->searchJobs($query);
        return $result;
    }

    public function getJobById($job_id) {
        $job = new Job();
        $result = $job->getJobById($job_id);
        return $result;
    }

    public function getJobsByEmployerId($employer_id) {
        $job = new Job();
        $result = $job->getJobsByEmployerId($employer_id);
        return $result;
    }

    public function updateJob($job_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted) {
        $job = new Job();
        $result = $job->updateJob($job_id, $job_name, $job_level, $job_type, $job_location, $salary, $job_description, $job_requirement, $job_benefit, $date_posted);
        return $result;
    }

    public function deleteJob($job_id) {
        $job = new Job();
        $result = $job->deleteJob($job_id);
        return $result;
    }

}