<?php
require_once 'includes/header.php';
/*
$json = file_get_contents('mock.json');
$jobs = json_decode($json, true);
});
*/

require_once __DIR__ . '/../controllers/JobController.php';
$jobController = new JobController();
$jobs = $jobController->getAllJobs();

$location = isset($_GET['location']) ? $_GET['location'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : '';
$minSalary = isset($_GET['minSalary']) ? $_GET['minSalary'] : '';
$maxSalary = isset($_GET['maxSalary']) ? $_GET['maxSalary'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$jobs = array_filter($jobs, function($job) use ($location, $level, $minSalary, $maxSalary, $type) {
    return ($location == '' || $job['job_location'] == $location) &&
           ($level == '' || $job['job_level'] == $level) &&
           ($minSalary == '' || $job['salary'] >= $minSalary) &&
           ($maxSalary == '' || $job['salary'] <= $maxSalary) &&
           ($type == '' || $job['job_type'] == $type);
});

$totalJobCount = count($jobs);
$jobsPerPage = 2;
$totalPages = ceil($totalJobCount / $jobsPerPage);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startIndex = ($page - 1) * $jobsPerPage;
$jobsForCurrentPage = array_slice($jobs, $startIndex, $jobsPerPage);
// var_dump($jobs);
?>

<div class="container-fluid">
    <?php
        echo "<h2 class='text-center py-3'>$totalJobCount jobs in Vietnam</h2>";
    ?>
</div>

<form id="filterForm" class="container py-3 bg-light rounded">
    <div class="row">
        <div class="col-md-2">
            <label for="location">Job Location:</label>
            <select id="location" name="location" class="form-control">
                <option value="">All</option>
                <option value="On-site" <?= isset($_GET['location']) && $_GET['location'] == 'On-site' ? 'selected' : '' ?>>On-site</option>
                <option value="Remote" <?= isset($_GET['location']) && $_GET['location'] == 'Remote' ? 'selected' : '' ?>>Remote</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="level">Level:</label>
            <select id="level" name="level" class="form-control">
                <option value="">All</option>
                <option value="Entry-level" <?= isset($_GET['level']) && $_GET['level'] == 'Entry-level' ? 'selected' : '' ?>>Entry-level</option>
                <option value="Intermediate" <?= isset($_GET['level']) && $_GET['level'] == 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
                <option value="Expert" <?= isset($_GET['level']) && $_GET['level'] == 'Expert' ? 'selected' : '' ?>>Expert</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="minSalary">Min Salary:</label>
            <input type="text" id="minSalary" name="minSalary" class="form-control" value="<?= isset($_GET['minSalary']) ? htmlspecialchars($_GET['minSalary']) : '' ?>">
        </div>

        <div class="col-md-2">
            <label for="maxSalary">Max Salary:</label>
            <input type="text" id="maxSalary" name="maxSalary" class="form-control" value="<?= isset($_GET['maxSalary']) ? htmlspecialchars($_GET['maxSalary']) : '' ?>">
        </div>

        <div class="col-md-2">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control">
                <option value="">All</option>
                <option value="Internship" <?= isset($_GET['type']) && $_GET['type'] == 'Internship' ? 'selected' : '' ?>>Internship</option>
                <option value="Full-time" <?= isset($_GET['type']) && $_GET['type'] == 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                <option value="Part-time" <?= isset($_GET['type']) && $_GET['type'] == 'Part-time' ? 'selected' : '' ?>>Part-time</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <input type="submit" value="Filter" class="hiredcmut-button-light w-100">
        </div>
    </div>
</form>

<div class="container-fluid py-5" style="background-color: #f0f5f9">
    <!-- Pagination -->
    <div class="pagination text-center m-2">
        <a href="jobs?page=<?= max(1, $page-1) ?>" class="btn btn-primary pagination-nav">&laquo;</a>
        <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = $i == $page ? 'active' : '';
                echo "<a href='jobs?page=$i' class='btn btn-primary pagination-link $activeClass'>$i</a>";
            }
        ?>
        <a href="jobs?page=<?= min($totalPages, $page+1) ?>" class="btn btn-primary pagination-nav">&raquo;</a>
    </div>
    <div class="container" style="min-height: 100vh;">
        <div class="row" style="min-height: 100vh">
            <!-- Job list column -->
            <div class="col-md-4">
                <?php if (count($jobsForCurrentPage) == 0): ?>
                    <div class="alert alert-warning">No jobs matching the criteria</div>
                <?php endif; ?>
                <?php foreach ($jobsForCurrentPage as $job): ?>
                    <div class="card" onclick="highlightCard(this)" style="margin-bottom: 20px; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $job['job_name'] ?></h5>
                            <p class="card-text"><?= $job['employer_id'] ?></p> <!-- Uncomment this line to include the company name -->
                            <p class="card-text">
                                <span class="badge badge-primary"><?= $job['job_level'] ?></span>
                                <span class="badge badge-secondary"><?= $job['job_type'] ?></span>
                                <span class="badge badge-success"><?= $job['job_location'] ?></span>
                            </p>
                            <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?= $job['job_description'] ?></p>
                            <hr>
                            <p class="card-text">$<?= $job['salary'] ?>/mo - <?= $job['date_posted'] ?></p>
                            <p class="card-text" style="display: none;"><?= json_encode($job['job_requirement']) ?></p>
                            <p class="card-text" style="display: none;"><?= json_encode($job['job_benefit']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Job details column -->
            <div class="col-md-8 p-3" id="jobDetails" style="background-color: white; border-radius: 10px;">
                <!-- Job details will be populated here -->
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="pagination text-center m-2">
        <a href="jobs?page=<?= max(1, $page-1) ?>" class="btn btn-primary pagination-nav">&laquo;</a>
        <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = $i == $page ? 'active' : '';
                echo "<a href='jobs?page=$i' class='btn btn-primary pagination-link $activeClass'>$i</a>";
            }
        ?>
        <a href="jobs?page=<?= min($totalPages, $page+1) ?>" class="btn btn-primary pagination-nav">&raquo;</a>
    </div>
</div>


<script>
window.onload = function() {
    var firstCard = document.getElementsByClassName('card')[0];
    if (firstCard) {
        highlightCard(firstCard);
    } else {
        var jobDetails = document.getElementById('jobDetails');
        jobDetails.innerHTML = '<p class="text-center">Please update your filter!</p>';
    }
}

function highlightCard(card) {
    // Remove highlight from all cards
    var cards = document.getElementsByClassName('card');
    for (var i = 0; i < cards.length; i++) {
        cards[i].style.boxShadow = 'none';
    }

    // Highlight the selected card
    card.style.boxShadow = '0 0 0 2px #ffbf00';

    // Populate the job details
    var jobDetails = document.getElementById('jobDetails');
    jobDetails.innerHTML = `
        <h2>${card.getElementsByClassName('card-title')[0].innerText}</h2>
        <p>${card.getElementsByClassName('card-text')[0].innerText}</p>
        <div class="d-flex">
        <a href="" class="text-center py-2" style="width: 100%; color: white; font-weight: bold; background-color: #ffbf00; border-radius: 10px">Apply now</a>
        </div>
        <hr>
        <h3 style="font-weight:bold">Job Description</h3>
        <p>${card.getElementsByClassName('card-text')[2].innerText}</p>
        <hr>
        <h3 style="font-weight:bold">Job Requirements</h3>
        <p>${card.getElementsByClassName('card-text')[4].innerText}</p>
        <hr>
        <h3 style="font-weight:bold">Job Benefits</h3>
        <p>${card.getElementsByClassName('card-text')[5].innerText}</p>
    `;
}
</script>

<?php
require_once 'includes/footer.php';
?>