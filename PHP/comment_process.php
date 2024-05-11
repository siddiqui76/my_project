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
    // Get the comment content and blog ID from the form submission
    $comment_content = $_POST['comment_content'];
    $blog_id = $_POST['blog_id'];

$sql = "INSERT INTO comments (blog_id, client_email, comment_content, comment_date) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $blog_id, $_SESSION['email'], $comment_content);
$stmt->execute();

    // Redirect back to the dashboard after adding the comment
    header('Location: dashboard.php');
    exit;
} else {
    // If the form is not submitted via POST method, redirect to the dashboard
    header('Location: dashboard.php');
    exit;
}
?>
