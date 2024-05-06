<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/Employer.php';
require_once __DIR__ . '/../models/Address.php';

class EmployerController {
    public function createEmployer($email, $name, $password, $streetNo, $streetName, $ward, $district, $province){

        // Create the address first to give address_id in the next step
        $address = new Address();
        $address->setStreetNo($streetNo);
        $address->setStreetName($streetName);
        $address->setWard($ward);
        $address->setDistrict($district);
        $address->setProvince($province);
        // Create address already return the ID
        $address_result = $address->createAddress();

        // Create emplyer
        $employer = new Employer();
        $employer->setEmail($email);
        $employer->setName($name);
        $employer->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $employer->setAddressId($address_result);
        $result = $employer->createEmployer();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($result) {
            // User created successfully
            $_SESSION['message'] = 'Employer created successfully. You can now sign in.';
        } else {
            // Failed to create user
            $_SESSION['message'] = 'Failed to create user. Please try again.';
        }
        header('Location: /web-programming-assignment/signin');
        exit;
    }
}