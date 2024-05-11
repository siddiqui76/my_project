<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = $_POST['blog_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle file upload
    if (!empty($_FILES['image']['tmp_name'])) {
        $image_tmp = $_FILES['image']['tmp_name']; // Get the temporary file path
        $image_data = file_get_contents($image_tmp); // Read the image file into a variable

        // Update the blog with the new image blob
        $update_sql = "UPDATE blogs SET title = ?, content = ?, image_blob = ? WHERE blog_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssi", $title, $content, $image_data, $blog_id);
    } else {
        // Update the blog without changing the image
        $update_sql = "UPDATE blogs SET title = ?, content = ? WHERE blog_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $title, $content, $blog_id);
    }

    if ($stmt->execute()) {
        echo "Blog updated successfully. Redirecting to dashboard.";
        header('Refresh: 2; URL=dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted via POST method, redirect to the dashboard
    header('Location: dashboard.php');
    exit;
}
?>
