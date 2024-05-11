<?php
session_start();
require_once 'config.php';


// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}


$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];

// $_FILES['image'] $_FILES array ke through image ko apne pas retrieve karlega
$image_tmp = $_FILES['image']['tmp_name']; // When a file is uploaded via HTTP POST, PHP stores the uploaded file in a temporary location on the server. This temporary location is accessible via the 'tmp_name' key of the $_FILES array.


$image_data = file_get_contents($image_tmp); //Therefore, reading the image data using file_get_contents() is a crucial step in the process of storing uploaded images (or any file) into a database

$sql = "INSERT INTO blogs (title, author_email, content, image_blob, created_at) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $title, $_SESSION['email'], $content, $image_data); // Bind image_data parameter as BLOB

if ($stmt->execute()) {
    echo "Blog post created successfully. Redirecting to dashboard.";
    header('Refresh: 2; URL=dashboard.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>







