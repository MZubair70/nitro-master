<?php
session_start();
include 'include/db_conn.php';

if (isset($_POST['status'])) {
    $status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE front_section SET status = '$status' WHERE fr_id = 1";
    $stmt = $conn->query($sql);

    if ($stmt) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
