<?php
// controllers/Controller.php

class Controller {
    public function home() {
        $this->showHomePage();
    }

    public function about() {
        $this->showAboutPage();
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

    public function employerProfile(){
        $this->showEmployerProfilePage();
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

    public function page_not_found() {
        $this->showPageNotFound();
    }

    private function showHomePage() {
        include 'views/home.php';
    }

    private function showAboutPage() {
        include 'views/about.php';
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

    private function showEmployerProfilePage() {
        include 'views/employer_profile.php';
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

    public function showPageNotFound() {
        include 'views/error.php';
    }

    private function showError($title, $message) {
        include 'views/error.php';
    }
}