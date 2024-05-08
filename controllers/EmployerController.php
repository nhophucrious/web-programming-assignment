<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/Employer.php';
require_once __DIR__ . '/../models/Address.php';

class EmployerController {
    public function createEmployer($email, $name, $password, $streetNo, $streetName, $ward, $district, $province, $phoneNo){

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
        $employer->setPhoneNo($phoneNo);
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

    public function signinEmployer($email, $password) {
        $employer = new Employer();
        $employer->setEmail($email);
        $employer->setPassword($password);
        $result = $employer->signinEmployer($email, $password);

        if ($result) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['employer'] = [
                'employer_id' => $result['employer_id'],
                'email' => $result['email'],
                'name' => $result['employer_name'],
                'address_id' => $result['address_id'],
            ];

        } else {
            $_SESSION['message'] = 'Invalid email or password. Please try again.';
        }

        header('Location: /web-programming-assignment/employer');
        exit();
    }

    public function signoutUser() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $_SESSION = [];
    
        session_destroy();
    
        header('Location: /web-programming-assignment/');
        exit();
    }

    public function getEmployerDetails($employer_id) {
        $employer = new Employer();
        $result = $employer->getEmployerDetails($employer_id);
        return $result;
    }

    public function updatePhoneNumber($employer_id, $phoneNo){
        $employer = new Employer();
        $employer->setPhoneNo($phoneNo);
        $result = $employer->updatePhoneNumber($employer_id, $phoneNo);
        return $result;
    }

    public function updateAboutUs($employer_id, $aboutUs){
        $employer = new Employer();
        $employer->setAboutUs($aboutUs);
        $result = $employer->updateAboutUs($employer_id, $aboutUs);
        return $result;
    }

}