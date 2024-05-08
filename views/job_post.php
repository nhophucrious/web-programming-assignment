<?php
// suppress warnings
error_reporting(E_ERROR | E_PARSE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/header.php';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    if ($message === 'Job created successfully') {
        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
    }
    unset($_SESSION['message']); // Remove the message from the session
}

require_once __DIR__ . '/../controllers/EmployerController.php';
require_once __DIR__ . '/../controllers/JobController.php';
if (isset($_SESSION['employer'])) {
    $employer_id = $_SESSION['employer']['employer_id'];
    $jobController = new JobController();
    $jobs = $jobController->getJobsByEmployerId($employer_id);
}
?>

<style>
#addJob .slide {
    display: none;
}
#addJob .slide div {
    margin-bottom: 20px;
}
#addJob input {
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}
#addJob .button-row {
    display: flex;
    justify-content: space-between;
}
</style>

<div class="container d-flex text-center align-items-center justify-content-center" style="min-height: 100vh">
    <div class="col">
        <h1 id="slideTitle">Edit your listings</h1>
        <button id="addJobButton" type="button" class="hiredcmut-button-light">Add new job</button>
        <button id="removeJobButton" type="button" class="hiredcmut-button-light">Remove existing job</button>

        <form id="addJob" action="/web-programming-assignment/add-job-action" method="post" style="display: none;">
            <div class="slide" data-title="What's the name of the job?">
                <div>
                    <input type="text" id="job_name" name="job_name" placeholder="Job Name" class="form-control" required>
                </div>
                
                <div class="button-row">
                    <button type="button" class="hiredcmut-button" onclick="nextSlide()">Next</button>
                </div>
            </div>
            <div class="slide" data-title="Essential details for the job">
                <div>
                    <label for="job_location">Location:</label>
                    <select id="job_location" name="job_location" class="form-control">
                        <option value="">All</option>
                        <option value="On-site" <?= isset($_GET['location']) && $_GET['location'] == 'On-site' ? 'selected' : '' ?>>On-site</option>
                        <option value="Remote" <?= isset($_GET['location']) && $_GET['location'] == 'Remote' ? 'selected' : '' ?>>Remote</option>
                    </select>
                </div>
                <div>
                    <label for="job_level">Level:</label>
                    <select id="job_level" name="job_level" class="form-control">
                        <option value="">All</option>
                        <option value="Entry-level" <?= isset($_GET['level']) && $_GET['level'] == 'Entry-level' ? 'selected' : '' ?>>Entry-level</option>
                        <option value="Intermediate" <?= isset($_GET['level']) && $_GET['level'] == 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
                        <option value="Expert" <?= isset($_GET['level']) && $_GET['level'] == 'Expert' ? 'selected' : '' ?>>Expert</option>
                    </select>
                </div>
                <div>
                    <label for="job_type">Type:</label>
                    <select id="job_type" name="job_type" class="form-control">
                        <option value="">All</option>
                        <option value="Internship" <?= isset($_GET['type']) && $_GET['type'] == 'Internship' ? 'selected' : '' ?>>Internship</option>
                        <option value="Full-time" <?= isset($_GET['type']) && $_GET['type'] == 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                        <option value="Part-time" <?= isset($_GET['type']) && $_GET['type'] == 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                    </select>
                </div>
                <div>
                    <label for="salary">Salary:</label>
                    <input type="number" id="salary" name="salary" min="0" class="form-control" value="<?= isset($_GET['Salary']) ? htmlspecialchars($_GET['Salary']) : '' ?>">
                </div>
                <div class="button-row">
                    <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                    <button type="button" class="hiredcmut-button-light" onclick="nextSlide()">Next</button>
                </div>
            </div>
            <div class="slide" data-title="Describe your job in more details">
                <div>
                    <label for="job_description">Description:</label>
                    <textarea id="job_description" name="job_description" class="form-control" required></textarea>
                </div>
                <div>
                    <label for="job_requirement">Requirements:</label>
                    <textarea id="job_requirement" name="job_requirement" class="form-control" required></textarea>
                </div>
                <div>
                    <label for="job_benefit">Benefits:</label>
                    <textarea id="job_benefit" name="job_benefit" class="form-control" required></textarea>
                </div>
                <div>
                    <input type="hidden" name="employer_id" value="<?= htmlspecialchars($employer_id) ?>">
                    <input type="hidden" name="date_posted" value="<?= date('Y-m-d H:i:s') ?>">
                </div>
                <div class="button-row">
                    <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                    <button type="submit" class="hiredcmut-button-light">Submit</button>
                </div>
            </div>
        </form>

        <form id="removeJob" action="/web-programming-assignment/add-job-action" method="post" style="display: none;">
            <div>
                <label for="job_id">Select job to remove:</label>
                <select id="job_id" name="job_id" class="form-control">
                    <?php foreach ($jobs as $job): ?>
                        <option value="<?= htmlspecialchars($job['job_id']) ?>"><?= htmlspecialchars($job['job_title']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="hiredcmut-button">Remove</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>

<script>
    var currentSlide = 0;
    var slides = $('#addJob .slide').hide();

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

    $('#addJobButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#addJob').fadeIn(400);
            showSlide(0);
        });
        $('#removeJobButton').fadeOut(400); // Add this line
    });

    $('#removeJobButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#removeJob').fadeIn(400);
        });
        $('#addJobButton').fadeOut(400); // Add this line
    });

    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;

</script>