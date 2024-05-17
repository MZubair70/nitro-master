<?php 
    // Check if user is not logged in, redirect to login page
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    // Fetch existing data from the database
    $sql = "SELECT * FROM about_section WHERE about_id = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $about_heading = $row["about_heading"];
        $about_paragraph = $row["about_paragraph"];
        $about_list = $row["about_list"];
        $about_img = $row["about_img"];
        $status = $row["status"];
    } else {
        // Handle case where no data is found
        $about_heading = "";
        $about_paragraph = "";
        $about_list = "";
        $about_img = "";
        $status = "";
    }

    // Check if form is submitted
    if (isset($_POST["submit"])) {
        // Get the field(s) to update
        $fieldsToUpdate = array();
        if (isset($_POST["heading"])) {
            $fieldsToUpdate[] = "about_heading = '{$_POST["heading"]}'";
        }
        if (isset($_POST["paragraph"])) {
            $fieldsToUpdate[] = "about_paragraph = '{$_POST["paragraph"]}'";
        }
        if (isset($_POST["list"])) {
            $fieldsToUpdate[] = "about_list = '{$_POST["list"]}'";
        }
        if ($_FILES["about_img"]["size"] > 0) {
            $targetDir = "imgs/";
            $fileName = basename($_FILES["about_img"]["name"]);
            $fileFullPath = $targetDir . $fileName;
            $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["about_img"]["tmp_name"], $fileFullPath)) {
                    $fieldsToUpdate[] = "about_img = '{$fileFullPath}'";
                } else {
                    echo "<script>alert('Error uploading file!');</script>";
                }
            } else {
                echo "<script>alert('Invalid file format!');</script>";
            }
        }
        // Update the status field
        $fieldsToUpdate[] = "status = '{$status}'";

        // Construct the update query
        if (!empty($fieldsToUpdate)) {
            $updateFields = implode(", ", $fieldsToUpdate);
            $sql = "UPDATE about_section SET {$updateFields} WHERE about_id = 1";

            // Execute the update query
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Data updated successfully!');</script>";
                echo "<script>window.location.href = 'about-section.php';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "<script>alert('No fields to update.');</script>";
        }
    }

    $conn->close();
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
                <div class="col-10">
                    <div class="page-title-box">
                        <h4 class="page-title">About Section</h4>
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
                                            <label for="example-email" class="form-label">Heading:</label>
                                            <input type="text" id="ab-heading" name="heading" class="form-control" placeholder="Your Welcome Message" value="<?php echo $about_heading; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-palaceholder" class="form-label">Paragraph</label>
                                            <textarea class="form-control" id="ab-paragraph" name="paragraph" rows="3" cols="50"><?php echo $about_paragraph; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Create a List</label>
                                            <input type="text" id="ab-list" class="form-control" name="list" placeholder="Enter comma-separated values" value="<?php echo $about_list; ?>">
                                            <ol id="inputList"></ol>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label">About section Image</label>
                                            <input type="file" id="ab-img" name="about_img" class="form-control">
                                        </div>

                                        <?php if (!empty($about_img)) : ?>
                                            <div class="mb-3">
                                                <img src="<?php echo $about_img; ?>" alt="About Section Image" style="max-width: 100px;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="welcomeNoteSwitch">Section ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-front" name="status" <?php echo $status == 1 ? 'checked' : ''; ?>>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="col-9">
                                                <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row-->
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            <!-- end page title -->
        </div> <!-- container -->
    </div> <!-- content -->

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
