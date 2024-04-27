<?php
require_once 'includes/header.php';

// Fetch counts database
// TODO: add pagination to the data displayed below - page size of 10
$pendingEmployersCount = 50; // Just a placeholder
$pendingJobPostingsCount = 0; // Just a placeholder
?>


<div class="container pt-2" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#verify-job-posters" class="list-group-item list-group-item-action active" data-toggle="tab">
                    Pending employers <span class="badge badge-primary badge-pill"><?php echo $pendingEmployersCount; ?></span>
                </a>
                <a href="#verify-job-postings" class="list-group-item list-group-item-action" data-toggle="tab">
                    Pending job postings <span class="badge badge-primary badge-pill"><?php echo $pendingJobPostingsCount; ?></span>
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col" style="height: 100%;">
                    <div class="tab-content" style="height: 100%;">
                        <div class="tab-pane active" id="verify-job-posters">
                            <!-- Content for Verify Job Posters -->
                            <!-- if pending job posters is 0 then indicate that -->
                            <?php if ($pendingEmployersCount === 0) : ?>
                                <div class="alert alert-success" role="alert">
                                    No pending employers to verify.
                                </div>
                            <?php else : ?>
                                <!-- Table to display pending employers -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Company Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through pending employers -->
                                        <?php for ($i = 1; $i <= $pendingEmployersCount; $i++) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>Company Name</td>
                                                <td>
                                                    <a href="mailto:nngiaphuc@gmail.com">
                                                        Company Email
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success">Verify</button>
                                                    <button class="btn btn-danger">Reject</button>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="verify-job-postings">
                            <!-- Content for Verify Job Postings -->
                            <!-- if pending job postings is 0 then indicate that -->
                            <?php if ($pendingJobPostingsCount === 0) : ?>
                                <div class="alert alert-success" role="alert">
                                    No pending job postings to verify.
                                </div>
                            <?php else : ?>
                                <!-- Table to display pending job postings -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Company Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through pending job postings -->
                                        <?php for ($i = 1; $i <= $pendingJobPostingsCount; $i++) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>Job Title</td>
                                                <td>Company Name</td>
                                                <td>
                                                    <button class="btn btn-success">Verify</button>
                                                    <button class="btn btn-danger">Reject</button>
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