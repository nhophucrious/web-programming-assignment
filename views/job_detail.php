<?php
require_once 'includes/header.php';
// this only serves when the user clicks job link from the home page
if (isset($_GET['id'])) {
    require_once __DIR__ . '/../controllers/JobController.php';
    $jobController = new JobController();
    $job = $jobController->getJobById($_GET['id']);
}
?>

<div class="container" style="min-height: 100vh">
    <div class="pt-4">
        <div class="p-4">
            <a href="jobs" class="hiredcmut-button m-3">Back to jobs</a>
        </div>
        <h2><?= $job['job_name'] ?></h2>
        <p><?= $job['employer_id'] ?></p>
        <div class="d-flex">
            <a href="" class="text-center py-2" style="width: 100%; color: white; font-weight: bold; background-color: #ffbf00; border-radius: 10px">Apply now</a>
        </div>
        <hr>
        <h3 style="font-weight:bold">Job Description</h3>
        <p><?= $job['job_description'] ?></p>
        <hr>
        <h3 style="font-weight:bold">Job Requirements</h3>
        <p><?= $job['job_requirement'] ?></p>
        <hr>
        <h3 style="font-weight:bold">Job Benefits</h3>
        <p><?= $job['job_benefit'] ?></p>
    </div>
</div>



<?php 
require_once 'includes/footer.php';
?>