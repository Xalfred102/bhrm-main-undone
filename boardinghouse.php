<?php 
require 'php/connection.php';

if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"])){
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "select * from boardinghouses where id = $id";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);   
    }
}else{
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Custom CSS */
        body {
            background-color: #e6e6e6; /* Background color */
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .card-img-container {
            width: 200px; /* Adjust as needed */
            height: 200px; /* Adjust as needed */
            overflow: hidden;
            margin: 0 auto; /* Center the image horizontally */
        }
        .card-img-container img {
            width: 100%; /* Make the image fill its container */
            height: 100%; /* Make the image fill its container */
            object-fit: cover; /* Cover the container without distortion */
        }
        .image-box {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.text-box {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.text-box {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.card {
    background-color: #a9a9a9; /* Change background color to #a9a9a9 */
    color: #fff; /* Text color */
    border-radius: 20px; /* Rounded corners */
    padding: 20px; /* Padding */
    margin-bottom: 20px; /* Bottom margin */
}

.card-body {
    padding: 10px; /* Padding */
}

    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" width="80" height="80" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <?php  
                    if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'landlord'){
                        echo '<li class="nav-item"><a class="nav-link" href="reservation.php">View Reservation</a></li>';
                        echo '<li class="nav-item"><a class="btn btn-warning" href="php/logout.php">Logout</a></li>';
                    }else if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'user'){
                        echo '<li class="nav-item"><a class="nav-link" href="reservation.php">View Reservation</a></li>';
                        echo '<a class="btn btn-warning" href="index.php">Back</a>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

<section class="container mt-5">
<div class="row">
    <div class="col-md-6">
        <div class="image-box">
            <img src="images/al.jpg" class="img-fluid" alt="Aziannas Place">
        </div>
    </div>
    <div class="col-md-6">
        <div class="text-box">
            <h1>Welcome to Aziannas Place</h1>
            <p>Introducing Aziannas Place: The Epitome of Comfort and Convenience in Maranding, Lala, Lanao del Norte</p>
            <p>Located in the serene town of Maranding, Lala, Lanao del Norte, Aziannas Place stands as the premier boarding house, offering an unparalleled living experience for students and professionals alike.</p>
            <p>At Aziannas Place, we understand the importance of a comfortable and conducive living environment. Our spacious and well-appointed rooms provide a haven for relaxation and productivity. Each room is thoughtfully designed with modern furnishings, ensuring a cozy and inviting atmosphere.</p>
        </div>
    </div>
</div>


    <div class="row mt-5">
        <div class="col">
            <h2>Rooms</h2>
            <?php 
            if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "landlord"){
                echo "<div class='addroom' style='margin-bottom: 20px;'><a href='php/addroom.php'><button class='btn btn-warning'>Add Rooms</button></a></div>"; 
            }
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php 
            $query = "SELECT * FROM rooms";
            $result = mysqli_query($conn, $query);
            while ($fetch = mysqli_fetch_assoc($result)) {
                $id = $fetch['id'];
            ?>
                <div class="col">
                    <div class="card">
                        <div class="card-img-container">
                            <img src="<?php echo $fetch['image']?>" class="card-img-top" alt="Room Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Room No: <?php echo $fetch['room-no']?></h5>
                            <p class="card-text">Price: <?php echo $fetch['price']?></p>
                            <p class="card-text">Amenities: <?php echo $fetch['amenities']?></p>
                            <p class="card-text">Status: <?php echo $fetch['status']?></p>
                            <?php if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "landlord"):
                            ?>
                                <a href='php/addroom.php?rupdate=<?php echo $id;?>' class='btn btn-warning'>Update</a>
                                <a href='php/function.php?rdelete=<?php echo $id;?>' class='btn btn-danger'>Delete</a>
                            <?php  else: ?>
                                <a href='book-in.php?id=<?php echo $id;?>' class='btn btn-warning'>Book Now!</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
    <div class="col">
        <div class="text-box">
            <p>Aziannas Place: Serving Maranding with Excellence for 3 Years</p>
            <p>For the past three years, Aziannas Place has been a trusted and reliable provider of exceptional boarding services in the beautiful town of Maranding, Lala, Lanao del Norte. Since our establishment, we have been committed to delivering an unmatched living experience to our residents.</p>
            <p>Throughout these years, Aziannas Place has become a beloved and integral part of the Maranding community. We have built strong relationships with our residents, creating a warm and welcoming atmosphere that feels like home. Our dedication to customer satisfaction has earned us a stellar reputation as the go-to boarding house in the area.</p>
        </div>
    </div>
</div>
</section>

<!-- Bootstrap JS (optional, for some components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
