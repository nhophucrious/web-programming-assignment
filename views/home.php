<!-- views/home.php -->

<?php 
    require_once 'includes/header.php';
?>

<div class="hero container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <h1>Welcome to HiredCMUT!</h1>
    <p>Find a job in an instant!</p>
    <!-- button to explore now, scrolls down to new section -->
    <a id="explore-btn" href="#explore">Explore Now</a>
</div>

<div id="explore" class="container my-5">
    <h2 class="text-center">Popular Jobs</h2>
    <div class="row">
</div>
</div>
<?php
    require_once 'includes/footer.php';
?>