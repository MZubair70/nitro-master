<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION["user_id"])) {
        // Handle unauthorized access if needed
        exit("Unauthorized access");
    }

    // Include database connection
    require 'include/db_conn.php';

    // Get the new status from the AJAX request
    $status = isset($_POST['status']) ? intval($_POST['ab_status']) : 0;

    // Update the status field in the database
    $sql = "UPDATE about_section SET status = $status WHERE about_id = 1";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    // Close database connection
    $conn->close();
?>
