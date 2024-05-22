<?php

require '../php/connection.php';


if(isset($_POST['submit'])){
    $email = $_POST['email'];

    $errors = array();
    
    if(empty($email)){
        array_push($errors,"Missing Email");
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not valid.");
    }

    $query = "SELECT * FROM `user` WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if(count($errors) > 0){
        foreach ($errors as $error){
            echo "<div>$error</div>";
        }
    }elseif(mysqli_num_rows($result)){
        $_SESSION["email"] = $row["email"];
        header("Location: tenantreset.php?update=$email");
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
            <h2>Confirm Email</h2>
            <br>
            <label for="">Email</label>
            <br>
            <input type="text" name="email" placeholder ="Enter Here..">
            <br>
            <br>
            <input type="submit" name="submit" value="Submit"><br> <br>
            <a href="tenantlogin.php">Login HERE..</a>
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