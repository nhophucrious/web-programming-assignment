<?php
// controllers/Controller.php

class Controller {
    public function home() {
        $this->showHomePage();
    }

    public function jobs() {
        $this->showJobsPage();
    }

    public function employer() {
        $this->showEmployerPage();
    }

    public function profile() {
        $this->showProfilePage();
    }

    public function signup() {
        $this->showSignupPage();
    }

    public function signin() {
        $this->showSigninPage();
    }

    public function admin() {
        $this->showAdminPage();
    }

    public function job_details() {
        $this->showJobDetails();
    }

    public function page_not_found() {
        $this->showPageNotFound();
    }

    private function showHomePage() {
        include 'views/home.php';
    }

    private function showJobsPage() {
        include 'views/jobs.php';
    }

    private function showEmployerPage() {
        include 'views/employer.php';
    }

    private function showProfilePage() {
        include 'views/profile.php';
    }

    private function showSignupPage() {
        include 'views/signup.php';
    }

    private function showSigninPage() {
        include 'views/signin.php';
    }

    private function showAdminPage() {
        include 'views/admin.php';
    }

    private function showJobDetails() {
        include 'views/job_detail.php';
    }

    public function showPageNotFound() {
        include 'views/error.php';
    }

    private function showError($title, $message) {
        include 'views/error.php';
    }
}