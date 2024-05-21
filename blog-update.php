<?php 
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

require 'include/db_conn.php';

// Fetch categories from the database
$categories = [];
$sql = "SELECT blogImg_id, blog_cat FROM blog_categories WHERE status = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch the blog post data if an ID is provided
$blogId = $_GET['id'] ?? '';
$blogData = null;
if ($blogId) {
    $sql = "SELECT * FROM blog_section WHERE blog_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();
    $blogData = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST["submit"])) {
    $title = $_POST["title"] ?? '';
    $blog_para = nl2br($_POST["blog_para"]) ?? ''; // Convert newlines to HTML line breaks
    $upload_by = $_POST["upload_by"] ?? '';
    $status = isset($_POST["status"]) ? 1 : 0;
    $category_id = $_POST["category_id"] ?? '';

    // Check if file is uploaded
    $fileFullPath = $blogData['blog_img'] ?? ''; // Use existing image if no new image is uploaded
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
    if ($blogId) {
        $sql = "UPDATE blog_section SET title = ?, blog_para = ?, upload_by = ?, status = ?, blog_img = ?, blogcat_id = ? WHERE blog_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisii", $title, $blog_para, $upload_by, $status, $fileFullPath, $category_id, $blogId);
    } else {
        echo "Error: Invalid Blog ID";
        exit();
    }

    if ($stmt->execute()) {
        echo "<script>alert('Blog post updated successfully!');</script>";
        echo "<script>window.location.href = 'blog-section.php';</script>";
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
                        <h4 class="page-title"><?php echo $blogId ? "Edit Blog Post" : "Add New Blog Post"; ?></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $blogId; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="blog-title" class="form-label">Title:</label>
                                            <input type="text" id="blog-title" name="title" class="form-control" placeholder="Blog Title" value="<?php echo $blogData['title'] ?? ''; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="blog-para" class="form-label">Content:</label>
                                            <textarea class="form-control" id="blog-para" name="blog_para" rows="6" placeholder="Blog Content"><?php echo $blogData['blog_para'] ?? ''; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="upload-by" class="form-label">Uploaded By:</label>
                                            <input type="text" id="upload-by" name="upload_by" class="form-control" placeholder="Uploader's Name" value="<?php echo $blogData['upload_by'] ?? ''; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="blog-img" class="form-label">Blog Image:</label>
                                            <input type="file" id="blog-img" name="blog_img" class="form-control">
                                            <?php if (!empty($blogData['blog_img'])): ?>
                                                <img src="<?php echo $blogData['blog_img']; ?>" alt="Blog Image" style="width: 100px; height: auto; margin-top: 10px;">
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category:</label>
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['blogImg_id']; ?>" <?php echo ($blogData['blogcat_id'] ?? '') == $category['blogImg_id'] ? 'selected' : ''; ?>><?php echo $category['blog_cat']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-status">Status ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-status" name="status" <?php echo isset($blogData['status']) && $blogData['status'] == 1 ? 'checked' : ''; ?>>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="col-9">
                                                <button type="submit" name="submit" class="btn btn-info"><?php echo $blogId ? "Update" : "Submit"; ?></button>
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
