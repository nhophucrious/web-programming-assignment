<!-- views/home.php -->

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
require_once 'includes/header.php';
require_once __DIR__ . '/../controllers/JobController.php';
$jobController = new JobController();
$jobs = $jobController->getAllJobs();
// limit home page to 6 jobs
$jobs = array_slice($jobs, 0, 6);
require_once __DIR__ . '/../controllers/EmployerController.php';
?>

<div class="hero py-5 container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <div class="hero-content container py-5" style="width: 100% !important">
        <h1 class="mb-4"><span style="color: black; background-color: #FFBF00; padding: 0 5px; border-radius: 10px;">Get employed</span> with HiredCMUT!</h1>        
        <?php
            if ($isSignedIn) {
                if (isset($full_name)) {
                    echo '<p>Welcome back, ' . $full_name . '!</p>';
                } else {
                    echo '<p>Welcome back!</p>';
                }
            } else {
                echo '<p>Find a job in an instant!</p>';
            }
        ?>
        <?php
            require_once 'includes/search_bar.php';
        ?>
    </div>
</div>

<?php

// TODO: if the user is logged in, show jobs that match their skills

?>


<div id="explore" class="container my-5" >
    <h2 class="text-center">New Jobs</h2>
</div>

<div class="container-fluid p-5" style="background-color: #f0f5f9">
    <div class="row p-5">
        <?php foreach ($jobs as $job): ?>
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 20px; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="job_details?id=<?= $job['job_id'] ?>" style="color: black"><?= $job['job_name'] ?></a>
                        </h5>
                        <?php
                            $employerController = new EmployerController();
                            $employer = $employerController->getEmployerDetails($job['employer_id']);
                        ?>                        
                        <p class="card-text"><?= $employer['employer_name'] ?></p>
                        <p class="card-text">
                            <span class="badge badge-primary"><?= $job['job_level'] ?></span>
                            <span class="badge badge-secondary"><?= $job['job_type'] ?></span>
                            <span class="badge badge-success"><?= $job['job_location'] ?></span>
                        </p>
                        <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?= $job['job_description'] ?></p>
                        <hr>
                        <p class="card-text">$<?= $job['salary'] ?>/mo - <span><i class="fa fa-calendar"></i></span> <?= $job['date_posted'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
    require_once 'includes/footer.php';
?>