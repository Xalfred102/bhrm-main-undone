<?php
require 'connection.php';

if(!empty($_SESSION['username']) && !empty($_SESSION['role'])){
    header("Location: ../admin/index.php");
}


if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = array();
    
    if(empty($email) && empty($password)){
        array_push($errors,"Missing all fields");
    }elseif(empty($email)){
        array_push($errors,"Missing Email");
    }elseif(empty($password)){
        array_push($errors,"Missing Password");
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not valid.");
    }

    $query = "SELECT * FROM `users` WHERE uname = '$email' and pass = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if(count($errors) > 0){
        foreach ($errors as $error){
            echo "<div>$error</div>";
        }
    }if(mysqli_num_rows($result)){
        $role = $row['role'];
        if($role == 'admin'){
            $_SESSION["username"] = $row['uname'];
            $_SESSION["role"] = $row["role"];
            header("Location: ../admin/index.php");
        }
        if($role == 'user'){
            $_SESSION["username"] = $row['uname'];
            $_SESSION["role"] = $row["role"];
            header("Location: ../tenant/index.php");
        }
    }else{
        echo "Account is not found.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="background">
    
    <div class="icon">
        
    </div>
        <form method="post">
            <h2>Login</h2>
            <br>
            <label for="">Email</label>
            <br>
            <input type="email" name="email" placeholder ="Enter Here..">
            <br>
            <br>
            <label for="">Password</label>
            <br>
            <input type="password"  name="password" placeholder ="Enter Here..">
            <br>
            <br>
            <input type="submit" name="submit" value="Submit">
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
            font-size: 24px;
        }body{
            background-image: url(download.jpg);
            background-repeat: no-repeat;
            background-size: cover;
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
        }input[type=password]{
            padding: 7px;
            font-size: 18px;
            border-radius: 6px;
        }
    </style>
</body>
</html>