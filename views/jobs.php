<?php
require_once 'includes/header.php';
$json = file_get_contents('mock.json');
$jobs = json_decode($json, true);

$location = isset($_GET['location']) ? $_GET['location'] : '';
$level = isset($_GET['level']) ? $_GET['level'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';
$minSalary = isset($_GET['minSalary']) ? $_GET['minSalary'] : '';
$maxSalary = isset($_GET['maxSalary']) ? $_GET['maxSalary'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$jobs = array_filter($jobs, function($job) use ($location, $level, $city, $minSalary, $maxSalary, $type) {
    return ($location == '' || $job['JobLocation'] == $location) &&
           ($level == '' || $job['Level'] == $level) &&
           ($city == '' || $job['CompanyLocation'] == $city) &&
           ($minSalary == '' || $job['Salary'] >= $minSalary) &&
           ($maxSalary == '' || $job['Salary'] <= $maxSalary) &&
           ($type == '' || $job['JobType'] == $type);
});


$totalJobCount = count($jobs);

$jobsPerPage = 5;
$totalPages = ceil($totalJobCount / $jobsPerPage);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startIndex = ($page - 1) * $jobsPerPage;
$jobsForCurrentPage = array_slice($jobs, $startIndex, $jobsPerPage);
?>

<div class="container-fluid">
    <?php
        echo "<h2 class='text-center py-3'>$totalJobCount jobs in Vietnam</h2>";
    ?>
</div>

<form id="filterForm" style="position: sticky; top: 0" class="container">
    <label for="location">Job Location:</label>
    <select id="location" name="location">
        <option value="">All</option>
        <option value="On-site">On-site</option>
        <option value="Remote">Remote</option>
    </select>

    <label for="level">Level:</label>
    <select id="level" name="level">
        <option value="">All</option>
        <option value="Entry-level">Entry-level</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Expert">Expert</option>
    </select>

    <label for="city">City:</label>
    <input type="text" id="city" name="city">

    <label for="minSalary">Minimum Salary:</label>
    <input type="text" id="minSalary" name="minSalary">

    <label for="maxSalary">Maximum Salary:</label>
    <input type="text" id="maxSalary" name="maxSalary">

    <label for="type">Type:</label>
    <select id="type" name="type">
        <option value="">All</option>
        <option value="Internship">Internship</option>
        <option value="Full-time">Full-time</option>
        <option value="Part-time">Part-time</option>
    </select>

    <input type="submit" value="Filter">
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
                <?php foreach ($jobsForCurrentPage as $job): ?>
                    <div class="card" onclick="highlightCard(this)" style="margin-bottom: 20px; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $job['Title'] ?></h5>
                            <p class="card-text"><?= $job['Company'] ?></p> <!-- Uncomment this line to include the company name -->
                            <p class="card-text">
                                <span class="badge badge-primary"><?= $job['Level'] ?></span>
                                <span class="badge badge-secondary"><?= $job['JobType'] ?></span>
                                <span class="badge badge-success"><?= $job['JobLocation'] ?></span>
                            </p>
                            <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?= $job['JobDescription'] ?></p>
                            <hr>
                            <p class="card-text">$<?= $job['Salary'] ?>/mo - <?= $job['DatePosted'] ?></p>
                            <p class="card-text" style="display: none;"><?= json_encode($job['Requirements']) ?></p>
                            <p class="card-text" style="display: none;"><?= json_encode($job['Benefits']) ?></p>
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
    highlightCard(firstCard);
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
        <h3 style="font-weight:bold">Skills and Experience</h3>
        <ul>
            ${JSON.parse(card.getElementsByClassName('card-text')[4].innerHTML).map(skill => `<li>${skill}</li>`).join('')}
        </ul>
        <hr>
        <h3 style="font-weight:bold">Benefits</h3>
        <ul>
            ${JSON.parse(card.getElementsByClassName('card-text')[5].innerHTML).map(benefit => `<li>${benefit}</li>`).join('')}
        </ul>
    `;
}
</script>

<?php
require_once 'includes/footer.php';
?>