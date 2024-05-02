<?php
// Path: models/User.php
class User {
    private $db;
    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $title;
    private $phoneNo;
    private $avatar;
    private $gender;
    private $dob;
    private $aboutMe;
    private $addressId;
    private $certificateId;

    public function __construct() {
        $this->db = new Database();
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getPhoneNo() {
        return $this->phoneNo;
    }

    public function setPhoneNo($phoneNo) {
        $this->phoneNo = $phoneNo;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getDob() {
        return $this->dob;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function getAboutMe() {
        return $this->aboutMe;
    }

    public function setAboutMe($aboutMe) {
        $this->aboutMe = $aboutMe;
    }

    public function getAddressId() {
        return $this->addressId;
    }

    public function setAddressId($addressId) {
        $this->addressId = $addressId;
    }

    public function getCertificateId() {
        return $this->certificateId;
    }

    public function setCertificateId($certificateId) {
        $this->certificateId = $certificateId;
    }

    // create user
    public function createUser() {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO users (email_address, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // Sign in user
    public function signinUser($email, $password) {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE email_address = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // User signed in successfully
            $this->db->closeConnection();
            return $user; // Return the user data
        }

        $this->db->closeConnection();
        return null; // Return null if the user doesn't exist or the password is incorrect
    }

    // get user detail by id
    public function getUserDetails($user_id) {
        $conn = $this->db->getConnection();
    
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch();
    
        $this->db->closeConnection();
        return $user;
    }

    // update user detail
    
}