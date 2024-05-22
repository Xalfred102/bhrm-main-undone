
<?php 
require 'connection.php';

if(isset($_POST['submit'])){
  $room = $_POST['room'];
  $resname = $_POST['resname'];
  $resemail = $_POST['resemail'];
  $resphone = $_POST['resphone'];
  $gendermale = $_POST['gendermale'];
  $genderfemale = $_POST['genderfemale'];
  $quantitymale = $_POST['quantitymale'];
  $quantityfemale = $_POST['quantityfemale'];
  $datein = $_POST['datein'];
  $dateout = $_POST['dateout'];
  $comment = $_POST['comment'];

  $query = "INSERT INTO `reservation`(`id`, `reservationid`, `resroom`, `resname`, `resemail`, `resphone`, `resgendermale`, `resgenderfemale`, `quantitymale`, `quantityfemale`, `datein`, `dateout`, `comment`) VALUES ('','000','$room','$resname','$resemail','$resphone','$gendermale','$quantitymale','$genderfemale','$quantityfemale','$datein','$dateout','$comment')";
  mysqli_query($conn, $query);
  echo "<script> alert('Succesfully added the reservation. wait for 2 hours 
  a reservation ticket will be sent to your email, thank you for booking in.')</script>";
  
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
    <form class="booking-form" action="" method="post">
      <div class="elem-group">
        <label for="room-selection">Select Room</label>
        <select id="room-selection" name="room" required placeholder="select here">
            <option value="familyroom">Family Room</option>
            <option value="deluxroom">Delux Room</option>
            <option value="singleroom">Single Room</option>
        </select>
      </div>
        <div class="elem-group">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="resname" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
        </div>
        <div class="elem-group">
          <label for="email">Your E-mail</label>
          <input type="email" id="email" name="resemail" placeholder="john.doe@email.com" required>
        </div>
        <div class="elem-group">
          <label for="phone">Your Phone</label>
          <input type="tel" id="phone" name="resphone" placeholder="498-348-3872" required>
        </div>
        <hr>
        <div class="elem-group inlined">
          <label for="adult">Male</label>
          <input type="number" id="adult" name="gendermale" placeholder="2" min="1" required>
        </div>
        <div class="elem-group inlined">
          <label for="child">How Many?</label>
          <input type="number" id="child" name="quantitymale" placeholder="2" min="0" required>
        </div>
        <div class="elem-group inlined">
          <label for="adult">Female</label>
          <input type="number" id="adult" name="genderfemale" placeholder="2" min="1" required>
        </div>
        <div class="elem-group inlined">
          <label for="child">How many?</label>
          <input type="number" id="child" name="quantityfemale" placeholder="2" min="0" required>
        </div>
        <div class="elem-group inlined">
          <label for="checkin-date">Check-in Date</label>
          <input type="date" id="checkin-date" name="datein" required>
        </div>
        <div class="elem-group inlined">
          <label for="checkout-date">Check-out Date</label>
          <input type="date" id="checkout-date" name="dateout" required>
        </div>

        <hr>
        <div class="elem-group">
          <label for="message">Anything Else?</label>
          <textarea id="message" name="comment" placeholder="Tell us anything else that might be important." required></textarea>
        </div>
        <button type="submit" name="submit">Submit</button>
      </form>

      <style>
        .booking-form {
        width: 500px;
        margin: 0 auto;
        padding: 30px;
        background: #fff;
        border: solid 1px gray;
        }

        div.elem-group {
        margin: 20px 0;
        }

        div.elem-group.inlined {
        width: 49%;
        display: inline-block;
        float: left;
        margin-left: 1%;
        }

        label {
        display: block;
        font-family: 'Nanum Gothic';
        padding-bottom: 10px;
        font-size: 1.25em;
        }

        input, select, textarea {
        border-radius: 2px;
        border: 2px solid #777;
        box-sizing: border-box;
        font-size: 1.25em;
        font-family: 'Nanum Gothic';
        width: 100%;
        padding: 10px;
        }

        div.elem-group.inlined input {
        width: 95%;
        display: inline-block;
        }

        textarea {
        height: 250px;
        }

        hr {
        border: 1px dotted #ccc;
        }

        button {
        height: 50px;
        background: orange;
        border: none;
        color: white;
        font-size: 1.25em;
        font-family: 'Nanum Gothic';
        border-radius: 4px;
        cursor: pointer;
        padding: 0 12px;
        }

        button:hover {
        background: #333;
        }
      </style>
</body>
</html>