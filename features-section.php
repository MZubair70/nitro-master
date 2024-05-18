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
                        <h4 class="page-title">Features Section</h4>
                        <a href="features-add.php" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="fixed-columns-datatable" class="table table-striped row-border order-column w-100">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Heading</th>
                                        <th>Sub - Heading</th>
                                        <th>Paragraph</th>
                                        <th>Button ON / OFF</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $feature_data = "SELECT * FROM feature_section";
                                    $result = $conn->query($feature_data);
                                    $cnt = 1;

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt++; ?></td>
                                                <td><?php echo $row['fea_heading']; ?></td>
                                                <td><?php echo $row['fea_subheading']; ?></td>
                                                <td style='word-wrap: break-word; vertical-align: top;' width="40%">
                                                    <?php echo $row['fea_para']; ?>
                                                </td>
                                                <td width="10%">
                                                <?php 
                                                    if ($row['fea_btn']) {
                                                        // If button is active
                                                        echo '<h4><span class="badge bg-info">Active</span></h4>';
                                                    } else {
                                                        // If button is inactive
                                                        echo '<h4><span class="badge bg-warning">Deactive</span></h4>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <img src="<?php echo $row['fea_img']; ?>" alt="Feature Image" style="max-width: 50px;">
                                                </td>
                                                <td>
                                                <?php 
                                                    if ($row['status'] == 1) {
                                                        // If status is active
                                                        echo '<h4><span class="badge bg-primary"> On </span></h4>';
                                                    } else {
                                                        // If status is inactive
                                                        echo '<h4><span class="badge bg-danger"> Off </span></h4>';
                                                    }
                                                    ?>
                                                    </td>
                                                <td width="10%">
                                                    <a href="features-update.php?id=<?php echo $row['fea_id']; ?>" class="text-reset fs-16 px-1">
                                                        <i class="ri-settings-3-line"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['fea_id']; ?>);" class="text-reset fs-16 px-1">
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
