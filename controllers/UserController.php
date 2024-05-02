<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function createUser($email, $first_name, $last_name, $password) {
        $user = new User();
        $user->setEmail($email);
        $user->setFirstName($first_name);
        $user->setLastName($last_name);
        // Hash the password before saving it
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $result = $user->createUser();
        // Start the session if it's not already started
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

        // Redirect to sign-in page
        header('Location: /web-programming-assignment/signin');
        exit();
    }           

    // sign in
    public function signinUser($email, $password) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $result = $user->signinUser($email, $password);
    
        if ($result) {
            // Start the session if it's not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            // Store user data in session
            $_SESSION['user'] = [
                'email' => $email,
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'full_name' => $result['first_name'] . ' ' . $result['last_name'],
                // Add other user data as needed
            ];
    
            // Redirect to home
            header('Location: /web-programming-assignment/');
            exit();
        } else {
            // Handle failed sign-in
            // For example, redirect back to sign-in page with an error message
        }
    }

    // sign out
    public function signoutUser() {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Unset all session data
        $_SESSION = [];
    
        // Destroy the session
        session_destroy();
    
        // Redirect to home
        header('Location: /web-programming-assignment/');
        exit();
    }
}