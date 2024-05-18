<?php 
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

require 'include/db_conn.php';

if (isset($_POST["submit"])) {
    $member = $_POST["member"] ?? '';
    $position = $_POST["position"] ?? '';
    $fb_link = $_POST["fb_link"] ?? '';
    $twit_link = $_POST["twit_link"] ?? '';
    $linkedin_link = $_POST["linkedin_link"] ?? '';
    $insta_link = $_POST["insta_link"] ?? '';
    $links_status = isset($_POST["links_status"]) ? 1 : 0;
    $status = isset($_POST["status"]) ? 1 : 0;
    
    // Check if file is uploaded
    $fileFullPath = '';
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
    }

    // Prepare SQL insert statement
    $sql = "INSERT INTO team_section (member, position, fb_link, linkedin_link, insta_link, status, member_img) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssis", $member, $position, $fb_link, $linkedin_link, $insta_link, $status, $fileFullPath);

    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.location.href = 'team-section.php';</script>";
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
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="team-member" class="form-label">Member Name:</label>
                                            <input type="text" id="team-member" name="member" class="form-control" placeholder="Member Name" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="team-position" class="form-label">Position:</label>
                                            <input type="text" id="team-position" name="position" class="form-control" placeholder="Position" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fb-link" class="form-label">Facebook Link:</label>
                                            <input type="text" id="fb-link" name="fb_link" class="form-control" placeholder="Facebook Profile Link" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="twit-link" class="form-label">Twitter Link:</label>
                                            <input type="text" id="twit-link" name="twit_link" class="form-control" placeholder="Twitter Profile Link" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="linkedin-link" class="form-label">LinkedIn Link:</label>
                                            <input type="text" id="linkedin-link" name="linkedin_link" class="form-control" placeholder="LinkedIn Profile Link" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="insta-link" class="form-label">Instagram Link:</label>
                                            <input type="text" id="insta-link" name="insta_link" class="form-control" placeholder="Instagram Profile Link" value="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="socail-button" class="form-label">Socaial Buttons Active / Deactive</label>
                                            <select class="form-select" id="socail-button" name="button">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="member-img" class="form-label">Member Image</label>
                                            <input type="file" id="member-img" name="member_img" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-status">Status ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-status" name="status">
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
