<?php
// Include config file for database connection
require_once 'config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

// Check if blog_id is provided via GET request
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $blog_id = $_GET['id'];
    
    // Prepare and execute delete query
    $sql = "DELETE FROM blogs WHERE blog_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    
    if ($stmt->execute()) {
        echo "Blog deleted successfully! Redirecting to Your Profile";

        // Blog deleted successfully, redirect to profile.php
        header('Refresh:2;URL=myprofile.php');
        exit();
    } else {
        // Error occurred during deletion
        echo "Error deleting blog.";
    }

    $stmt->close();
} else {
    // Redirect to profile.php if blog_id is not provided
    header('location: myprofile.php');
    exit();
}

$conn->close();
?>
