<?php
// index.php
session_start();
// Autoload classes
spl_autoload_register(function ($class_name) {
    if (file_exists('./controllers/' . $class_name . '.php')) {
        require_once './controllers/' . $class_name . '.php';
    } else if (file_exists('./models/' . $class_name . '.php')) {
        require_once './models/' . $class_name . '.php';
    }
});

// Create a new instance of the main controller
$controller = new Controller();
$userController = new UserController();
$addressController = new AddressController();

// Get the current URI
$request = str_replace('/web-programming-assignment', '', $_SERVER['REQUEST_URI']);

// Ignore URL paramters for route matching
$request = explode('?', $request)[0];

// Handle the request based on the URI
switch ($request) {
    case '/' :
    case '/index' :
        $controller->home();
        break;
    case '/jobs' :
        $controller->jobs();
        break;
    case '/employer':
        $controller->employer();
        break;    
    case '/profile' :
        $controller->profile();
        break;
    case '/employer-profile' :
        $controller->employerProfile();
        break;
    case '/admin' :
        $controller->admin();
        break;
    case '/signup' :
        $controller->signup();
        break;
    case '/signin' :
        $controller->signin();
        break;
    case '/job_details' :
        $controller->job_details();
        break;
    case '/signin-action' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->signinUser($_POST['email'], $_POST['password']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/signup-action' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->createUser($_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['password']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/employer-signup-action':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employerController = new EmployerController();
            $employerController->createEmployer($_POST['email'], $_POST['name'], $_POST['password'], $_POST['streetNo'], $_POST['streetName'], $_POST['ward'], $_POST['district'], $_POST['province'], $_POST['phoneNo']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/employer-signin-action':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employerController = new EmployerController();
            $employerController->signinEmployer($_POST['email'], $_POST['password']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/create-address' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $addressController = new AddressController();
            $address_id = $addressController->createAddress($_POST['streetNo'], $_POST['streetName'], $_POST['ward'], $_POST['district'], $_POST['province']);
            $user_id = $_SESSION['user']['user_id'];
            var_dump($user_id);
            var_dump($address_id);
            $userController->updateAddressId($user_id, $address_id);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-address' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $addressController = new AddressController();
            $address_id = $addressController->createAddress($_POST['streetNo'], $_POST['streetName'], $_POST['ward'], $_POST['district'], $_POST['province']);
            $user_id = $_POST['user_id'];
            $userController->updateAddressId($user_id, $address_id);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-title' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateTitle($_POST['user_id'], $_POST['title']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-phone-number' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updatePhoneNumber($_POST['user_id'], $_POST['phoneNo']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-gender' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateGender($_POST['user_id'], $_POST['gender']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-dob' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateDob($_POST['user_id'], $_POST['dob']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-about-me' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateAboutMe($_POST['user_id'], $_POST['aboutMe']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/add-education' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $educationController = new EducationController();
            $educationController->createEducation($_POST['user_id'], $_POST['degreeName'], $_POST['institutionName'], $_POST['startYear'], $_POST['endYear']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/delete-education' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $educationController = new EducationController();
            $educationController->deleteEducation($_POST['education_id']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/add-exp' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $expController = new ExpController();
            $expController->createExp($_POST['expName'], $_POST['yearStart'], $_POST['yearEnd'], $_POST['expDescription'], $_POST['user_id']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/delete-exp' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $expController = new ExpController();
            $expController->deleteExp($_POST['exp_id']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/add-certificate' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $certificateController = new CertificateController();
            $certificateController->createCertificate($_POST['user_id'], $_POST['certificateName'], $_POST['issuer'], $_POST['yearIssued'], $_POST['link']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/delete-certificate' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $certificateController = new CertificateController();
            $certificateController->deleteCertificate($_POST['certificate_id']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-skills' :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateSkills($_POST['user_id'], $_POST['skills']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-employer-phone-number':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employerController = new EmployerController();
            $employerController->updatePhoneNumber($_POST['employer_id'], $_POST['phoneNo']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-employer-about-us':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employerController = new EmployerController();
            $employerController->updateAboutUs($_POST['employer_id'], $_POST['aboutUs']);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/update-employer-address':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $streetNo = $_POST['streetNo'];
            $streetName = $_POST['streetName'];
            $ward = $_POST['ward'];
            $district = $_POST['district'];
            $province = $_POST['province'];
            $address_id = $_POST['address_id'];
            $addressController = new AddressController();
            $addressController->updateAddress($address_id, $streetNo, $streetName, $ward, $district, $province);
        } else {
            $controller->page_not_found();
        }
        break;
    case '/signout' :
        $userController->signoutUser();
    default:
        // http_response_code(404);
        // echo "Page not found";
        $controller->page_not_found();
        break;
}