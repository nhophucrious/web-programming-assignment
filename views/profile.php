<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// get user details
require_once __DIR__ . '/../controllers/UserController.php';
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];
    $userController = new UserController();
    $user_details = $userController->getUserDetails($user_id);

    $user_id = $user_details['user_id'];
    $email_address = $user_details['email_address'];
    $password = $user_details['password'];
    $first_name = $user_details['first_name'];
    $last_name = $user_details['last_name'];
    $title = $user_details['title'];
    $phone_no = $user_details['phone_no'];
    $avatar = $user_details['avatar'];
    $gender = $user_details['gender'];
    $dob = $user_details['dob'];
    $about_me = $user_details['about_me'];
    $address_id = $user_details['address_id'];
    $skills = $user_details['skills'];
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
// $skills = array("Java", "Python", "JavaScript", "Spring Boot", "React", "Angular", "Git", "Docker", "Jenkins");
$applications = array();
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
                    My Applications <span class="badge badge-primary badge-pill"><?php echo count($applications) ?></span>
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
                                <h2><?= $full_name?></h2>
                                <p><?= ($title != '') ? $title : 'No title yet' ?> <span><button type="button" class="icon-button" data-toggle="modal" data-target="#titleModal">
                                <i class="fas fa-pen"></i>
                            </button></span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fas fa-envelope"></i> <?= $email_address ?></p>
                                <p><i class="fas fa-phone"></i> <?= ($phone_no != '') ? $phone_no : 'No phone number yet' ?><button class="icon-button" data-toggle="modal" data-target="#phoneModal"><i class="fa fa-pen"></i></button></p>
                                <p><i class="fas fa-user"></i>  <?= ($gender != '') ? ($gender === "1") ? "Female" : "Male" : 'No gender yet' ?><button class="icon-button" data-toggle="modal" data-target="#genderModal"><i class="fa fa-pen"></i></button></p>
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
                                <p><i class="fas fa-birthday-cake"></i> <?= ($dob != '') ? $dob : 'No date of birth yet' ?><button class="icon-button" data-toggle="modal" data-target="#dobModal"><i class="fa fa-pen"></i></button></p>
                            </div>
                        </div>
                    </div>
                    <div id="about-me" class="content-section">
                        <!-- Content for About Me -->
                        <div class="row d-flex align-items-center">
                            <h3 class="px-3">About Me</h3>
                            <br>
                            <button type="button" class="icon-button" data-toggle="modal" data-target="#aboutMeModal">
                                <i class="fas fa-pen"></i>
                            </button>
                        </div>
                        <hr>
                        <p><?= ($about_me != '') ? $about_me : 'Introduce who you are, what you do, and what experience you have.' ?></p>
                    </div>
                    <div id="education" class="content-section">
                        <!-- Content for Education -->
                        <h3>Education</h3>
                        <hr>
                        <!-- <ul>
                            <li>
                                <h4>University</h4>
                                <p>Computer Science</p>
                                <p>2019 - 2023</p>
                            </li>
                            <li>
                                <h4>High School</h4>
                                <p>Mathematics</p>
                                <p>2016 - 2019</p>
                            </li>
                        </ul> -->
                        <p>Education details not available yet.</p>
                    </div>
                    <div id="work-exp" class="content-section">
                        <!-- Content for Work Experience -->
                        <h3>Work Experience</h3>
                        <hr>
                        <!-- <ul>
                            <li>
                                <h4>Company A</h4>
                                <p>Software Engineer</p>
                                <p>2021 - Present</p>
                            </li>
                            <li>
                                <h4>Company B</h4>
                                <p>Intern</p>
                                <p>2020 - 2021</p>
                            </li>
                        </ul> -->
                        <p>Work experience details not available yet.</p>
                    </div>
                    <div id="skills" class="content-section">
                        <!-- Content for Skills -->
                        <div class="row d-flex align-items-center">
                            <h3 class="px-3">Skills</h3>
                            <br>
                            <button type="button" class="icon-button" data-toggle="modal" data-target="#skillsModal">
                                <i class="fas fa-pen"></i>
                            </button>
                        </div>
                        <hr>
                        
                        <p><?= ($skills != '') ? $skills : 'No skills yet' ?></p>
                    </div>
                    <div id="certificates" class="content-section">
                        <!-- Content for Certificates -->
                        <h3>Certificates</h3>
                        <hr>
                        <!-- <ul>
                            <li>
                                <h4>Java Programming</h4>
                                <p>Issued by Oracle</p>
                                <p>2020</p>
                            </li>
                            <li>
                                <h4>Python Programming</h4>
                                <p>Issued by Python Software Foundation</p>
                                <p>2021</p>
                            </li>
                            <li>
                                <h4>IELTS</h4>
                                <p>Issued by British Council</p>
                                <p>2022</p>
                            </li>
                        </ul> -->
                        <p>Certificates not available yet.</p>
                    </div>
                </div>

                <div class="tab-pane" id="my-application">
                    <?php
                    if (count($applications) > 0) {
                        foreach ($applications as $application) {
                            echo "<p>$application</p>";
                        }
                    } else {
                        echo '<div class="alert alert-success" role="alert">No applications yet.</div>';
                    }
                    ?>
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- title modal -->
<div class="modal fade" id="titleModal" tabindex="-1" role="dialog" aria-labelledby="titleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModalLabel">Update Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="titleForm">
          <div class="form-group">
            <label for="titleText">Title</label>
            <input type="text" class="form-control" id="titleText" value="<?= $title ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateTitle()">Save changes</button>
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

