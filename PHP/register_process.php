<?php
require_once 'config.php'; 

if (isset($_POST['register'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // WHERE condition match karegi us email ko jo humne registration form me provide kari hai aur jo pehle se database me hai
    // phir uske baad hum conditional statement use kar sakte hain
    $check_email = "SELECT * FROM clients WHERE email = '$email'";
    $result_email = $conn->query($check_email);  // The SQL query stored in $check_email is intended to select rows from the clients table where the email address matches a specific value.

    if ($result_email->num_rows > 0) { // yeh num_rows>0 check karega ke jo email receive hui hai woh agar pehle se database me hai tu..
        echo "Email is already registered. Please use a different email address.";
    } else {
       
        $sql = "INSERT INTO clients (name, email, age, phone, password) VALUES ('$name', '$email', '$age', '$phone', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Congratulations! You are now registered On Blog.pk . Click <a href='login.php'>here</a> to login.";
        } else {
            echo "Error while registering.";
        }

    }
    
} else {

    header("Location: register.php");
    exit();
}
?>
