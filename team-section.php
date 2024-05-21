<?php 
// Check if user is not logged in, redirect to login page
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

require 'include/db_conn.php';
?>

<?php include 'include/header.php'; ?>

<!-- ========== Left Sidebar Start ========== -->
<?php include 'include/sidebar.php'; ?>
<!-- ========== Left Sidebar End ========== -->

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <h4 class="page-title">Team Members</h4>
                        <a href="team-add.php" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="responsive-table-plugin">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Member</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Facebook</th>
                                        <th>Twitter</th>
                                        <th>LinkedIn</th>
                                        <th>Instagram</th>
                                        <th>Links Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $team_data = "SELECT * FROM team_section";
                                    $result = $conn->query($team_data);
                                    $cnt = 1;

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt++; ?></td>
                                                <td><?php echo $row['member']; ?></td>
                                                <td><?php echo $row['position']; ?></td>
                                                <td>
                                                    <?php if (!empty($row['member_img'])): ?>
                                                        <img src="<?php echo htmlspecialchars($row['member_img']); ?>" alt="Member Image" style="max-width: 50px;">
                                                    <?php else: ?>
                                                        No image
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $row['fb_link']; ?></td>
                                                <td><?php echo $row['twit_link']; ?></td>
                                                <td><?php echo $row['linkedin_link']; ?></td>
                                                <td><?php echo $row['insta_link']; ?></td>
                                                <td>
                                                <?php 
                                                    if ($row['links_status'] == 1) {
                                                        // If status is active
                                                        echo '<h4><span class="badge bg-info">Active</span></h4>';
                                                    } else {
                                                        // If status is inactive
                                                        echo '<h4><span class="badge bg-warning">Inactive</span></h4>';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    if ($row['status'] == 1) {
                                                        // If status is active
                                                        echo '<h4><span class="badge bg-primary">On</span></h4>';
                                                    } else {
                                                        // If status is inactive
                                                        echo '<h4><span class="badge bg-danger">Off</span></h4>';
                                                    }
                                                ?>
                                                </td>
                                                <td width="10%">
                                                    <a href="team-update.php?id=<?php echo $row['team_id']; ?>" class="text-reset fs-16 px-1">
                                                        <i class="ri-settings-3-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="confirmTeamDelete(<?php echo $row['team_id']; ?>);" class="text-reset fs-16 px-1">
                                                        <i class="ri-delete-bin-2-line"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->

        </div>
        <!-- container -->

    </div>
    <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by <b>Techzaa</b>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Start Theme Settings -->
<?php include 'include/theme-setting.php'; ?>
<!-- End Theme Settings -->

<!-- Start Footer -->
<?php include 'include/footer.php'; ?>
<!-- End Footer -->