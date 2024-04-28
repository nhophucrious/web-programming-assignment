<?php
require_once 'includes/header.php';
$skills = array("Java", "Python", "JavaScript", "Spring Boot", "React", "Angular", "Git", "Docker", "Jenkins");
$applications = array();
?>

<div class="container pt-5" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-3">
            <!-- profile section with links -->
            <div class="list-group" id="sticky-sidebar">
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
                                <h2>Nguyen Van A</h2>
                                <p>iOS Developer</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fas fa-envelope"></i>  example@example.com</p>
                                <p><i class="fas fa-phone"></i> +1234567890</p>
                                <p><i class="fas fa-user"></i>  Male</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-map-pin"></i>   Ho Chi Minh City</p>
                                <p><i class="fas fa-birthday-cake"></i> 01/01/2002</p>
                            </div>
                        </div>
                    </div>
                    <div id="about-me" class="content-section">
                        <!-- Content for About Me -->
                        <h3>About Me</h3>
                        <hr>
                        <p>Introduce who you are, what you do, and what experience you have</p>
                    </div>
                    <div id="education" class="content-section">
                        <!-- Content for Education -->
                        <h3>Education</h3>
                        <hr>
                        <ul>
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
                        </ul>
                    </div>
                    <div id="work-exp" class="content-section">
                        <!-- Content for Work Experience -->
                        <h3>Work Experience</h3>
                        <hr>
                        <ul>
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
                        </ul>
                    </div>
                    <div id="skills" class="content-section">
                        <!-- Content for Skills -->
                        <h3>Skills</h3>
                        <hr>
                        <div class="skills-container">
                            <?php foreach ($skills as $skill): ?>
                                <span class="skill-tag"><?php echo $skill; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div id="certificates" class="content-section">
                        <!-- Content for Certificates -->
                        <h3>Certificates</h3>
                        <hr>
                        <ul>
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
                        </ul>
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

<?php
require_once 'includes/footer.php';
?>