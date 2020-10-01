<?php
    
    // session start
    session_start();

    // include DB connection
    include('./db.php');

    // declaring variables
    $email = "";
    $password = "";
    $salt = uniqid();

    // getting form data!
    if(isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
    }

    if(isset($_POST['password'])) {
        $password = mysqli_real_escape_string($conn,strip_tags($_POST['password']));
    }

    $newPassword = md5(md5($password).$salt);

    if($email != "" && $password != "") { // if the fields are not empty!
         
        $checkUser = "SELECT * FROM `users` WHERE BINARY `email` = '$email' AND BINARY `password` = '$newPassword'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { // if user exists!

            header('Location: ../chats.php?message=You have logged in!');

        } else {

            header('Location: ../index.php?message=Unable to login into your account!');

        }

    } else { // if the fields are empty!

        header('Location: ../index.php?message=Please fill all the fields!');

    }

    $_SESSION['email'] = $email;
?>