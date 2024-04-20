<?php
// controllers/Controller.php

class Controller {
    public function home() {
        $this->showHomePage();
    }

    public function about() {
        $this->showAboutPage();
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

    public function showPageNotFound() {
        include 'views/error.php';
    }

    private function showError($title, $message) {
        include 'views/error.php';
    }
}