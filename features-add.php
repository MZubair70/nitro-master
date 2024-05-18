<?php 
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    if (isset($_POST["submit"])) {
        $heading = $_POST["heading"] ?? '';
        $subheading = $_POST["subheading"] ?? '';
        $paragraph = $_POST["paragraph"] ?? '';
        $button = isset($_POST["button"]) ? intval($_POST["button"]) : 0;
        $status = isset($_POST["status"]) ? 1 : 0;
        
        // Check if file is uploaded
        $fileFullPath = '';
        if (!empty($_FILES["fea_img"]["name"])) {
            $targetDir = "imgs/";
            $fileName = basename($_FILES["fea_img"]["name"]);
            $fileFullPath = $targetDir . $fileName;
            $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

            // Check if file type is allowed
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Move the uploaded file to the desired location
                if (!move_uploaded_file($_FILES["fea_img"]["tmp_name"], $fileFullPath)) {
                    echo "<script>alert('Error uploading file!');</script>";
                }
            } else {
                echo "<script>alert('Invalid file format!');</script>";
            }
        }

        // Prepare SQL insert statement
        $sql = "INSERT INTO feature_section (fea_heading, fea_subheading, fea_para, fea_btn, status, fea_img) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiis", $heading, $subheading, $paragraph, $button, $status, $fileFullPath);

        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully!');</script>";
            echo "<script>window.location.href = 'features-section.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
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
                                                <option value="0">Deactive</option>
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
