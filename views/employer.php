<?php
// suppress warnings
error_reporting(E_ERROR | E_PARSE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $isUser = true;
} else if (isset($_SESSION['employer'])) {
    $isEmployer = true;
}
require_once 'includes/header.php';
?>

<style>
#signupForm .slide {
    display: none;
}
#signupForm .slide div {
    margin-bottom: 20px;
}
#signupForm input {
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}
#signupForm .button-row {
    display: flex;
    justify-content: space-between;
}

#signinForm input {
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}
</style>

<div class="container d-flex text-center align-items-center justify-content-center" style="min-height: 100vh">
    <?php if ($isUser): ?>
        <p> You need to be signed in as an employer to access this page. </p>
        <p> Did you forget to sign out? <a href="/web-programming-assignment/signout">Sign out</a></p>
    <?php elseif ($isEmployer): ?>
        <div>
            <h1>Welcome employer LMAO</h1>
        </div>
    <?php else: ?>
        <div class="col">
            <h1 id="slideTitle">Interested in recruiting via HiredCMUT?</h1>
            <button id="getStartedButton" type="button" class="hiredcmut-button-light">Get Started</button>
            <button id="signinButton" type="button" class="hiredcmut-button-light">Sign In</button>
            <!-- Multi-step form -->
            <form id="signupForm" action="/web-programming-assignment/employer-signup-action" method="post" style="display: none;">
                <div class="slide" data-title="What is your company name?">
                    <div>
                        <input type="text" id="name" name="name" placeholder="Company Name" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="nextSlide()">Next</button>
                    </div>
                </div>
                <div class="slide" data-title="Enter your email and password:">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                        <button type="button" class="hiredcmut-button-light" onclick="nextSlide()">Next</button>
                    </div>
                </div>
                <div class="slide" data-title="Where are you located?">
                    <div>
                        <input type="text" id="streetNo" name="streetNo" placeholder="Street No" required>
                    </div>
                    <div>
                        <input type="text" id="streetName" name="streetName" placeholder="Street Name" required>
                    </div>
                    <div>
                        <input type="text" id="ward" name="ward" placeholder="Ward" required>
                    </div>
                    <div>
                        <input type="text" id="district" name="district" placeholder="District" required>
                    </div>
                    <div>
                        <input type="text" id="province" name="province" placeholder="Province" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                        <button type="submit" class="hiredcmut-button-light">Submit</button>
                    </div>
                </div>
            </form>

            <form id="signinForm" action="/web-programming-assignment/employer-signin-action" method="post" style="display: none;">
                <div>
                    <input type="text" id="signin-email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" id="signin-password" name="password" placeholder="Password" required>
                </div>
                <div>
                    <button type="submit" class="hiredcmut-button">Sign In</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
$(document).ready(function() {
    var currentSlide = 0;
    var slides = $('#signupForm .slide').hide();

    function showSlide(n) {
        $('#slideTitle').text($(slides[n]).data('title'));
        $(slides[currentSlide]).fadeOut(400, function() {
            $(slides[n]).fadeIn(400);
            currentSlide = n;
        });
    }

    function nextSlide() {
        if (currentSlide < slides.length - 1) {
            showSlide(currentSlide + 1);
        }
    }

    function prevSlide() {
        if (currentSlide > 0) {
            showSlide(currentSlide - 1);
        }
    }

    $('#getStartedButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#signupForm').fadeIn(400);
            showSlide(0);
        });
        $('#signinButton').fadeOut(400); // Add this line
    });

    $('#signinButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#signinForm').fadeIn(400);
        });
        $('#getStartedButton').fadeOut(400); // Add this line
    });

    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
});
</script>