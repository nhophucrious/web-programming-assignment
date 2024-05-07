<?php
require_once 'includes/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    if ($message === 'Job application created successfully.') {
        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
    }
    unset($_SESSION['message']); // Remove the message from the session
}
// this only serves when the user clicks job link from the home page
if (isset($_GET['id'])) {
    require_once __DIR__ . '/../controllers/JobController.php';
    $jobController = new JobController();
    $job = $jobController->getJobById($_GET['id']);

    if ($job) {
        require_once __DIR__ . '/../controllers/EmployerController.php';
        require_once __DIR__ . '/../controllers/AddressController.php';
        $employerController = new EmployerController();
        $employer = $employerController->getEmployerDetails($job['employer_id']);

        $addressController = new AddressController();
        $address = $addressController->getAddress($employer['address_id']);
        $streetNo = $address->getStreetNo();
        $streetName = $address->getStreetName();
        $ward = $address->getWard();
        $district = $address->getDistrict();
        $province = $address->getProvince();
    }

    $userId = $_SESSION['user']['user_id'] ?? '';
}
?>

<script>
    var userId = '<?php echo $_SESSION['user']['user_id'] ?? ''; ?>'; // if no user is logged in, set userId to empty string
</script>


<div class="container" style="min-height: 100vh">
    <div class="pt-4">
        <?php if (!$job): ?>
            <div class="p-4">
                <a href="jobs" class="hiredcmut-button m-3">Back to jobs</a>
            </div>
            <div class="text-center">
                <h1 class='text-center'>Job not found 😬</h1>
                <p>No job was found with the given ID. Please try again.</p>
            </div>
        <?php else: ?>
            <div class="p-4">
                <a href="jobs" class="hiredcmut-button m-3">Back to jobs</a>
            </div>
            <h2><?= $job['job_name'] ?></h2>
            <p><i class="fas fa-building"></i> <?= $employer['employer_name'] ?></p>
            <p><i class="fas fa-map-marker-alt"></i> <?= $streetNo . ' ' . $streetName . ', ' . $ward . ', ' . $district . ', ' . $province ?></p>
            <p><i class="fas fa-dollar-sign"></i> <?= $job['salary'] ?> / month</p>
            <p>
                <span class="badge badge-success"><?= $job['job_type'] ?></span>
                <span class="badge badge-success"><?= $job['job_level'] ?></span>
                <span class="badge badge-success"><?= $job['job_location'] ?></span>
            </p>
            <form action="/web-programming-assignment/add-job-application" method="post" onsubmit="return checkUserId()">
                <input type="hidden" name="user_id" value="<?= $userId ?>">
                <input type="hidden" name="job_id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="date_applied" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <div class="d-flex">
                    <button type="submit" class="text-center py-2" style="width: 100%; color: white; font-weight: bold; background-color: #ffbf00; border-radius: 10px">Apply now</button>
                </div>
            </form>
            <hr>
            <h3 style="font-weight:bold">Job Description</h3>
            <p><?= $job['job_description'] ?></p>
            <hr>
            <h3 style="font-weight:bold">Job Requirements</h3>
            <p><?= $job['job_requirement'] ?></p>
            <hr>
            <h3 style="font-weight:bold">Job Benefits</h3>
            <p><?= $job['job_benefit'] ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Sign In Required</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please sign in to apply for a job.
      </div>
      <div class="modal-footer">
        <button type="button" class="hiredcmut-button" data-dismiss="modal">Close</button>
        <a href="/web-programming-assignment/signin" class="hiredcmut-button-light">Sign In</a>
      </div>
    </div>
  </div>
</div>

<?php 
require_once 'includes/footer.php';
?>

<script>
    function checkUserId() {
        if (userId === '') {
            $('#loginModal').modal('show');
            return false;
        }
        return true;
    }
</script>