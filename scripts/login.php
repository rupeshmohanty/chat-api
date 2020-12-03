<?php
    
    // session start
    session_start();

    // include DB connection
    include('./db.php');

    // declaring variables
    $email = "";
    $password = "";

    // getting form data!
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }


    if($email != "" && $password != "") { // if the fields are not empty!
         
        $checkUser = "SELECT * FROM `users` WHERE `email` = '$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { // if user exists!

            $getSalt = "SELECT * FROM `users` WHERE `email` = '$email'";
            $getSaltStatus = mysqli_query($conn,$getSalt) or die(mysqli_error($conn));
            $getSaltRow = mysqli_fetch_assoc($getSaltStatus);

            $salt = $getSaltRow['salt'];
            $dbPassword = $getSaltRow['password'];
            $ePassword = md5(md5($password).$salt);

            if($ePassword == $dbPassword) { // if password entered is correct!

                $_SESSION['email'] = $email;
                header('Location: ../chats.php?message=Yokoso! You have successfully logged in!');

            } else {

                header('Location: ../index.php?message=Password doesnt match!');

            }


        } else {

            header('Location: ../index.php?message=Unable to login into your account!');

        }

    } else { // if the fields are empty!

        header('Location: ../index.php?message=Please fill all the fields!');

    }

?>