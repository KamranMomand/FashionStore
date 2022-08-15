<?php
session_start();
include 'config.php';

if (isset($_POST['Signup'])) {
    $fname = htmlspecialchars($_POST['f_name']);
    $email = htmlspecialchars($_POST['s_email']);
    $phone = htmlspecialchars($_POST['s_phone']);
    $username = htmlspecialchars($_POST['s_username']);
    $pass = htmlspecialchars($_POST['s_pass']);
    $encpass = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO `user`(`name`, `email`, `contact_Phone`, `username`, `password`) VALUES ('$fname','$email','$phone','$username','$encpass')";
    $result = mysqli_query($conn, $query);
    echo $result;
}

if (isset($_POST['Signin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['l_email']);
    $pass = mysqli_real_escape_string($conn, $_POST['l_pass']);

    $queryl = "SELECT * FROM `user` WHERE `email` = '$email'";
    $resultl = mysqli_query($conn, $queryl);

    $checkl = mysqli_num_rows($resultl) > 0;
    if ($checkl > 0) {
        $rowl = mysqli_fetch_assoc($resultl);
        if (password_verify($pass, $rowl['password'])) {
            $_SESSION['Username'] = $rowl['name'];
            $_SESSION['User_Id'] = $rowl['id'];
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}
