<?php
    require_once 'includes/header.php';
?>
<div class="container d-flex flex-column" style="min-height: 100vh;">
    <div class="d-flex flex-column container my-3 p-3">
        <h1 class="mb-5" style="font-weight: bold"><span style="color: black; background-color: #FFBF00; padding: 0 5px; border-radius: 10px;">404</span> not found!</h1>
        
        <p>The page you are looking for does not exist. Please check the URL and try again.</p>

    </div>

    <!-- action buttons -->
    <div class="container d-flex flex-row">
        <div class="mr-3">
            <a href="/web-programming-assignment/" class="hiredcmut-button">Go back to home</a>
        </div>

        <div>
            <a href="/web-programming-assignment/jobs" class="hiredcmut-button-light">View job listings</a>
        </div>
    </div>
</div>


<?php
    require_once 'includes/footer.php';
?>