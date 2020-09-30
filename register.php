<?php

    // session start
    session_start();

    // include DB connection
    include('./db.php');

    // declaring variables
    $name = "";
    $email = "";
    $password = "";
    $cpassword = "";
    $salt = uniqid();

    // get form data
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if(isset($_POST['password'])) {
        $cpassword = $_POST['password'];
    }

    $newPassword = md5(md5($password).$salt);

    // setting up the target directory where you want to upload your images!
    $target_dir = "../dp/";
    $target_file = $target_dir . basename($_FILES["dp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dp"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File is not an image.";
        $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["dp"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
  
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["dp"]["name"]). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }

    if($name != "" && $email != "" && $password != "" && $cpassword != "") { // if the form fields are not empty!
        
        $checkUser = "SELECT * FROM users WHERE BINARY email = '$email' AND BINARY password = '$newPassword'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { // if user exists!

            header('Location: ../index.php?message=You have already registered!');

        } else {

            if($password == $cpassword) { // if the password fields match!
            
                $image = basename($_FILES["dp"]["name"]);
                $insertUser = "INSERT INTO users(name,email,password,dp,salt) VALUES('$name','$email','$newPassword','$image','$salt')";
                $insertUserStatus = mysqli_query($conn,$insertUser) or die(mysqli_error($conn));
    
                if($insertUserStatus) { // if the user is successfully registered!
      
                    header('Location: ../index.php?message=You have registered successfully!');
    
                }  else { // if user is not registered successfully!
    
                    header('Location: ../register.php?message=Unable to register!');
    
                }
    
            } else { // if password fields dont match!
    
                header('Location: ../register.php?message=Password fields do not match!');
    
            }

        }


    } else { // if any of the fields are empty!

        header('Location: ../register.php?message=Please fill the fields properly!');  

    }
?>
