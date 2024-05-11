<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    $sql = "SELECT * FROM blogs WHERE blog_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $blog = $result->fetch_assoc();
    } else {
        echo "Blog not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Blog</h1>
        <form action="update_blog.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="blog_id" value="<?php echo isset($blog['blog_id']) ? $blog['blog_id'] : ''; ?>">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo $blog['title']; ?>">
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" name="content" id="content" rows="5" cols="50"><?php echo $blog['content']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="current_image">Current Image:</label><br>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($blog['image_blob']); ?>" alt="Current Image">
            </div>

            <div class="form-group">
                <label for="image">Image:</label><br>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update Blog</button>
        </form>
    </div>
</body>

</html>
