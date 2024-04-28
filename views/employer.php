<?php
require_once 'includes/header.php';
$jobPostings = 0;
?>

<div class="container pt-5" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group sticky-sidebar">
                <a href="#company-profile-overview" class="list-group-item list-group-item-action active" data-toggle="tab">
                    Company Profile Overview
                </a>
                <a href="#job-postings" class="list-group-item list-group-item-action" data-toggle="tab">
                    Manage Job Postings <span class="badge badge-primary badge-pill"><?php echo $jobPostings; ?></span>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col" style="height: 100%;">
                    <div class="tab-content" style="height: 100%;">
                        <div class="tab-pane active text-left p-4" id="company-profile-overview">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/100" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                                </div>
                                <div class="col-md-8">
                                    <h2>FPT Software</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><i class="fas fa-envelope"></i>  example@example.com</p>
                                    <p><i class="fas fa-phone"></i> +1234567890</p>
                                    <p><i class="fas fa-map-pin"></i>   Ho Chi Minh City</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane text-left p-4" id="job-postings">
                            <!-- Content for Job Postings -->
                            <div class="row">
                                <div class="col">
                                    <h2>Job Postings</h2>
                                </div>
                                <div class="col text-right">
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" data-toggle="modal" data-target="#myModal" style="color: #ffbf00; background: none; border: none;">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Job Posting</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Some text in the modal.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- if there are no job postings then indicate that -->
                            <?php if ($jobPostings === 0) : ?>
                                <div class="alert alert-info" role="alert">
                                    No job postings yet.
                                </div>
                            <?php else : ?>
                                <!-- Table to display job postings -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Job Type</th>
                                            <th>Salary</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through job postings -->
                                        <?php for ($i = 1; $i <= $jobPostings; $i++) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>Job Title</td>
                                                <td>Job Type</td>
                                                <td>Salary</td>
                                                <td>Status</td>
                                                <td>
                                                    <a href="/web-programming-assignment/employer/job-posting" class="btn btn-primary">Edit</a>
                                                    <button class="btn btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>

                        </div>
                    

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>