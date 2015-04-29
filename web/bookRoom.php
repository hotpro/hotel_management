<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<div>
<?php include 'return_to_home.php';
      include 'connection.php';
      session_start();
?>
</div>
<h2>Book Room</h2>
<?php
$_SESSION['roomnumber'] = $_GET['room'];
$_SESSION['price']=$_GET['price'];
echo "Room#: ".$_SESSION['roomnumber']."<br>Check-in date: ".$_SESSION['checkin']."<br>Check-out date: ".$_SESSION['checkout'].
"<br>Total price: $".$_SESSION['price']."<br>Promotion: ".$_SESSION['promo']."<br>Bonus points: ".$_SESSION['bonus_point'];
?>
<br><br>

<form method="post" action="bookConfirmation.php"> 
    <fieldset>
         <legend>Input Information</legend>
         <p>
          <label>Email:</label>
          <input type="text" name="email">
          </p>
          <p>
          <label>First name:</label>
          <input type="text" name="firstname">
          </p>
          <p>
          <label>Last name:</label>
          <input type="text" name="lastname">
          </p>
          <p>
          <label>Company name:</label>
          <input type="text" name="companyname">
          </p>
          <p>
          <label>Address:</label>
          <input type="text" name="address">
          </p>
          <p>
          <label>Phone#:</label>
          <input type="text" name="phone">
          </p>
          <p>
          <input type="submit" value="Confirm" />
          </p>
    </fieldset>
</form>

</body>
</html>