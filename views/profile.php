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
    $certificate_id = $user_details['certificate_id'];
}
// print_r($user_details);

require_once 'includes/header.php';
$skills = array("Java", "Python", "JavaScript", "Spring Boot", "React", "Angular", "Git", "Docker", "Jenkins");
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
                                <p><?= ($title != '') ? $title : 'No title yet' ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fas fa-envelope"></i> <?= $email_address ?></p>
                                <p><i class="fas fa-phone"></i> <?= ($phone_no != '') ? $phone_no : 'No phone number yet' ?></p>
                                <p><i class="fas fa-user"></i>  <?= ($gender != '') ? $gender : 'No gender yet' ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-map-marker-alt"></i> <?= ($address_id != '') ? $address_id : 'No address yet' ?></p>
                                <p><i class="fas fa-birthday-cake"></i> <?= ($dob != '') ? $dob : 'No date of birth yet' ?></p>
                            </div>
                        </div>
                    </div>
                    <div id="about-me" class="content-section">
                        <!-- Content for About Me -->
                        <div class="row d-flex align-items-center">
                            <h3 class="px-3">About Me</h3>
                            <br>
                            <button type="button" class="hiredcmut-button-light" data-toggle="modal" data-target="#aboutMeModal">
                                Update
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
                        <h3>Skills</h3>
                        <hr>
                        <!-- <div class="skills-container">
                            <?php foreach ($skills as $skill): ?>
                                <span class="skill-tag"><?php echo $skill; ?></span>
                            <?php endforeach; ?>
                        </div> -->
                        <p>Skills not available yet.</p>
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


<?php
require_once 'includes/footer.php';
?>

<script>
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
</script>