<!-- Gender Modal -->
<div class="modal" id="genderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Gender</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="radio" id="male" name="gender" value="0" <?= $gender == 0 ? 'checked' : '' ?>>
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="1" <?= $gender == 1 ? 'checked' : '' ?>>
                <label for="female">Female</label><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateGender()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Date of Birth Modal -->
<div class="modal" id="dobModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Date of Birth</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="date" id="dobInput" value="<?= $dob ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateDob()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- about me modal -->
<div class="modal fade" id="aboutMeModal" tabindex="-1" role="dialog" aria-labelledby="aboutMeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aboutMeModalLabel">Update About Me</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="aboutMeForm">
          <div class="form-group">
            <label for="aboutMeText">About Me</label>
            <textarea class="form-control" id="aboutMeText" rows="3"><?= $about_me ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateAboutMe()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Skills Modal -->
<div class="modal" id="skillsModal">
    <div class="modal-dialog modal-lg"> <!-- Add modal-lg class to make the modal wider -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Skills</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"> <!-- Add form-group class for better styling -->
                    <input type="text" class="form-control" id="skillsInput" value="<?= $skills ?>"> <!-- Add form-control class to make the input field take up the full width of the modal -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateSkills()">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createAddressModal" tabindex="-1" role="dialog" aria-labelledby="createAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createAddressModalLabel">Create Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createAddressForm">
          <div class="form-group">
            <label for="streetNumber">Street Number</label>
            <input type="text" class="form-control" id="streetNumber">
          </div>
          <div class="form-group">
            <label for="streetName">Street Name</label>
            <input type="text" class="form-control" id="streetName">
          </div>
          <div class="form-group">
            <label for="ward">Ward</label>
            <input type="text" class="form-control" id="ward">
          </div>
          <div class="form-group">
            <label for="district">District</label>
            <input type="text" class="form-control" id="district">
          </div>
          <div class="form-group">
            <label for="province">Province</label>
            <input type="text" class="form-control" id="province">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="createAddress()">Save changes</button>
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
    function updateTitle() {
        var title = document.getElementById('titleText').value;
        var userId = <?= json_encode($user_id) ?>; 
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-title', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Title updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&title=' + encodeURIComponent(title));
    }

    function updatePhoneNumber() {
        var phoneNo = document.getElementById('phoneInput').value;
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-phone-number', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Phone number updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&phoneNo=' + encodeURIComponent(phoneNo));
    }

    function updateGender() {
        var gender = document.querySelector('input[name="gender"]:checked').value;
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-gender', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Gender updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&gender=' + encodeURIComponent(gender));
    }

    function updateDob() {
        var dob = document.getElementById('dobInput').value;
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-dob', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Date of birth updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&dob=' + encodeURIComponent(dob));
    }

    function updateAboutMe() {
        var aboutMeText = document.getElementById('aboutMeText').value;
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-about-me', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('About Me updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&aboutMe=' + encodeURIComponent(aboutMeText));
    }

    function createAddress() {
        var streetNumber = document.getElementById('streetNumber').value;
        var streetName = document.getElementById('streetName').value;
        var ward = document.getElementById('ward').value;
        var district = document.getElementById('district').value;
        var province = document.getElementById('province').value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/create-address', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Address created successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('streetNo=' + encodeURIComponent(streetNumber) + '&streetName=' + encodeURIComponent(streetName) + '&ward=' + encodeURIComponent(ward) + '&district=' + encodeURIComponent(district) + '&province=' + encodeURIComponent(province));
    }

    function updateAddress() {
        var streetNumber = document.getElementById('updateStreetNumber').value;
        var streetName = document.getElementById('updateStreetName').value;
        var ward = document.getElementById('updateWard').value;
        var district = document.getElementById('updateDistrict').value;
        var province = document.getElementById('updateProvince').value;
        var addressId = <?= json_encode($address_id) ?>; // Assuming $address_id is available in this scope
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-address', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Address updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('addressId=' + encodeURIComponent(addressId) + '&streetNo=' + encodeURIComponent(streetNumber) + '&streetName=' + encodeURIComponent(streetName) + '&ward=' + encodeURIComponent(ward) + '&district=' + encodeURIComponent(district) + '&province=' + encodeURIComponent(province) + '&user_id=' + encodeURIComponent(userId));
    }

    function updateSkills() {
        var skills = document.getElementById('skillsInput').value;
        var userId = <?= json_encode($user_id) ?>; // Assuming $user_id is available in this scope

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'web-programming-assignment/update-skills', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Skills updated successfully');
                location.reload(); // Reload the page to see the changes
            }
        }

        xhr.send('user_id=' + encodeURIComponent(userId) + '&skills=' + encodeURIComponent(skills));
    }
</script>