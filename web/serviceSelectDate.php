<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<?php 
include 'connection.php';
include 'return_to_home.php';
session_start();
?>

<h2>Select Date and Room</h2>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>Input Information</legend>
         <p>
          <label>Date:</label>
          <input type="date" name="date">
          </p>
          <p>
          <label>Quantity:</label>
          <input type="number" name="quantity" value=1 min="1" max="10">
          </p>
          <p>
          <input type="submit" value="Submit" />
          </p>
    </fieldset>
</form>

<?php
echo "<br>service id: ".$_SESSION['serviceid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = test_input($_POST["date"]);
    $quantity = test_input($_POST["quantity"]);
    
    $sql="select * from stay where check_in_date<='$date' and check_out_date>='$date'";
    $result=mysql_query($sql);
    echo "<table><tr><th>Room#</th><th>Stay ID</th><th>Check-in Date</th><th>Check-out date</th>";
    while($stay=mysql_fetch_array($result)){
        $stayid=$stay["stay_id"];
        echo "<tr><td>".$stay['room_id']."</td><td>".$stayid."</td><td>"
        .$stay['check_in_date']."</td><td>".$stay['check_out_date'].
        "</td><td><a href='orderservice.php?stayid=$stayid&date=$date&quantity=$quantity'>ORDER</a></td></tr>";
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>
</body>
</html>