<!-- views/home.php -->

<?php 
    require_once 'includes/header.php';
?>

<div class="hero py-5 container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <div class="hero-content container py-5" style="width: 100% !important">
        <h1 class="mb-5"><span style="color: black; background-color: #FFBF00; padding: 0 5px; border-radius: 10px;">Get employed</span> with HiredCMUT! 💪</h1>        
        <p>Find a job in an instant!</p>
        <!-- button to explore now, scrolls down to new section -->
        <a id="explore-btn" href="#explore">Explore Now</a>
    </div>
</div>

<div id="explore" class="container my-5">
    <h2 class="text-center">New Jobs</h2>
    <div class="row">
</div>
</div>
<?php
    require_once 'includes/footer.php';
?>