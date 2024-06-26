<?php 
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    // Fetch existing blog post data based on ID
    if (isset($_GET['id'])) {
        $blog_id = $_GET['id'];
        $sql = "SELECT * FROM blog_section WHERE blog_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $blog_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Close statement
        $stmt->close();
    }

    if (isset($_POST["submit"])) {
        $title = $_POST["title"] ?? '';
        $blog_para = $_POST["blog_para"] ?? '';
        $upload_by = $_POST["upload_by"] ?? '';
        $status = isset($_POST["status"]) ? 1 : 0;
        
        // Check if file is uploaded
        $fileFullPath = $row['blog_img']; // Keep the existing image if no new image is uploaded
        if (!empty($_FILES["blog_img"]["name"])) {
            $targetDir = "imgs/";
            $fileName = basename($_FILES["blog_img"]["name"]);
            $fileFullPath = $targetDir . $fileName;
            $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

            // Check if file type is allowed
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Move the uploaded file to the desired location
                if (!move_uploaded_file($_FILES["blog_img"]["tmp_name"], $fileFullPath)) {
                    echo "<script>alert('Error uploading file!');</script>";
                }
            } else {
                echo "<script>alert('Invalid file format!');</script>";
            }
        }

        // Prepare SQL update statement
        $sql = "UPDATE blog_section SET title = ?, blog_para = ?, upload_by = ?, status = ?, blog_img = ? WHERE blog_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $blog_para, $upload_by, $status, $fileFullPath, $blog_id);

        if ($stmt->execute()) {
            echo "<script>alert('Blog post updated successfully!');</script>";
            echo "<script>window.location.href = 'blog-section.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    }
?>


<?php include 'include/header.php'; ?>

<?php include 'include/sidebar.php'; ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="page-title-box">
                        <h4 class="page-title">Feature Section</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="feature-heading" class="form-label">Heading:</label>
                                            <input type="text" id="feature-heading" name="heading" class="form-control" placeholder="Your Heading Message" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-subheading" class="form-label">Sub Heading:</label>
                                            <input type="text" id="feature-subheading" name="subheading" class="form-control" placeholder="Your Sub-Heading Message" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="paragraph" class="form-label">Paragraph</label>
                                            <textarea class="form-control" id="paragraph" name="paragraph" rows="3" cols="50"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-button" class="form-label">Button Active / Deactive</label>
                                            <select class="form-select" id="feature-button" name="button">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-img" class="form-label">Feature Section Image</label>
                                            <input type="file" id="feature-img" name="fea_img" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-feature">Section ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-feature" name="status">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="col-9">
                                                <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
