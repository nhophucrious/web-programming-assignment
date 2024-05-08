<?php
require_once 'includes/header.php';
if (isset($_GET['id'])) {
    require_once __DIR__ . '/../controllers/UserController.php';
    $userController = new UserController();
    $user = $userController->getUserDetails($_GET['id']);
    // var_dump($user);

    if (!$user) {
        $user = null;
    } else {
        // get the variables
        $full_name = $user['first_name'] . ' ' . $user['last_name'];
        $title = $user['title'];
        $email_address = $user['email_address'];
        $phone_no = $user['phone_no'];
        $gender = $user['gender'];
        $dob = $user['dob'];
        $about_me = $user['about_me'];
        $address_id = $user['address_id'];
        $skills = $user['skills'];
        $avatar = $user['avatar'];

        // get address
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

            // Combine them into a single string, but no comma between street no and street name
            $address = $streetNo . ' ' . $streetName . ', ' . $ward . ', ' . $district . ', ' . $province;
        } else {
            $address = '';
        }

        // get education
        require_once __DIR__ . '/../controllers/EducationController.php';
        $educationController = new EducationController();
        $educations = $educationController->getEducationByUserId($user['user_id']);

        // get work experience
        require_once __DIR__ . '/../controllers/ExpController.php';
        $experienceController = new ExpController();
        $experiences = $experienceController->getExpByUserId($user['user_id']);

        // get certificates
        require_once __DIR__ . '/../controllers/CertificateController.php';
        $certificateController = new CertificateController();
        $certificates = $certificateController->getCertificatesByUserId($user['user_id']);
    }
} else if (isset($_GET['q'])) {
    $user = null;
} else {
    $user = null;
}
?>

<div class="container" style="min-height: 100vh">
    <?php if (!$user): ?>
        <div class="p-4">
            <a href="/web-programming-assignment/" class="hiredcmut-button m-3">Back to home</a>
        </div>
        <div class="text-center">
            <h1 class='text-center'>User not found 😬</h1>
            <p>No user was found with the given ID. Please try again.</p>
        </div>
    <?php else: ?>
        <div class="p-4">

        </div>
    <div id="summary" class="content-section">
        <!-- Content for Summary -->
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-3">
                <div class="position-relative d-inline-block">
                    <img src="<?php echo $avatar ? $avatar : 'https://img.freepik.com/premium-vector/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-vector-illustration_561158-3383.jpg?size=338&ext=jpg&ga=GA1.1.553209589.1714262400&semt=ais'; ?>"
                        alt="Profile Picture"
                        style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid black;">
                </div>
            </div>
            <div class="col-md-8">
                <h2><?= $full_name ?></h2>
                <p><?= ($title != '') ? $title : 'No title yet' ?></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><i class="fas fa-envelope"></i> <?= $email_address ?></p>
                <p><i class="fas fa-phone"></i>
                    <?= ($phone_no != '') ? $phone_no : 'No phone number yet' ?></p>
                <p><i class="fas fa-user"></i>
                    <?= ($gender != '') ? ($gender === "1") ? "Female" : "Male" : 'No gender yet' ?></p>
            </div>
            <div class="col-md-6">
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <?= ($address_id != '') ? $address : 'No address yet' ?>
                </p>
                <p><i class="fas fa-birthday-cake"></i>
                    <?= ($dob != '') ? $dob : 'No date of birth yet' ?>
                </p>
            </div>
        </div>
    </div>
    <div id="about-me" class="content-section">
    <!-- Content for About Me -->
        <div class="row d-flex align-items-center">
            <h3 class="px-3">About</h3>
        </div>
        <hr>
        <p><?= ($about_me != '') ? $about_me : 'About not available' ?></p>
    </div>
    <div id="education" class="content-section">
        <!-- Content for Education -->
        <div class="row d-flex align-items-center">
            <h3 class="px-3">Education</h3>
        </div>
        <hr>
        <?php
        if (count($educations) == 0) {
            echo '<p>No education details available yet.</p>';
        } else {
            foreach ($educations as $education) {
                echo '<div class="row mb-3">';
                echo '<div class="col">';
                echo '<h4 class="font-weight-bold">' . $education['degree_name'] . '</h4>';
                echo '<p>Institution: ' . $education['institution_name'] . '</p>';
                echo '<p>' . $education['start_year'] . ' - ' . $education['end_year'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <div id="work-exp" class="content-section">
        <!-- Content for Work Experience -->
        <div class="row d-flex align-items-center">
            <h3 class="px-3">Work Experience</h3>
        </div>
        <hr>
        <?php
        if (count($experiences) == 0) {
            echo '<p>No work experience details available yet.</p>';
        } else {
            foreach ($experiences as $experience) {
                echo '<div class="row mb-3">';
                echo '<div class="col">';
                echo '<h4 class="font-weight-bold">' . $experience['exp_name'] . '</h4>';
                echo '<p>' . $experience['year_start'] . ' - ' . $experience['year_end'] . '</p>';
                echo '<p>' . $experience['exp_description'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <div id="skills" class="content-section">
        <!-- Content for Skills -->
        <div class="row d-flex align-items-center">
            <h3 class="px-3">Skills</h3>
        </div>
        <hr>

        <p><?= ($skills != '') ? $skills : 'No skills yet' ?></p>
        </div>
        <div id="certificates" class="content-section">
        <!-- Content for Certificates -->
        <div class="row d-flex align-items-center">
            <h3 class="px-3">Certificate</h3>
        </div>
        <hr>
        <?php
        if (count($certificates) == 0) {
            echo '<p>No certificates available yet.</p>';
        } else {
            foreach ($certificates as $certificate) {
                echo '<div class="row mb-3">';
                echo '<div class="col">';
                echo '<h4 class="font-weight-bold">' . $certificate['certificate_name'] . '</h4>';
                echo '<p> Year issued: ' . $certificate['year_issued'] . '</p>';
                echo '<p> Issuer: ' . $certificate['issuer'] . '</p>';
                echo '<a href="' . $certificate['link'] . '" target="_blank">View Certificate</a>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <?php endif; ?>
</div>


<?php
require_once 'includes/footer.php';
?>