<?php

    // session start
    session_start();

    // include DB connection
    include('scripts/db.php');
    error_reporting(0);

    // getting the message!
    $message = $_GET['message'];

    // checking if the user is logged in or not!
    if(isset($_SESSION['email'])) { // if logged in!

        header('Location: ./chats.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wassup</title>
    <!-- External stylesheets -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4 text-center">
    <?php
        if($message != "") {
    ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong><?=$message?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        }
    ?>
        <div class="card" style = "display : inline-block">
            <div class="card-title mt-4">
                <strong><h4>Login</h4></strong>
            </div>
            <div class="card-body">
                <form action="scripts/login.php" method = "POST">
                    <div class="form-group">
                        <input type="email" name = "email" id = "email" placeholder = "Email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "password" id = "password" placeholder = "Password" class="form-control" required/>
                    </div>
                    <button type = "submit" class = "btn btn-outline-primary">Login</button>
                    <p class = "text-muted mt-2">New to Wassup? <a href="./register.php">Register Here!</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts! -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>