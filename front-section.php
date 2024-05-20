<?php 
    // Check if user is not logged in, redirect to login page
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    // Check if form is submitted
    if (isset($_POST["submit"])) {
        // Get the field(s) to update
        $fieldsToUpdate = array();
        if (isset($_POST["welcome_msg"])) {
            $fieldsToUpdate[] = "welcome_msg = '{$_POST["welcome_msg"]}'";
        }
        if (isset($_POST["paragraph"])) {
            $fieldsToUpdate[] = "paragraph = '{$_POST["paragraph"]}'";
        }
        if (isset($_POST["button_switch"])) {
            $fieldsToUpdate[] = "button_switch = '{$_POST["button_switch"]}'";
        }

        // Handle status switch
        $status = isset($_POST["status"]) ? 1 : 0;
        $fieldsToUpdate[] = "status = '{$status}'";

        // File upload handling
        if (!empty($_FILES["front_bg_img"]["name"])) {
            $targetDir = "imgs/";
            $fileName = basename($_FILES["front_bg_img"]["name"]);
            $fileFullPath = $targetDir . $fileName;
            $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["front_bg_img"]["tmp_name"], $fileFullPath)) {
                    $fieldsToUpdate[] = "front_bg_img = '{$fileFullPath}'";
                } else {
                    echo "<script>alert('Error uploading file!');</script>";
                }
            } else {
                echo "<script>alert('Invalid file format!');</script>";
            }
        }
        
        // Construct the update query
        $updateFields = implode(", ", $fieldsToUpdate);
        $sql = "UPDATE front_section SET {$updateFields} WHERE fr_id = 1";
        
        // Execute the update query
        $stmt = $conn->query($sql);
        if ($stmt) {
            echo "<script>alert('Data updated successfully!');</script>";
            echo "<script>window.location.href = 'front-section.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Fetch existing data from the database
        $sql = "SELECT * FROM front_section WHERE fr_id = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $welcome_msg = $row["welcome_msg"];
            $paragraph = $row["paragraph"];
            $button_switch = $row["button_switch"];
            $status = $row["status"];
            $fileFullPath = $row["front_bg_img"];
            $fileInfo = pathinfo($fileFullPath);
            $folderName = $fileInfo['dirname'] . '/';
            $fileName = $fileInfo['basename'];
        } else {
            // Handle case where no data is found
            $welcome_msg = "";
            $paragraph = "";
            $button_switch = "";
            $status = "";
            $fileFullPath = "";
            $folderName = "";
            $fileName = "";
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
                        <h4 class="page-title">Front Section</h4>
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
                                            <label for="example-email" class="form-label">Welcome Note:</label>
                                            <input type="text" id="welcomeNote" name="welcome_msg" class="form-control" placeholder="Your Welcome Message" value="<?php echo $welcome_msg; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-palaceholder" class="form-label">Paragraph</label>
                                            <textarea class="form-control" id="paragraph" name="paragraph" rows="3" cols="50"><?php echo $paragraph; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Button Active / Deactive</label>
                                            <select class="form-select" id="buttonSwitch" name="button_switch">
                                                <option value="1" <?php if ($button_switch == 1) echo "selected"; ?>>Active</option>
                                                <option value="0" <?php if ($button_switch == 0) echo "selected"; ?>>Inactive</option>
                                            </select>
                                        </div>

                                        <?php if (!empty($fileFullPath)) : ?>
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Background Image</label>
                                                <?php if (!empty($fileName)) : ?>
                                                    <p>Current File: <?php echo $fileName; ?></p>
                                                <?php endif; ?>
                                                <img src="<?php echo $fileFullPath; ?>" alt="Uploaded Image" style="max-width: 100px;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-3">
                                            <input type="file" id="frontBgImg" name="front_bg_img" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="welcomeNoteSwitch">Section ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-front" name="status" value="1" <?php if ($status == 1) echo "checked"; ?>>
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
