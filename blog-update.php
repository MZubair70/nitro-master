<?php 
    session_start();
    require 'include/db_conn.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

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
        // Update existing blog post
        $title = $_POST["title"] ?? '';
        $blog_para = $_POST["blog_para"] ?? '';
        $upload_by = $_POST["upload_by"] ?? '';
        $status = isset($_POST["status"]) ? 1 : 0;
        
        // Check if file is uploaded and update image if necessary
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
        $stmt->bind_param("sssisi", $title, $blog_para, $upload_by, $status, $fileFullPath, $blog_id);

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
                        <h4 class="page-title">Update Blog Post</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $blog_id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="blog-title" class="form-label">Title:</label>
                                            <input type="text" id="blog-title" name="title" class="form-control" placeholder="Blog Title" value="<?php echo $row['title']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="blog-para" class="form-label">Content:</label>
                                            <textarea class="form-control" id="blog-para" name="blog_para" rows="6" placeholder="Blog Content"><?php echo $row['blog_para']; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="upload-by" class="form-label">Uploaded By:</label>
                                            <input type="text" id="upload-by" name="upload_by" class="form-control" placeholder="Uploader's Name" value="<?php echo $row['upload_by']; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="blog-img" class="form-label">Blog Image:</label>
                                            <input type="file" id="blog-img" name="blog_img" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="toggle-status">Status ON/OFF</label>
                                                <input class="form-check-input" type="checkbox" id="toggle-status" name="status" <?php if ($row['status'] == 1) echo "checked"; ?>>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="col-9">
                                                <button type="submit" name="submit" class="btn btn-info">Update</button>
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

<!-- Include footer and other necessary files -->
<?php include 'include/theme-setting.php'; ?>
<?php include 'include/footer.php'; ?>