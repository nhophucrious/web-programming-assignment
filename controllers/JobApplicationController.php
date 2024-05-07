<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/JobApplication.php';

class JobApplicationController {
    public function createJobApplication($user_id, $job_id, $date_applied) {
        $job_application = new JobApplication();
        $job_application->setUserId($user_id);
        $job_application->setJobId($job_id);
        $job_application->setDateApplied($date_applied);
        $result = $job_application->createJobApplication();
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($result) {
            // Job application created successfully
            $_SESSION['message'] = 'Job application created successfully.';
        } else {
            // Failed to create job application
            $_SESSION['message'] = 'Failed to create job application. Please try again.';
        }

        // Redirect to home
        header('Location: /web-programming-assignment/jobs');
        exit();
    }

    public function getJobApplicationsByUID($user_id) {
        $job_application = new JobApplication();
        $result = $job_application->getJobApplicationsByUserId($user_id);
        return $result;
    }
}