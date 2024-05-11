<?php
session_start();
require_once 'config.php'; 

if (isset($_POST['login'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];

 // yaha bhi WHERE Condition match karegi email aur password ko jo login me hoke aya hai usko match karegi database me
    $sql = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
    // query chalane ke  baad match karegi
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;//yeh user ki email session me store karleta hai
        header("location: dashboard.php");
        exit();
    } else{
        echo "invalid username or password";
    }
    $conn->close();
}
?>



















