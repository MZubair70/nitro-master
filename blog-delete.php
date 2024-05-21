<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit();
}

require 'include/db_conn.php'; // Include your database connection file

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $blog_id = intval($_GET['id']); // Convert the id to an integer for safety

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM blog_section WHERE blog_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $blog_id); // Bind the id parameter
        if ($stmt->execute()) {
            // If the delete was successful
            echo "<script>alert('Blog deleted successfully!');</script>";
        } else {
            // If there was an error during the delete
            echo "<script>alert('Error deleting blog: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // If there was an error preparing the statement
        echo "<script>alert('Error preparing delete statement: " . $conn->error . "');</script>";
    }
} else {
    // If no id is provided in the URL
    echo "<script>alert('No blog ID provided!');</script>";
}

$conn->close(); // Close the database connection

// Redirect back to the features list page
echo "<script>window.location.href = 'blog-section.php';</script>";
?>
