<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">LOGIN TO BLOG.PK</h1>
        <form action="login_process.php" method="post" class="mt-3">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email Address..." required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password..." required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>

