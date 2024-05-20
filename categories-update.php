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
        // Get the id value from the query string
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        // Get the fields to update
        $fieldsToUpdate = array();
        if (isset($_POST["cat_name"])) {
            $fieldsToUpdate[] = "cat_name = '{$_POST["cat_name"]}'";
        }

        // Handle status switch
        $status = isset($_POST["status"]) ? 1 : 0;
        $fieldsToUpdate[] = "status = '{$status}'";

        // Construct the update query
        $updateFields = implode(", ", $fieldsToUpdate);
        $sql = "UPDATE categories_section SET {$updateFields} WHERE cat_id = $id";
        
        // Execute the update query
        $stmt = $conn->query($sql);
        if ($stmt) {
            echo "<script>alert('Data updated successfully!');</script>";
            echo "<script>window.location.href = 'categories-section.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Fetch existing data from the database
        // Get the id value from the query string
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        $sql = "SELECT * FROM categories_section WHERE cat_id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cat_name = $row["cat_name"];
            $status = $row["status"];
        } else {
            // Handle case where no data is found
            $cat_name = "";
            $status = "";
        }
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
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id; ?>" method="post" class="form-horizontal">
                                    
                                        <div class="mb-3">
                                            <label for="cat_name" class="form-label">Category Name:</label>
                                            <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" value="<?php echo htmlspecialchars($cat_name); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-lg">
                                                <label class="form-check-label" for="statusSwitch">Status</label>
                                                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="1" <?php if ($status == 1) echo "checked"; ?>>
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
