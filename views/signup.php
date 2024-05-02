<?php
    require_once 'includes/header.php';
?>

<div class="container-fluid p-5 " style="min-height: 100vh;">
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12">
            <h3 style="font-weight: bold;">Welcome to HiredCMUT!</h3>
            <hr>
            <form action="/web-programming-assignment/process/process_signup.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                    <label class="form-check-label" for="privacy">By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>                </div>
                <button type="submit" class="hiredcmut-button-light">Sign Up</button>
            </form>
            <!-- already have an account? -->
            <hr>
            <p>Already have an account? <a href="signin">Sign in</a></p>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="signup-info-panel p-3">
                <h4>As a job seeker, you get</h4>
                <ul style="list-style: none">
                    <li>Personalized job recommendations</li>
                    <li>One-click job application</li>
                    <li>Notification for suitable jobs</li>
                </ul>
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
    var confirm_password = $('#confirm_password').val();
    // var role = $('#role').val();
    var privacy = $('#privacy').is(':checked');

    if (email == '' || password == '' || confirm_password == '' || !privacy) {
        alert('Please fill in all fields');
        e.preventDefault();
    } else if (password != confirm_password) {
        alert('Passwords do not match');
        e.preventDefault();
    }
    // TODO: add more validation rules here, eg, password length, password complexity, etc.
});

</script>