<!-- views/about.php -->

<?php 
    require_once 'includes/header.php';
?>

<div class="d-flex flex-column container my-3 p-3">
    <h1 class="mb-2" style="font-weight: bold">About <span style="color: black; background-color: #FFBF00; padding: 0 5px; border-radius: 10px;">HiredCMUT</span></h1>
    
    <p>🧑‍🎓 HiredCMUT is a job portal developed by the students of the Ho Chi Minh City University of Technology.</p>
    <p>🎯 Our mission is to help students find employment opportunities that will help them gain experience in their chosen field and prepare them for their future careers. We aim to bridge the gap between students and employers by providing a platform where they can connect and collaborate.</p>
    <p>🤝 Whether you are a student looking for a part-time job or an employer looking for interns or full-time employees, HiredCMUT is the place for you. Join us now and start your journey to success!</p>

</div>
<div class="container-fluid about-hero p-5 d-flex flex-column justify-content-center align-items-center">
    <h1>😌 Easy for companies and candidates</h1>
    <p>Create an account and begin your search in no time.</p>
</div>

<div class="container p-3">
    <div class="row">
        <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
            <h1 style="font-weight: bold">For employers</h1>
            <div class="my-separator"></div>
            <ul style="list-style-type: none">
                <li>⬆️ Post job listings</li>
                <li>👀 View student profiles</li>
                <li>📞 Connect with students</li>
            </ul>
        </div>
        <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center">
            <h1 style="font-weight: bold">For job seekers</h1>
            <div class="my-separator"></div>
            <ul style="list-style-type: none">
                <li>🔎 Search for jobs</li>
                <li>🤝 Apply for jobs</li>
                <li>📞 Connect with employers</li>
            </ul>
        </div>
    </div>
</div>


<?php
    require_once 'includes/footer.php';
?>