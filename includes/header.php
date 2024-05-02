<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    $isSignedIn = true;
    $full_name = $_SESSION['user']['full_name'];
} else {
    $isSignedIn = false;
}
// get the current URI for highlighting the active link
$uri = $_SERVER['REQUEST_URI'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HiredCMUT</title>
    <link rel="stylesheet" href="/web-programming-assignment/static/css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/web-programming-assignment/static/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .navbar.navbar-expand-lg {
            background-color: #000 !important; /* Black background */
        }

        .navbar.navbar-expand-lg .navbar-nav .nav-link {
            color: #fff !important; /* White text */
        }

        .navbar.navbar-expand-lg .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important; /* White color for toggler icon */
        }

        .navbar.navbar-expand-lg .navbar-brand {
            color: #fff !important; /* White color for brand text */
        }

        .navbar.navbar-expand-lg .form-inline {
            background-color: #000 !important; /* Black background for form */
            color: #fff !important; /* White text for form */
        }

        .navbar.navbar-expand-lg .form-inline .form-control {
            background-color: #000 !important; /* Black background for input */
            color: #fff !important; /* White text for input */
        }

        .navbar.navbar-expand-lg .form-inline .btn {
            color: #000 !important; /* Black text for button */
            border-color: #fff !important; /* White border for button */
        }

        .navbar.navbar-brand {
            font-weight: bold !important; /* Bold text */
        }

        .navbar.navbar-expand-lg .navbar-nav .nav-link {
            font-weight: bold !important; /* Bold text */
        }

        .navbar.navbar-expand-lg .navbar-nav .active .nav-link {
            background-color: #FFBF00 !important; /* Yellow background when active */
            border-radius: 10px !important; /* Circular border */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark text-white sticky-top">
        <a class="navbar-brand" href="/web-programming-assignment/">HiredCMUT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $uri === '/web-programming-assignment/' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-assignment/">Home</a>
                </li>
                <li class="nav-item <?= strpos($uri, '/web-programming-assignment/jobs') === 0 ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-assignment/jobs">Jobs</a>
                </li>
                <li class="nav-item <?= $uri === '/web-programming-assignment/about' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-assignment/about">About</a>
                </li>
                <li class="nav-item <?= $uri === '/web-programming-assignment/employer' ? 'active' : '' ?>">
                    <a class="nav-link" href="/web-programming-assignment/employer">For Employers</a>
                </li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item <?= $uri === '/web-programming-assignment/profile' ? 'active' : '' ?>">
                        <a class="nav-link" href="/web-programming-assignment/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/web-programming-assignment/signout">Sign Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item <?= $uri === '/web-programming-assignment/signup' ? 'active' : '' ?>">
                        <a class="nav-link" href="/web-programming-assignment/signup">Sign Up</a>
                    </li>
                    <li class="nav-item <?= $uri === '/web-programming-assignment/signin' ? 'active' : '' ?>">
                        <a class="nav-link" href="/web-programming-assignment/signin">Sign In</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>