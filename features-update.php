<?php 
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    require 'include/db_conn.php';

    // Get the id and sanitize it
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id === 0) {
        header("Location: features-section.php");
        exit();
    }

    if (isset($_POST["submit"])) {
        $fieldsToUpdate = array();
        $params = array();
        
        if (!empty($_POST["heading"])) {
            $fieldsToUpdate[] = "fea_heading = ?";
            $params[] = $_POST["heading"];
        }
        if (!empty($_POST["subheading"])) {
            $fieldsToUpdate[] = "fea_subheading = ?";
            $params[] = $_POST["subheading"];
        }
        if (!empty($_POST["paragraph"])) {
            $fieldsToUpdate[] = "fea_para = ?";
            $params[] = $_POST["paragraph"];
        }
        if (isset($_POST["button"])) {
            $fieldsToUpdate[] = "fea_btn = ?";
            $params[] = $_POST["button"];
        }

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
                if (move_uploaded_file($_FILES["fea_img"]["tmp_name"], $fileFullPath)) {
                    $fieldsToUpdate[] = "fea_img = ?";
                    $params[] = $fileFullPath;
                } else {
                    echo "<script>alert('Error uploading file!');</script>";
                }
            } else {
                echo "<script>alert('Invalid file format!');</script>";
            }
        }

        // Update the status field
        $status = isset($_POST["status"]) ? 1 : 0;
        $fieldsToUpdate[] = "status = ?";
        $params[] = $status;

        if (!empty($fieldsToUpdate)) {
            $updateFields = implode(", ", $fieldsToUpdate);
            $sql = "UPDATE feature_section SET $updateFields WHERE fea_id = ?";
            $params[] = $id;

            $stmt = $conn->prepare($sql);

            $types = str_repeat("s", count($params) - 1) . "i";
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "<script>alert('Data updated successfully!');</script>";
                echo "<script>window.location.href = 'features-section.php';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        $sql = "SELECT * FROM feature_section WHERE fea_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

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
            $status = 0;
            $fileFullPath = "";
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
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id"; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="feature-heading" class="form-label">Heading:</label>
                                            <input type="text" id="feature-heading" name="heading" class="form-control" placeholder="Your Heading Message" value="<?php echo htmlspecialchars($heading); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-subheading" class="form-label">Sub Heading:</label>
                                            <input type="text" id="feature-subheading" name="subheading" class="form-control" placeholder="Your Sub-Heading Message" value="<?php echo htmlspecialchars($subheading); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="paragraph" class="form-label">Paragraph</label>
                                            <textarea class="form-control" id="paragraph" name="paragraph" rows="3" cols="50"><?php echo htmlspecialchars($paragraph); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-button" class="form-label">Button Active / Deactive</label>
                                            <select class="form-select" id="feature-button" name="button">
                                                <option value="1" <?php if ($button == 1) echo "selected"; ?>>Active</option>
                                                <option value="0" <?php if ($button == 0) echo "selected"; ?>>Inactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feature-img" class="form-label">Feature Section Image</label>
                                            <?php if (!empty($fileFullPath)) : ?>
                                                <p>Current File: <?php echo basename($fileFullPath); ?></p>
                                                <div class="mb-3">
                                                <img src="<?php echo htmlspecialchars($fileFullPath); ?>" alt="Uploaded Image" style="max-width: 100px;">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" id="feature-img" name="fea_img" class="form-control">
                                        </div>

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
