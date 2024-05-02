<?php
// Path: process/process_signup.php
session_start(); // Start the session
require_once '../controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $_SESSION['message'] = 'Passwords do not match';
        exit();
    }

    $userController = new UserController();
    $result = $userController->createUser($email, $first_name, $last_name, $password);

    if ($result) {
        $_SESSION['message'] = '1';
    } else {
        $_SESSION['message'] = '0';
    }

    // redirect to sign in page
    header('Location: ../signin');
}