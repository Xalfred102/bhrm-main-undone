<?php

require 'connection.php';

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $query = "DELETE FROM `user` WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if($result){
        header('Location: home.php');
    }
}
?>


<?php


if(empty($_SESSION["id"])){
    header("Location: home.php");
}


if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $id = $_GET['update'];
    $errors = array();
    
    if(empty($fname) && empty($lname) && empty($email) && empty($password)){
        array_push($errors,"Missing all fields");
    }elseif(empty($fname)){
        array_push($errors,"Missing First Name");
    }elseif(empty($lname)){
        array_push($errors,"Missing Last Name");
    }elseif(empty($email)){
        array_push($errors,"Missing Email");
    }elseif(empty($password)){
        array_push($errors,"Missing Password");
    }else{
        $query = "UPDATE `user` SET id = $id, `FirstName`='$fname',`LastName`='$lname', Email = '$email',`Password`='$password' where id = $id";
        mysqli_query($conn, $query);
        echo "Successfully updated the information.";
    }

    if(count($errors)> 0){
        foreach ($errors as $error){
            echo "<div>$error</div>";
        }
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
<div class="signupbackground">
        <form class="signupheader" method="post">
            <div class="input">
                <h2>Update Your Account</h2>
                <br>
                <label for="">First Name</label>
                <br>
                <input type="text" name="fname" placeholder ="Enter Here..">
                <br>
                <br>
                <label for="">Last Name</label>
                <br>
                <input type="text" name="lname" placeholder ="Enter Here..">
                <br>
                <br>
                <label for="">Email</label>
                <br>
                <input type="text" name="email" placeholder ="Enter Here..">
                <br>
                <br>
                <label for="">Password</label>
                <br>
                <input type="password" name="password" placeholder ="Enter Here..">
                <br>
                <br>
                <button type="submit" name="submit">Update</button> <br> <br>
                <a href="home.php">Back</a>
            </div>
        </form>
    </div>
    
</body>
</html>