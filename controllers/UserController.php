<?php
require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public function createUser($email, $first_name, $last_name, $password)
    {
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
    public function signinUser($email, $password)
    {
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
                'user_id' => $result['user_id'],
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
            // redirect to sign-in page
            header('Location: /web-programming-assignment/signin');

        }
    }

    // sign out
    public function signoutUser()
    {
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

    // get user detail by id
    public function getUserDetails($user_id)
    {
        $user = new User();
        $result = $user->getUserDetails($user_id);
        return $result;
    }

    // update user
    public function updateUser($user_id, $email, $first_name, $last_name, $password, $title, $phoneNo, $avatar, $gender, $dob, $aboutMe, $addressId, $skills)
    {
        $user = new User();
        $result = $user->updateUser($user_id, $email, $first_name, $last_name, $password, $title, $phoneNo, $avatar, $gender, $dob, $aboutMe, $addressId, $skills);
        return $result;
    }

    // Update avatar
    public function updateAvatar($user_id, $avatar)
    {
        $user = new User();
        $result = $user->updateAvatar($user_id, $avatar);
        return $result;
    }

    // update title 
    public function updateTitle($user_id, $title)
    {
        $user = new User();
        $result = $user->updateTitle($user_id, $title);
        return $result;
    }

    // update phone number
    public function updatePhoneNumber($user_id, $phoneNo)
    {
        $user = new User();
        $result = $user->updatePhoneNumber($user_id, $phoneNo);
        return $result;
    }

    // update gender
    public function updateGender($user_id, $gender)
    {
        $user = new User();
        $result = $user->updateGender($user_id, $gender);
        return $result;
    }

    // update dob
    public function updateDob($user_id, $dob)
    {
        $user = new User();
        $result = $user->updateDob($user_id, $dob);
        return $result;
    }

    // update address id
    public function updateAddressId($user_id, $addressId)
    {
        $user = new User();
        $result = $user->updateAddressId($user_id, $addressId);
        return $result;
    }

    // update about me
    public function updateAboutMe($user_id, $aboutMe)
    {
        $user = new User();
        $result = $user->updateAboutMe($user_id, $aboutMe);
        return $result;
    }

    // update skills
    public function updateSkills($user_id, $skills)
    {
        $user = new User();
        $result = $user->updateSkills($user_id, $skills);
        return $result;
    }
}