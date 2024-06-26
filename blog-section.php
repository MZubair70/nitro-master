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
                        <h4 class="page-title">Blog Section</h4>
                        <a href="blog-add.php" class="btn btn-primary">Add New</a>
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
                                                    <th>Title</th>
                                                    <th>Paragraph</th>
                                                    <th>Uploaded By</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Publish Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $blog_data = "SELECT
                                                blog_section.blog_id,
                                                blog_section.title,
                                                blog_section.blog_para,
                                                blog_section.upload_by,
                                                blog_section.blog_img,
                                                blog_categories.blog_cat,
                                                blog_section.publish_date,
                                                blog_section.`status`
                                                FROM
                                                blog_section
                                                INNER JOIN blog_categories ON blog_section.blogcat_id = blog_categories.blogImg_id";
                                                $result = $conn->query($blog_data);
                                                $cnt = 1;

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $cnt++; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo substr($row['blog_para'], 0, 50) . '...'; ?></td>
                                                            <td><?php echo $row['upload_by']; ?></td>
                                                            <td><?php echo $row['blog_cat']; ?></td>
                                                            <td>
                                                                <img src="<?php echo $row['blog_img']; ?>" alt="Blog Image" style="max-width: 50px;">
                                                            </td>
                                                            <td><?php echo $row['publish_date']; ?></td>
                                                            <td>
                                                                <?php 
                                                                if ($row['status'] == 1) {
                                                                    echo '<h4><span class="badge bg-primary"> Active </span></h4>';
                                                                } else {
                                                                    echo '<h4><span class="badge bg-danger"> Inactive </span></h4>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="blog-update.php?id=<?php echo $row['blog_id']; ?>" class="text-reset fs-16 px-1">
                                                                    <i class="ri-settings-3-line"></i>
                                                                </a>
                                                                <a href="javascript:void(0);" onclick="confirmBlogDelete(<?php echo $row['blog_id']; ?>);" class="text-reset fs-16 px-1">
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
        </div> <!-- container-fluid -->
    </div> <!-- content -->
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by <b>Techzaa</b>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</div>
<!-- End content-page -->

<!-- Include Footer -->
<?php include 'include/footer.php'; ?>

