<?php 
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

require 'include/db_conn.php';

// Fetch categories from the database
$cat_sql = "SELECT cat_id, cat_name FROM categories_section WHERE status = 1";
$cat_result = $conn->query($cat_sql);

if (isset($_POST["submit"])) {
    $cat_id = $_POST["cat_id"] ?? '';
    $status = isset($_POST["status"]) ? 1 : 0;

    // Check if file is uploaded
    $fileFullPath = '';
    if (!empty($_FILES["cat_img"]["name"])) {
        $targetDir = "imgs/";
        $fileName = basename($_FILES["cat_img"]["name"]);
        $fileFullPath = $targetDir . $fileName;
        $fileType = pathinfo($fileFullPath, PATHINFO_EXTENSION);

        // Check if file type is allowed
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the desired location
            if (!move_uploaded_file($_FILES["cat_img"]["tmp_name"], $fileFullPath)) {
                echo "<script>alert('Error uploading file!');</script>";
                $fileFullPath = ''; // reset file path if upload fails
            }
        } else {
            echo "<script>alert('Invalid file format!');</script>";
            $fileFullPath = ''; // reset file path if format is invalid
        }
    }

    // Prepare SQL insert statement
    $sql = "INSERT INTO categories_imgs (cat_img, cat_id, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fileFullPath, $cat_id, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.location.href = 'categories-images.php';</script>";
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
                        <h4 class="page-title">Image Categories</h4>
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
                                            <label for="cat-img" class="form-label">Category Image:</label>
                                            <input type="file" id="cat-img" name="cat_img" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="cat_id" class="form-label">Category:</label>
                                            <select id="cat_id" name="cat_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php 
                                                    // Loop through the result set to create options for each category
                                                    if ($cat_result->num_rows > 0) {
                                                        while ($row = $cat_result->fetch_assoc()) {
                                                            echo "<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
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
