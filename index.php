<?php
require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    $uname = $_SESSION["uname"];
    $role = $_SESSION["role"];
    $result = mysqli_query($conn, "select * from users where uname = '$uname'");
    $fetch = mysqli_fetch_assoc($result);
} else {
    echo '<script> alert("YOU MUST LOG IN FIRST")</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            background-image: url('images/pxfuel.jpg');
            background-size: cover; /* Ensure the background image covers the entire screen */
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* Set the height of the body to 100% of the viewport height */
        }

        .navbar {
            background-color: #a9a9a9;
        }

        .navbar-brand img {
            width: 80px;
            height: 80px;
        }

        .nav-link {
            color: #fff !important;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
        }

        .content {
            color: #fff;
            margin-top: 50px;
        }

        .add-boarding {
            padding: 15px;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-4 {
            margin-bottom: 20px;
        }

        .boarding-house-card {
            background-color: #a9a9a9;
            color: #fff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            height: 100%;
        }

        .boarding-house-card img {
            width: 100%;
            height: 200px; /* Fixed height for the image */
            object-fit: cover; /* Ensure the image covers the entire box */
            border-radius: 20px 20px 0 0; /* Rounded corners only on the top */
        }

        .boarding-house-card h5,
        .boarding-house-card p {
            margin-bottom: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            padding-top: 10px;
        }

        .btn-container button {
            flex: 0 0 48%; /* Make buttons fill the container with small gap between */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <?php
                if ($_SESSION == true) {
                    echo '<a class="btn btn-warning" href="php/logout.php">Logout</a>';
                } else {
                    echo '<a class="btn btn-warning" href="php/login.php">Login</a>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container content">
        <h1>Welcome to Maranding Boarding House Center 
        <?php if (!empty($_SESSION)) {
            echo $fetch['fname'];
        } 
        ?>
        </h1>
        <p>Where we show you the best boarding houses around Maranding. Please select your desired boarding house and
            have an amazing experience and chill moments ahead.</p>
    </div>

    <?php
    if (!empty($_SESSION) && $_SESSION['role'] == "admin") {
    ?>
        <div class="container add-boarding">
            <a class="btn btn-warning" href="php/addbh.php" class="text-white">Add Boarding House</a>
        </div>
    <?php
    }
    ?>


    <div class="container">
        <div class="row">
            <?php
            if (empty($_SESSION) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'landlord') {
                $query = "select * from boardinghouses";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_assoc($result)) {
                    $id = $fetch['id'];
            ?>
                    <div class="col-md-4">
                        <div class="boarding-house-card">
                            <img src="<?php echo $fetch["image"] ?>" alt="Boarding House">
                            <h5>Name: <?php echo $fetch["hname"] ?></h5>
                            <p>Owner: <?php echo $fetch["owner"] ?></p>
                            <p>Address: <?php echo $fetch["haddress"] ?></p>
                            <div class="btn-container">
                                <?php if (!empty($_SESSION) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="php/function.php?edit=<?php echo $id; ?>"><button class="btn btn-warning">Update</button></a>
                                    <a href="php/function.php?delete=<?php echo $id; ?>"><button class="btn btn-warning">Delete</button></a>
                                <?php else : ?>
                                    <a href="boardinghouse.php?id=<?php echo $id; ?>" class="btn btn-warning">More Details</a>
                                <?php endif; ?>

                                <?php if (!empty($_SESSION) && $_SESSION['role'] == 'landlord'): ?>
                                    <a href="php/function.php?edit=<?php echo $id; ?>"><button class="btn btn-warning">Update</button></a>
                                    <a href="php/function.php?delete=<?php echo $id; ?>"><button class="btn btn-warning">Delete</button></a>
                                <?php else : ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
