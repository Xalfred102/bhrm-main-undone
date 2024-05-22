<?php

require '../php/connection.php';

if(!empty($_SESSION["username"]) && !empty($_SESSION["role"])){
    if($_SESSION["role"] == 'user'){
        header("Location: index.php");
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
            <div>
                <h2>Maranding Boarding House Center</h2>
            </div>
            
        </div>
        
        <div class="icon">
            <div>
                <h2>MBHC</h2>
            </div>
          
        </div>

        <nav>
            <ul>
            <li><a href="index.php">Dashboard</a></li>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="">Payments</a></li>
                <li><a href="">Settings</a></li>
                <li><a href="../php/logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="welcome">
            <div>
                <h2 class="h2">welcome to dashboard, <?php echo $row['fname']?></h2>
            </div>
        </div>

        <div class="tenant">
            <div>
                <h2>tenant</h2>
                <h2>1</h2>
            </div>
        </div>

        <div class="room">
            <div>
                <h2>room</h2>
                <h2>1</h2>
            </div>
        </div>  

        <div class="add-tenant">
            <div>
                <a class="a" href="add-tenants.php">Add Admins here</a>
            </div>
        </div>
        
        <div class="table">
            <table border="1px solid black" >
                
                <tr>
                    <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Action</th>
                    </thead>
                </tr>

                <tr>
                    <tbody>
                        <?php
                                    
                            $query = "SELECT * FROM `users` where role = 'admin'";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $email = $row['uname'];
                            $pass = $row['pass'];
                            $role = $row['role']
                        
                            ?>
                            <td> <?php echo $id; ?></td>
                            <td> <?php echo $fname; ?></td>
                            <td> <?php echo $lname; ?></td>
                            <td> <?php echo $email; ?></td>
                            <td> <?php echo $pass; ?></td>
                            <td> <?php echo $role; ?></td>

                            <td >
                                <a href="user-function.php?edit=<?php echo $id;?>">Update</a>
                                <a href="user-function.php?delete=<?php echo $id;?>">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
                </tr>

            </table>
        </div>

    </div>

    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            box-sizing: border-box;
            
        }a{
            text-decoration: none;
            color: white;
        }

        .container{
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: repeat(12, 1fr);

            height: 100vh;
        }

        .head{
            background-color: black;
            grid-column-start: 4;
            grid-column-end: 13;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;

        }

        .icon{

            grid-column-start: 1;
            grid-column-end: 4;
            grid-row-start: 1;
            grid-row-end: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
            color: white;
            width: 100%;
        }

        nav{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(13, 1fr);

            grid-column-start: 1;
            grid-column-end: 3;
            grid-row-start: 2;
            grid-row-end: 13;
            text-align: center;
            background-color: black;
        }

        ul{
            grid-column-start: 2;
            grid-column-end: 3;
            grid-row-start: 2;
            grid-row-end: 5;
            text-align: left;
        }

        li{
            list-style: none;
            padding: 10px;
            font-size: 24px;
            border: 1px solid gray;
            margin-top: 15px;
        }

        .welcome{
            grid-column-start: 6;
            grid-column-end: 10;
            grid-row-start: 3;
            grid-row-end: 3;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
            color: white;
            margin: 5px;
        }

        .tenant{
            grid-column-start: 5;
            grid-column-end: 7;
            grid-row-start: 5;
            grid-row-end: 7;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(0, 0, 0);
            text-align: center;
            color: white;
        }

        .room{
            grid-column-start: 9;
            grid-column-end: 11;
            grid-row-start: 5;
            grid-row-end: 7;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(0, 0, 0);
            text-align: center;
            color: white;
        }

        .add-tenant{
            grid-column-start: 4;
            grid-column-end: 6;
            grid-row-start: 8;
            grid-row-end: 8;
            display: flex;
            justify-content: left;
            align-items: center;
            
        }.add-tenant .a{
            background-color: black;
            padding: 10px;
        }

        .table{
            grid-column-start: 4;
            grid-column-end: 12;
            grid-row-start: 9;
            grid-row-end: 12;
            text-align: center;
            background-color: black;
            color: white;
            
            overflow-y: scroll;
        }.table th, td{
            padding: 15px;
        }th{
            position: sticky;
            top: 0;
            background-color: black;
        }
        table{
            width: 100%;
        }


        
    </style>

</body>
</html>
    


       

