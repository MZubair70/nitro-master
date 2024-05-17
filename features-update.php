<?php 
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    $id = $_GET['id'];

    if (isset($_POST["submit"])) {
        $fieldsToUpdate = array();
        if (isset($_POST["heading"])) {
            $fieldsToUpdate[] = "fea_heading = '{$_POST["heading"]}'";
        }
        if (isset($_POST["subheading"])) {
            $fieldsToUpdate[] = "fea_subheading = '{$_POST["subheading"]}'";
        }
        if (isset($_POST["paragraph"])) {
            $fieldsToUpdate[] = "fea_para = '{$_POST["paragraph"]}'";
        }
        if (isset($_POST["button"])) {
            $fieldsToUpdate[] = "fea_btn = '{$_POST["button"]}'";
        }
        if (isset($_POST["status"])) {
            $fieldsToUpdate[] = "status = '{$_POST["status"]}'";
        }
        if (isset($_POST["fea_img"])) {
            $fieldsToUpdate[] = "fea_img = '{$_POST["fea_img"]}'";
        }

        // Check if file is uploaded
        if (!empty($_FILES["fea_img"]["name"])) {
            $targetDir = "imgs/";
            $fileName = basename($_FILES["fea_img"]["name"]);
            $fileFullPath = $targetDir . $fileName;
            $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

            // Check if file type is allowed
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES["fea_img"]["tmp_name"], $fileFullPath)) {
                    $fieldsToUpdate[] = "fea_img = '{$fileFullPath}'";
                } else {
                    echo "&lt;script&gt;alert('Error uploading file!');&lt;/script&gt;";
                }
            } else {
                echo "&lt;script&gt;alert('Invalid file format!');&lt;/script&gt;";
            }
        }
        
        $updateFields = implode(", ", $fieldsToUpdate);
        $sql = "UPDATE feature_section SET {$updateFields} WHERE fea_id = 1";
        
        $stmt = $conn->query($sql);
        if ($stmt) {
            echo "<script>alert('Data updated successfully!');</script>";
            echo "<script>window.location.href = 'features-section.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        $sql = "SELECT * FROM feature_section WHERE fea_id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $heading = $row["fea_heading"];
            $subheading = $row["fea_subheading"];
            $paragraph = $row["fea_para"];
            $button = $row["fea_btn"];
            $status = $row["status"];
            $fileFullPath = $row["fea_img"];
        } else {
            $heading = "";
            $subheading = "";
            $paragraph = "";
            $button = "";
            $status = "";
            $fileFullPath = "";
            $folderName = "";
            $fileName = "";
        }
    }

    $conn->close();
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
                                            <input type="text" id="feature-heading" name="heading" class="form-control" placeholder="Your Heading Message" value="<?php echo $heading; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-subheading" class="form-label">Sub Heading:</label>
                                            <input type="text" id="feature-subheading" name="subheading" class="form-control" placeholder="Your Sub-Heading Message" value="<?php echo $subheading; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="paragraph" class="form-label">Paragraph</label>
                                            <textarea class="form-control" id="paragraph" name="paragraph" rows="3" cols="50"><?php echo $paragraph; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-button" class="form-label">Button Active / Deactive</label>
                                            <select class="form-select" id="feature-button" name="button">
                                                <option value="1" <?php if ($button == 1) echo "selected"; ?>>Active</option>
                                                <option value="0" <?php if ($button == 0) echo "selected"; ?>>Deactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-img" class="form-label">Feature Section Image</label>
                                            <?php if (!empty($fileName)) : ?>
                                                <p>Current File: <?php echo $fileName; ?></p>
                                            <?php endif; ?>
                                            <input type="file" id="feature-img" name="fea_img" class="form-control">
                                        </div>

                                        <?php if (!empty($fileFullPath)) : ?>
                                            <div class="mb-3">
                                                <img src="<?php echo $fileFullPath; ?>" alt="Uploaded Image" style="max-width: 100px;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-feature">Section ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-feature" name="status" <?php if ($status == 1) echo "checked"; ?>>
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
