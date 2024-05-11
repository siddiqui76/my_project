<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles can be added here */
        .blog-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .blog-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .btn-edit {
            cursor: pointer;
           color: white;
        }
        .btn-delete {
            cursor: pointer;
            color:white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>My Blogs</h1>
        <?php
        require_once 'config.php';
        session_start();

        if(!isset($_SESSION['email'])){
            header('location: login.php');
            exit();
        }
        $author_email = $_SESSION['email']; //get the email of the logged in user

        $sql = "SELECT * FROM blogs WHERE author_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $author_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='blog-card'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p><strong>Author:</strong> " . $row["author_email"] . "</p>";
                echo "<p><strong>Created At:</strong> " . date('F j, Y', strtotime($row['created_at'])) . "</p>";
                echo "<p>" . $row["content"] . "</p>";

                // Display the image if image_blob is not empty
                if (!empty($row["image_blob"])) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image_blob"]) . '" alt="Blog Image">';
                }

                echo "<a href='edit_blog.php?id=" . $row['blog_id'] . "' class='btn btn-primary btn-edit'>Edit</a>";
                echo "<a href='delete_blog.php?id=" . $row['blog_id'] . "' class='btn btn-danger btn-delete ml-2'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No blogs found.</p>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
