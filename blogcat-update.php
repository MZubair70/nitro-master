<?php 
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

// Include the database connection file
require 'include/db_conn.php';

// Initialize variables
$blog_cat = '';
$status = 0;
$isUpdate = false;

// Check if an ID is provided in the URL for updating
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $isUpdate = true;

    // Fetch the existing category data
    $sql = "SELECT blog_cat, status FROM blog_categories WHERE blogImg_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($blog_cat, $status);
    $stmt->fetch();
    $stmt->close();
}

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Get the values from the form
    $blog_cat = ucfirst($_POST["blog_cat"]);
    $status = isset($_POST["status"]) ? 1 : 0;

    if ($isUpdate) {
        // Prepare the update query
        $sql = "UPDATE blog_categories SET blog_cat = ?, status = ? WHERE blogImg_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $blog_cat, $status, $id);
    } else {
        // Prepare the insert query
        $sql = "INSERT INTO blog_categories (blog_cat, status) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $blog_cat, $status);
    }

    // Execute the query
    if ($stmt->execute()) {
        if ($isUpdate) {
            echo "<script>alert('Category updated successfully!');</script>";
        } else {
            echo "<script>alert('Category added successfully!');</script>";
        }
        echo "<script>window.location.href = 'blog-cat.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<?php include 'include/header.php'; ?>

<!-- Left Sidebar -->
<?php include 'include/sidebar.php'; ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="page-title-box">
                        <h4 class="page-title"><?php echo $isUpdate ? 'Update Blog Category' : 'Add Blog Category'; ?></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?><?php echo $isUpdate ? '?id=' . $id : ''; ?>" method="post" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="blog_cat" class="form-label">Category Name:</label>
                                            <input type="text" id="blog_cat" name="blog_cat" class="form-control" placeholder="Category Name" value="<?php echo htmlspecialchars($blog_cat); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="statusSwitch">Status</label>
                                                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="1" <?php echo $status ? 'checked' : ''; ?>>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="col-9">
                                                <button type="submit" name="submit" class="btn btn-info"><?php echo $isUpdate ? 'Update' : 'Submit'; ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by <b>Techzaa</b>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</div>
<!-- End content-page -->

<!-- Include Footer -->
<?php include 'include/footer.php'; ?>
