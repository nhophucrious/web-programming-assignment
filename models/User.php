<?php
// Path: models/User.php
class User
{
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
    private $skills;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    // create user
    public function createUser()
    {
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
    public function signinUser($email, $password)
    {
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
    public function getUserDetails($user_id)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch();

        $this->db->closeConnection();
        return $user;
    }

    // search user with a query string
    public function searchUser($searchQuery)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT * FROM users WHERE first_name LIKE :searchQuery OR last_name LIKE :searchQuery OR email_address LIKE :searchQuery OR skills LIKE :searchQuery OR title LIKE :searchQuery";        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        $stmt->execute();
        $users = $stmt->fetchAll();

        $this->db->closeConnection();
        return $users;
    }

    // update user detail
    public function updateUser($user_id, $email, $first_name, $last_name, $password, $title, $phoneNo, $avatar, $gender, $dob, $aboutMe, $addressId, $skills)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET email_address = :email, first_name = :first_name, last_name = :last_name, password = :password, title = :title, phone_no = :phoneNo, avatar = :avatar, gender = :gender, dob = :dob, about_me = :aboutMe, address_id = :addressId, skills = :skills WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':aboutMe', $aboutMe);
        $stmt->bindParam(':addressId', $addressId);
        $stmt->bindParam(':skills', $skills);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update title 
    public function updateTitle($user_id, $title)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET title = :title WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update phone number
    public function updatePhoneNumber($user_id, $phoneNo)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET phone_no = :phoneNo WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':phoneNo', $phoneNo);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
    // Update avatar
    public function updateAvatar($user_id, $avatar)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET avatar = :avatar WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update gender (gender is a boolean value)
    public function updateGender($user_id, $gender)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET gender = :gender WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':gender', $gender);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update dob
    public function updateDob($user_id, $dob)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET dob = :dob WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':dob', $dob);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update address id
    public function updateAddressId($user_id, $addressId)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET address_id = :addressId WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':addressId', $addressId);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update about me
    public function updateAboutMe($user_id, $aboutMe)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET about_me = :aboutMe WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':aboutMe', $aboutMe);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }

    // update skills
    public function updateSkills($user_id, $skills)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET skills = :skills WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':skills', $skills);
        $stmt->execute();

        $this->db->closeConnection();
        return true;
    }
}