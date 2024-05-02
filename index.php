<?php
// index.php

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
    case '/about' :
        $controller->about();
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
    case '/admin' :
        $controller->admin();
        break;
    case '/signup' :
        $controller->signup();
        break;
    case '/signin' :
        $controller->signin();
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
    case '/signout' :
        $userController->signoutUser();
    default:
        // http_response_code(404);
        // echo "Page not found";
        $controller->page_not_found();
        break;
}