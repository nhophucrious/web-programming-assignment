<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/Employer.php';

class EmployerController {
    public function createEmployer($email, $name, $password){
        $employer = new Employer();
        $employer->setEmail($email);
        $employer->setName($name);
        $employer->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $result = $user->createEmployer();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($result) {
            // User created successfully
            $_SESSION['message'] = 'User created successfully. You can now sign in.';
        } else {
            // Failed to create user
            $_SESSION['message'] = 'Failed to create user. Please try again.';
        }
    }
}