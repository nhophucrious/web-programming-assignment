<?php
// suppress warnings
error_reporting(E_ERROR | E_PARSE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $isUser = true;
} else if (isset($_SESSION['employer'])) {
    $isEmployer = true;
}
require_once 'includes/header.php';
?>

<style>
#signupForm .slide {
    display: none;
}
#signupForm .slide div {
    margin-bottom: 20px;
}
#signupForm input {
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}
#signupForm .button-row {
    display: flex;
    justify-content: space-between;
}

#signinForm input {
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}
</style>

<div class="container d-flex text-center align-items-center justify-content-center" style="min-height: 100vh">
    <?php if ($isUser): ?>
        <p> You need to be signed in as an employer to access this page. </p>
        <p> Did you forget to sign out? <a href="/web-programming-assignment/signout">Sign out</a></p>
    <?php elseif ($isEmployer): ?>
        <div>
            <h1>Welcome!</h1>
            <hr>
            <p>What would you like to do today?</p>
            <a href="employer-profile" class="hiredcmut-button">View company profile</a>
            <a href="job-post" class="hiredcmut-button-light">Post a job</a>
            <hr>
            <p>Or search for potential employees:</p>
            <!-- search bar for finding useres -->
            <div class="container-fluid ">
                <form action="/web-programming-assignment/user" method="get">
                    <input style="width: 100%; border: 2px solid #ffbf00; border-radius: 10px; height: 4rem; padding: 1rem 2rem" type="text" name="q" placeholder="Search for candidates..." required>
                    <button style="margin-top: 1rem" type="submit" class="hiredcmut-button-light">Search</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="col">
            <h1 id="slideTitle">Interested in recruiting via HiredCMUT?</h1>
            <button id="getStartedButton" type="button" class="hiredcmut-button-light">Get Started</button>
            <button id="signinButton" type="button" class="hiredcmut-button-light">Sign In</button>
            <!-- Multi-step form -->
            <form id="signupForm" action="/web-programming-assignment/employer-signup-action" method="post" style="display: none;">
                <div class="slide" data-title="What is your company name?">
                    <div>
                        <input type="text" id="name" name="name" placeholder="Company Name" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="nextSlide()">Next</button>
                    </div>
                </div>
                <div class="slide" data-title="Enter your email and password:">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                        <button type="button" class="hiredcmut-button-light" onclick="nextSlide()">Next</button>
                    </div>
                </div>
                <div class="slide" data-title="Your contact information">
                    <div>
                        <input type="text" id="streetNo" name="streetNo" placeholder="Street No" required>
                    </div>
                    <div>
                        <input type="text" id="streetName" name="streetName" placeholder="Street Name" required>
                    </div>
                    <div>
                        <select id="province" name="province" required style="width: 100%"></select>
                    </div>
                    <div>
                        <select id="district" name="district" required style="width: 100%"></select>
                    </div>
                    <div>
                        <select id="ward" name="ward" required style="width: 100%"></select>
                    </div>
                    <div>
                        <input type="number" id="phoneNo" name="phoneNo" placeholder="Phone Number" maxlength="10" required>
                    </div>
                    <div class="button-row">
                        <button type="button" class="hiredcmut-button" onclick="prevSlide()">Back</button>
                        <button type="submit" class="hiredcmut-button-light">Submit</button>
                    </div>
                </div>
            </form>

            <form id="signinForm" action="/web-programming-assignment/employer-signin-action" method="post" style="display: none;">
                <div>
                    <input type="text" id="signin-email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" id="signin-password" name="password" placeholder="Password" required>
                </div>
                <div>
                    <button type="submit" class="hiredcmut-button">Sign In</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php
require_once 'includes/footer.php';
?>

<script>
$(document).ready(function() {
    var currentSlide = 0;
    var slides = $('#signupForm .slide').hide();

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

    $('#getStartedButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#signupForm').fadeIn(400);
            showSlide(0);
        });
        $('#signinButton').fadeOut(400); // Add this line
    });

    $('#signinButton').click(function() {
        $(this).fadeOut(400, function() {
            $('#signinForm').fadeIn(400);
        });
        $('#getStartedButton').fadeOut(400); // Add this line
    });

    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
});

</script>
<script>
window.onload = function() {
    fetch('address.json')
        .then(response => response.json())
        .then(data => {
            const provinceSelect = document.getElementById('province');
            const districtSelect = document.getElementById('district');
            const wardSelect = document.getElementById('ward');

            // Populate the province select field
            for (const provinceId in data) {
                const province = data[provinceId];
                const option = document.createElement('option');
                option.value = province.name_with_type; // Use the name_with_type as the value
                option.text = province.name_with_type;
                provinceSelect.append(option);
            }

            // Update the district select field when a province is selected
            provinceSelect.addEventListener('change', function() {
                const selectedProvinceName = this.value;
                const selectedProvince = Object.values(data).find(province => province.name_with_type === selectedProvinceName);
                districtSelect.innerHTML = '';
                if (selectedProvince) {
                    for (const district of selectedProvince.quan_huyen) {
                        const option = document.createElement('option');
                        option.value = district.name_with_type; // Use the name_with_type as the value
                        option.text = district.name_with_type;
                        districtSelect.append(option);
                    }
                }
            });

            // Update the ward select field when a district is selected
            districtSelect.addEventListener('change', function() {
                const selectedProvinceName = provinceSelect.value;
                const selectedProvince = Object.values(data).find(province => province.name_with_type === selectedProvinceName);
                const selectedDistrictName = this.value;
                const selectedDistrict = selectedProvince ? selectedProvince.quan_huyen.find(district => district.name_with_type === selectedDistrictName) : null;
                wardSelect.innerHTML = '';
                if (selectedDistrict) {
                    for (const ward of selectedDistrict.xa_phuong) {
                        const option = document.createElement('option');
                        option.value = ward.name_with_type; // Use the name_with_type as the value
                        option.text = ward.name_with_type;
                        wardSelect.append(option);
                    }
                }
            });
        });
}
</script>