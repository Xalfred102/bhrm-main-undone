<?php

require '../php/connection.php';


if(isset($_POST['update'])){
    $email = $_GET['update'];
    $password = $_POST['password'];
    $conpassword = $_POST['confirmpassword'];

    $query = "SELECT * FROM `user` WHERE email = '$email' limit 1";
    $result = mysqli_query($conn, $query);

    $errors = array();
    
    if(empty($password) && empty($conpassword)){
        array_push($errors,"Missing all fields");
    }elseif(empty($password)){
        array_push($errors,"Missing Password");
    }elseif($password !== $conpassword){
        array_push($errors,"Password didnt match.");
    }else{
        $query = "UPDATE `user` SET email='$email', `Password`='$password' WHERE email = '$email'";
        mysqli_query($conn, $query);
        header('Location: tenantlogin.php');
    }

    if(count($errors)> 0){
        foreach ($errors as $error){
            echo "<div>$error</div>";
        }
    }
}


if(isset($_POST['back'])){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header('Location: tenantlogin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
<div class="background">
    <div class="head">
        <h2>MBHC</h2>
        <h2>Maranding Boarding House Center</h2>
    </div>
        <form method="post">
            <h2>Change Pass</h2>
            <br>
            <label for="">Password</label>
            <br>
            <input type="password" name="password" placeholder ="Enter Here..">
            <br>
            <br>
            <label for="">Confirm Password</label>
            <br>
            <input type="password" name="confirmpassword" placeholder="Enter Here..">
            <br>
            <br>
            <input type="submit" name="update" value="Update"><br> <br>
            <input type="submit" name="back" value="back"><br> <br>
        </form>
    </div>

    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }a{
            text-decoration: none;
            margin: auto;
            color: white;
            
        }body{
            background-image: url(download.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }p{
            color: white;
            
        }

        .head{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
            color: white;
            grid-column-start: 1;
            grid-column-end: 2;
        }

       

        .background{
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 70px 1fr;
            height: 100vh;
        }

        form{
            background-color: black;
            grid-column-start: 1;
            grid-column-end: 4;
            grid-row-start: 2;
            grid-row-end: 2;
            border-radius: 15px;
            margin: auto;
            padding: 20px;
        }form h2{
            background-color: rgb(51, 51, 51);
            text-align: center;
            color: white;
            margin: 0px 35px 0px 35px;
        }form label{
            color: white;
            font-size: 24px;
        }input[type=submit]{
            padding: 7px;
            background-color: rgb(0, 105, 243);
            border-radius: 6px;
            font-size: 24px;
            color: white;
        }input[type=email]{
            padding: 7px;
            font-size: 18px;
            border-radius: 6px;
        }input[type=text]{
            padding: 7px;
            font-size: 18px;
            border-radius: 6px;
        }input[type=password]{
            padding: 7px;
            font-size: 18px;
            border-radius: 6px;
        }
    </style>
    
</body>
</html>