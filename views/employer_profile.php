<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once __DIR__ . '/../controllers/EmployerController.php';
if (isset($_SESSION['employer'])) {
    $employer_id = $_SESSION['employer']['employer_id'];
    $employerController = new EmployerController();
    $employer_details = $employerController->getEmployerDetails($employer_id);

    $email_address = $employer_details['email_address'];
    $employer_name = $employer_details['employer_name'];
    $phone_no = $employer_details['phoneNo'];
    $address_id = $employer_details['address_id'];
    $about_us = $employer_details['about_us'];
}


// if address_id is not empty, get address details
if ($address_id != '') {
    require_once __DIR__ . '/../controllers/AddressController.php';
    $addressController = new AddressController();
    $addressObject = $addressController->getAddress($address_id);

    // Create variables for each field
    $streetNo = $addressObject->getStreetNo();
    $streetName = $addressObject->getStreetName();
    $ward = $addressObject->getWard();
    $district = $addressObject->getDistrict();
    $province = $addressObject->getProvince();

    // Combine them into a single string
    $address = implode(', ', [$streetNo, $streetName, $ward, $district, $province]);
} else {
    $address = '';
}

require_once 'includes/header.php';
require_once __DIR__ . '/../controllers/JobController.php';
    $jobController = new JobController();
    $jobs = $jobController->getJobsByEmployerId($employer_id);
?>

<div class="container pt-5" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-3">
            <!-- profile section with links -->
            <div class="list-group sticky-sidebar">
                <a href="#profile-overview" class="list-group-item list-group-item-action active" data-toggle="tab">
                    Profile Overview 
                </a>

                <a href="#my-application" class="list-group-item list-group-item-action" data-toggle="tab">
                    Job Posts <span class="badge badge-primary badge-pill"><?php echo count($jobs) ?></span>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active text-left" id="profile-overview">
                    <div id="summary" class="content-section">
                        <!-- Content for Summary -->
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/100" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <h2><?= $employer_name?></h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fas fa-envelope"></i> <?= $email_address ?></p>
                                <p><i class="fas fa-phone"></i> <?= ($phone_no != '') ? $phone_no : 'No phone number yet' ?><button class="icon-button" data-toggle="modal" data-target="#phoneModal"><i class="fa fa-pen"></i></button></p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?= ($address_id != '') ? $address : 'No address yet' ?>
                                    <?php if ($address_id != ''): ?>
                                        <button class="icon-button" data-toggle="modal" data-target="#updateAddressModal">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="icon-button" data-toggle="modal" data-target="#createAddressModal">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="about-us" class="content-section">
                        <!-- Content for About us -->
                        <div class="row d-flex align-items-center">
                            <h3 class="px-3">About Us</h3>
                            <br>
                            <button type="button" class="icon-button" data-toggle="modal" data-target="#aboutUsModal">
                                <i class="fas fa-pen"></i>
                            </button>
                        </div>
                        <hr>
                        <p><?= ($about_us != '') ? $about_us : 'Introduce who you are, what you do, and what experience you have.' ?></p>
                    </div>


                </div>

                <div class="tab-pane" id="my-application">
                    <?php
                    if (count($jobs) > 0) {
                        foreach ($jobs as $job) {
                            $jobApplicationController = new JobApplicationController();
                            $applications = $jobApplicationController->getJobApplicationByJobID($job['job_id']);
                            var_dump($applications);
                            echo '<div class="p-3 m-3" style="border: 2px solid #ffbf00; border-radius: 10px; text-align: left;">'; // This creates a smaller div for each application
                            echo '<h3>' . $job['job_name'] . '</h3>';
                            echo '<hr>';
                            echo '<p>' . 'Description: ' . $job['job_description'] . '</p>';
                            echo '<br>';
                            echo '<p>' . 'Date posted: ' . $job['date_posted'] . '</p>';
                            echo '<br>';
                            echo '<p>' . 'Number of applicants: ' . count($applications) . '</p>';
                            
                            echo '<a class="hiredcmut-button-light" href="/web-programming-assignment/job_details?id=' . $job['job_id'] . '">View Job</a>';

                            echo '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-success" role="alert">No job yet.</div>';
                    }
                    ?>
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- Phone Number Modal -->
<div class="modal" id="phoneModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Phone Number</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" id="phoneInput" value="<?= $phone_no ?>" maxlength="10">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updatePhoneNumber()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- about us modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" role="dialog" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aboutUsModalLabel">Update About Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="aboutUsForm">
          <div class="form-group">
            <label for="aboutUsText">About Us</label>
            <textarea class="form-control" id="aboutUsText" rows="3"><?= $about_us ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateAboutUs()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Update Address Modal -->
<div class="modal" id="updateAddressModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Address</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="updateStreetNumber">Street Number</label>
                    <input type="text" class="form-control" id="updateStreetNumber" value="<?= $streetNo ?>">
                </div>
                <div class="form-group">
                    <label for="updateStreetName">Street Name</label>
                    <input type="text" class="form-control" id="updateStreetName" value="<?= $streetName ?>">
                </div>
                <div class="form-group">
                    <label for="updateWard">Ward</label>
                    <input type="text" class="form-control" id="updateWard" value="<?= $ward ?>">
                </div>
                <div class="form-group">
                    <label for="updateDistrict">District</label>
                    <input type="text" class="form-control" id="updateDistrict" value="<?= $district ?>">
                </div>
                <div class="form-group">
                    <label for="updateProvince">Province</label>
                    <input type="text" class="form-control" id="updateProvince" value="<?= $province ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateAddress()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
    function updatePhoneNumber() {
        var phoneNo = document.getElementById('phoneInput').value;
        var employer_id = <?= json_encode($employer_id) ?>;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-employer-phone-number', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Phone number updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }
        xhr.send('employer_id=' + encodeURIComponent(employer_id) + '&phoneNo=' + encodeURIComponent(phoneNo));
    }

    function updateAboutUs() {
        var aboutUsText = document.getElementById('aboutUsText').value;
        var employer_id = <?= json_encode($employer_id) ?>;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-employer-about-us', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('About Us updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('employer_id=' + encodeURIComponent(employer_id) + '&aboutUs=' + encodeURIComponent(aboutUsText));
    }

    function updateAddress() {
        var streetNo = document.getElementById('updateStreetNumber').value;
        var streetName = document.getElementById('updateStreetName').value;
        var ward = document.getElementById('updateWard').value;
        var district = document.getElementById('updateDistrict').value;
        var province = document.getElementById('updateProvince').value;
        var address_id = <?= json_encode($address_id) ?>;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-employer-address', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Address updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('address_id=' + encodeURIComponent(address_id) + '&streetNo=' + encodeURIComponent(streetNo) + '&streetName=' + encodeURIComponent(streetName) + '&ward=' + encodeURIComponent(ward) + '&district=' + encodeURIComponent(district) + '&province=' + encodeURIComponent(province));
    }
</script>