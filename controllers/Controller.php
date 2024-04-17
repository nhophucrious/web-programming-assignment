<?php
// controllers/Controller.php

class Controller {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        switch ($action) {
            case 'home':
                $this->showHomePage();
                break;
            // Add more cases for other pages
            default:
                $this->showError("Page not found", "Page for operation ".$action." was not found!");
                break;
        }
    }

    private function showHomePage() {
        include 'views/home.php';
    }

    private function showError($title, $message) {
        include 'views/error.php';
    }
    
    // Add more methods for other pages
}