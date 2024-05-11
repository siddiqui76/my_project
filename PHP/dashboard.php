<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG DASHBOARD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome to the Blog.pK Dashboard</h1>
        <?php
        session_start();
        require_once 'config.php'; 

        if (isset($_SESSION['email'])) {
            echo '<a href="create_blog.php" class="btn btn-primary mt-3">Create a new blog post</a>';
            echo '<a href="myprofile.php" class="btn btn-secondary mt-3 ml-2">MY PROFILE</a>';
            echo '<hr>';
        } else {
            echo '<p class="mt-3"><strong>Note:</strong> You are currently not logged in. <a href="login.php">Login</a> or <a href="register.php">Signup</a> to create or manage your blogs.</p>';
        }

        $sql = "SELECT * FROM blogs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='mt-4'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p><strong>Author:</strong> " . $row["author_email"] . "</p>";
                echo "<p><strong>Created At:</strong> " . date('F j, Y', strtotime($row['created_at'])) . "</p>";
                echo "<p>" . $row["content"] . "</p>";
                
                if (!empty($row["image_blob"])) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image_blob"]) . '" alt="Blog Image" class="img-fluid"><br>';
                }

                echo "<form action='comment_process.php' method='post'>";
                echo "<input type='hidden' name='blog_id' value='" . $row['blog_id'] . "'>";
                echo "<textarea name='comment_content' rows='2' cols='40' class='form-control mb-2' placeholder='Write a comment...' required></textarea><br>";
                echo "<button type='submit' class='btn btn-primary'>Comment</button>";
                echo "</form>";

                $blog_id = $row['blog_id'];
                $comments_sql = "SELECT * FROM comments WHERE blog_id = ?";
                $stmt = $conn->prepare($comments_sql);
                $stmt->bind_param("i", $blog_id);
                $stmt->execute();
                $comments_result = $stmt->get_result();

                if ($comments_result->num_rows > 0) {
                    echo "<h4 class='mt-3'>Comments:</h4>";
                    while ($comment = $comments_result->fetch_assoc()) {
                        echo "<p><strong>" . $comment['client_email'] . ":</strong> " . $comment['comment_content'] . "</p>";
                    }
                } else {
                    echo "<p>No comments yet.</p>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No blogs found.</p>";
        }

        $conn->close();
        ?>
        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>
</body>
</html>
