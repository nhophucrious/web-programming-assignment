<?php
require_once 'includes/header.php';
$json = file_get_contents('mock.json');
$jobs = json_decode($json, true);
$totalJobCount = count($jobs);
?>

<div class="container-fluid">
    <?php
        echo "<h2 class='text-center py-3'>$totalJobCount jobs in Vietnam</h2>";
    ?>
</div>

<div class="container-fluid py-5" style="background-color: #f0f5f9">
    <div class="container" style="min-height: 100vh;">
        <div class="row" style="min-height: 100vh">
            <!-- Job list column -->
            <div class="col-md-4">
                <?php foreach ($jobs as $job): ?>
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