<?php

require '../php/connection.php';

if(!empty($_SESSION["username"]) && !empty($_SESSION["role"])){
    if($_SESSION['role'] == 'admin'){
        header("location: adminindex.php");
    }else{
        $uname = $_SESSION["username"];
        $result = mysqli_query($conn, "select * from users where uname = '$uname'");
        $row = mysqli_fetch_assoc($result);
    }
 
}else{
    header("Location: ../php/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div class="head">
            <h2>Maranding Boarding House Center</h2>
        </div>
        <div class="icon">
            <h2>MBHC</h2>
            <img src= "yawa.png">
            
        </div>

        <nav>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Bills</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Settings</a></li>
                <li><a href="../php/logout.php">Logout</a><br><br></li>
            </ul>
        </nav>

        
        <div class="content">
            <h2 class="h2">welcome to dashboard, <?php echo $row['fname']?></h2>
        </div>

    </div>

    <style>
        *{
            color: white;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }a{
            text-decoration: none;
            margin: auto;
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

            grid-column-start: 2;
            grid-column-end: 3;
        }

        .icon{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            background-color: black;
            grid-row-start: 1;
            grid-row-end: 2;
            
        }.icon h2{
            background-color: rgb(59, 59, 59);
            padding: 5px 25px;
            text-align: center;
        }.icon img{
            width: 80px;
        }

        .container{
            display: grid;
            grid-template-columns: 250px 1fr;
            grid-template-rows: 70px 1fr;
            height: 100vh;
        }

        nav{
            background-color: black;
            grid-row-start: 2;
            grid-row-end: 3;
            
        }ul{
            text-align: center;
            margin: 30px 50px 0px 50px;
        }li{
            background-color: black;
            padding: 5px;
            font-size: 24px;
            list-style: none;
            border: 1px solid white;
            margin-top: 30px;
        }li:first-child {
            margin-top: 0;
        }li:last-child{
            margin: 70px 20px 0px 1px;
            height: 30px;
        }

        .content{
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 20px;
            margin: auto;

            grid-row-start: 2;
            grid-row-end: 2;
        }.h2{
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            grid-row-start: 1;
            grid-row-end: 2;
            grid-column-start: 1;
            grid-column-end: 3;
            background-color: rgb(0, 0, 0);
            text-align: center;
        }
    </style>

</body>
</html>
    


       

