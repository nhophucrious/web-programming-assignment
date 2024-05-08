<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/header.php';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    if ($message === 'User created successfully. You can now sign in.') {
        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
    }
    unset($_SESSION['message']); // Remove the message from the session
}

unset($_SESSION['message']);

?>

<div class="container-fluid p-5 " style="min-height: 100vh;">
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12">
            <h3 style="font-weight: bold;">Welcome to HiredCMUT!</h3>
            <hr>
            <form action="/web-programming-assignment/signin-action" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="hiredcmut-button-light">Sign In</button>
            </form>
            <!-- already have an account? -->
            <hr>
            <p>Do not have an account yet? <a href="signin">Sign up</a></p>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="signup-info-panel p-3">
                <h4>Welcome back!</h4>
                <hr>
                <p>Sign in to access your personalized job recommendations, one-click job application, and notification for suitable jobs.</p>
            </div>            
        </div>
    </div>
</div>

<?php
    require_once 'includes/footer.php';
?>

<script>
// validate fields with jQuery
$('form').submit(function(e) {
    var email = $('#email').val();
    var password = $('#password').val();

    if (email == '' || password == '') {
        alert('Please fill in all fields');
        e.preventDefault();
    } else if (!email.includes('@')) {
        alert('Invalid email address');
        e.preventDefault();
    }
    // TODO: Add more validation rules
});

</script>