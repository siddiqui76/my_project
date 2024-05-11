<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
 
</head>
<body>
    <div class="container">
        <h1 class="mt-5">WELCOME TO BLOG.PK REGISTER YOURSELF BELOW!</h1>
        <form action="register_process.php" method="post" class="mt-3">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name..." required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email..." required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" name="age" id="age" class="form-control" placeholder="Enter Age...">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number...">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password..." required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
            <p class="mt-3">Already have an account? <a href="login.php">Click here</a> to login</p>
        </form>
    </div>
</body>
</html>
