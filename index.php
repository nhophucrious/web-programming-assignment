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

// Get the current URI
$request = str_replace('/web-programming-assignment', '', $_SERVER['REQUEST_URI']);

// Handle the request based on the URI
switch ($request) {
    case '/' :
        $controller->home();
        break;
    case '/about' :
        $controller->about();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
        break;
}