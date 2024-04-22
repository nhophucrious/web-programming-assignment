<?php
    require_once 'includes/header.php';
?>

<div class="container-fluid p-5 " style="min-height: 100vh;">
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12">
            <h3 style="font-weight: bold;">👋 Welcome to HiredCMUT</h3>
            <hr>
            <form action="signup_process.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">I am a:</label>
                    <select id="role" name="role" class="form-control">
                      <option value="job_seeker">Job Seeker</option>
                      <option value="employer">Employer</option>
                    </select>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                    <label class="form-check-label" for="privacy">By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>                </div>
                <button type="submit" class="hiredcmut-button-light">🚀 Sign Up</button>
            </form>
            <!-- already have an account? -->
            <hr>
            <p>Already have an account? <a href="signin.php">Sign in</a></p>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="signup-info-panel p-3">
                <h4>As a job seeker</h4>
                <ul style="list-style: none">
                    <li>🧑 Personalized job recommendations</li>
                    <li>👆 Apply to jobs in just one click</li>
                    <li>💡 Get notified when new jobs are posted</li>
                </ul>
                <h4>As an employer</h4>
                <ul style="list-style: none">
                    <li>📌 Post jobs and reach out to candidates</li>
                    <li>📊 Manage job postings</li>
                    <li>📈 Track job applications</li>
                </ul>
            </div>            
        </div>
    </div>
</div>

<?php
    require_once 'includes/footer.php';
?>