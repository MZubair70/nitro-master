<?php 
    session_start();

    // Check if the user is not logged in, redirect to the login page
    if (!isset($_SESSION["user_id"])) {
        header("Location: admin.php");
        exit();
    }

    // Include the database connection file
    require 'include/db_conn.php';

    // Check if the form is submitted
    if (isset($_POST["submit"])) {
        // Get the values from the form
        $cat_name = $_POST["cat_name"];
        $status = isset($_POST["status"]) ? 1 : 0;

        // Prepare the insert query
        $sql = "INSERT INTO categories_section (cat_name, status) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $cat_name, $status);

        // Execute the insert query
        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully!');</script>";
            echo "<script>window.location.href = 'categories-section.php';</script>";
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
                        <h4 class="page-title">Categories Section</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="cat_name" class="form-label">Category Name:</label>
                                            <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Category Name">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="statusSwitch">Status</label>
                                                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="1">
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
