<!-- views/home.php -->

<?php 
    require_once 'includes/header.php';
    $json = file_get_contents('mock.json');
    $jobs = json_decode($json, true);
    // limit home page to 6 jobs
    $jobs = array_slice($jobs, 0, 6);
?>

<div class="hero py-5 container-fluid text-center d-flex flex-column justify-content-center align-items-center">
    <div class="hero-content container py-5" style="width: 100% !important">
        <h1 class="mb-2"><span style="color: black; background-color: #FFBF00; padding: 0 5px; border-radius: 10px;">Get employed</span> with HiredCMUT!</h1>        
        <p>Find a job in an instant!</p>
        <?php
            require_once 'includes/search_bar.php';
        ?>
    </div>
</div>

<div id="explore" class="container my-5" >
    <h2 class="text-center">New Jobs</h2>
</div>

<div class="container-fluid p-5" style="background-color: #f0f5f9">
    <div class="row">
        <?php foreach ($jobs as $job): ?>
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 20px; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $job['Title'] ?></h5>
                        <p class="card-text"><?= $job['Company'] ?></p>
                        <p class="card-text">
                            <span class="badge badge-primary"><?= $job['Level'] ?></span>
                            <span class="badge badge-secondary"><?= $job['JobType'] ?></span>
                            <span class="badge badge-success"><?= $job['JobLocation'] ?></span>
                        </p>
                        <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?= $job['JobDescription'] ?></p>
                        <hr>
                        <p class="card-text">$<?= $job['Salary'] ?>/mo - <span><i class="fa fa-calendar"></i></span> <?= $job['DatePosted'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<?php
    require_once 'includes/footer.php';
?>