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
    header("Location: team-section.php");
    exit();
}

if (isset($_POST["submit"])) {
    $member = $_POST["member"] ?? '';
    $position = $_POST["position"] ?? '';
    $fb_link = $_POST["fb_link"] ?? '';
    $twit_link = $_POST["twit_link"] ?? '';
    $linkedin_link = $_POST["linkedin_link"] ?? '';
    $insta_link = $_POST["insta_link"] ?? '';
    
    // Check if links status is active or not
    $links_status = isset($_POST["links_status"]) && $_POST["links_status"] == 1 ? 1 : 0;
    $status = isset($_POST["status"]) ? 1 : 0;
    
    // Initialize file path variable
    $fileFullPath = '';

    // Check if file is uploaded
    if (!empty($_FILES["member_img"]["name"])) {
        $targetDir = "imgs/";
        $fileName = basename($_FILES["member_img"]["name"]);
        $fileFullPath = $targetDir . $fileName;
        $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

        // Check if file type is allowed
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the desired location
            if (!move_uploaded_file($_FILES["member_img"]["tmp_name"], $fileFullPath)) {
                echo "<script>alert('Error uploading file!');</script>";
                $fileFullPath = ''; // reset file path if upload fails
            }
        } else {
            echo "<script>alert('Invalid file format!');</script>";
            $fileFullPath = ''; // reset file path if format is invalid
        }
    } else {
        // Retain the old image path if no new image is uploaded
        $fileFullPath = $_POST["existing_member_img"] ?? '';
    }

    // Prepare SQL update statement
    $sql = "UPDATE team_section SET member = ?, position = ?, member_img = ?, fb_link = ?, twit_link = ?, linkedin_link = ?, insta_link = ?, links_status = ?, status = ? WHERE team_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssiii", $member, $position, $fileFullPath, $fb_link, $twit_link, $linkedin_link, $insta_link, $links_status, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data updated successfully!'); window.location.href = 'team-section.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $sql = "SELECT * FROM team_section WHERE team_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $member = $row["member"];
        $position = $row["position"];
        $fb_link = $row["fb_link"];
        $twit_link = $row["twit_link"];
        $linkedin_link = $row["linkedin_link"];
        $insta_link = $row["insta_link"];
        $links_status = $row["links_status"];
        $status = $row["status"];
        $fileFullPath = $row["member_img"];
    } else {
        $member = "";
        $position = "";
        $fb_link = "";
        $twit_link = "";
        $linkedin_link = "";
        $insta_link = "";
        $links_status = "";
        $status = "";
        $fileFullPath = "";
    }
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
                        <h4 class="page-title">Team Section</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $id; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="team-member" class="form-label">Member Name:</label>
                                            <input type="text" id="team-member" name="member" class="form-control" placeholder="Member Name" value="<?php echo $member; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="team-position" class="form-label">Position:</label>
                                            <input type="text" id="team-position" name="position" class="form-control" placeholder="Position" value="<?php echo $position; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fb-link" class="form-label">Facebook Link:</label>
                                            <input type="text" id="fb-link" name="fb_link" class="form-control" placeholder="Facebook Profile Link" value="<?php echo $fb_link; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="twit-link" class="form-label">Twitter Link:</label>
                                            <input type="text" id="twit-link" name="twit_link" class="form-control" placeholder="Twitter Profile Link" value="<?php echo $twit_link; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="linkedin-link" class="form-label">LinkedIn Link:</label>
                                            <input type="text" id="linkedin-link" name="linkedin_link" class="form-control" placeholder="LinkedIn Profile Link" value="<?php echo $linkedin_link; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="insta-link" class="form-label">Instagram Link:</label>
                                            <input type="text" id="insta-link" name="insta_link" class="form-control" placeholder="Instagram Profile Link" value="<?php echo $insta_link; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="socail-button" class="form-label">Social Buttons Active / Inactive</label>
                                            <select class="form-select" id="social-button" name="links_status">
                                                <option value="1" <?php if ($links_status == 1) echo "selected"; ?>>Active</option>
                                                <option value="0" <?php if ($links_status == 0) echo "selected"; ?>>Deactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="member-img" class="form-label">Member Image</label>
                                            <?php if (!empty($fileFullPath)) : ?>
                                                <p>Current File: <?php echo basename($fileFullPath); ?></p>
                                                <img class="mb-3" src="<?php echo htmlspecialchars($fileFullPath); ?>" alt="Uploaded Image" style="max-width: 100px;">
                                            <?php endif; ?>
                                            <input type="file" id="member-img" name="member_img" class="form-control">
                                            <input type="hidden" name="existing_member_img" value="<?php echo htmlspecialchars($fileFullPath); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-status">Status ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-status" name="status" <?php if ($status == 1) echo "checked"; ?>>
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
