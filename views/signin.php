<?php
    require_once 'includes/header.php';
?>

<div class="container-fluid p-5 " style="min-height: 100vh;">
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12">
            <h3 style="font-weight: bold;">Welcome to HiredCMUT!</h3>
            <hr>
            <form action="signup_process.php" method="post">
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