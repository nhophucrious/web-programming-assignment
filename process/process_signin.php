<?php
// Path: process/process_signin.php
session_start(); // Start the session
require_once '../controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    $user = $userController->signinUser($email, $password);

    if ($user) {
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user['user_id']; // Save the user's ID in the session
        $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name']; // Save the user's full name in the session
        header('Location: ../');
    } else {
        $_SESSION['message'] = '0';
    }
}