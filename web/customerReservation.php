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
?>

<h2>View/cancel reservation</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>User Input</legend>
         <p>
          <label>Email address:</lable>
          <input type="text" name="Cemail">
          </p>
          <p>
          <label>Password:</lable>
          <input type="password" name="password">
          </p>
          <p>
          <input type="submit" name="submit" value="Submit">
          </p>
    </fieldset>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["Cemail"]); 
    $query = "select *  from	stay
        where  c_email='$email' AND stay_id not in (select stay_id from  invoice)";
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 0){
        echo "<p style='color:red'>No reservations found.</p>";
    }
    else{
    
        echo "<table><tr><th>Stay ID</th><th>Room#</th><th>Check-in date</th><th>Check-out date</th>
        <th>Point amount</th><th>Money amount</th><th>Bonus point</th><th>Email</th><th>Promotion</th>";
        while($stay = mysql_fetch_array($result)){
            $stayid=$stay['stay_id'];
            $name=$stay["promo_name"];
            echo "<tr><td>".$stayid."</td><td>".$stay["room_id"]."</td><td>".$stay["check_in_date"]."</td><td>"
        .$stay["check_out_date"]."</td><td>".$stay["point_amount"]."</td><td>".$stay["money_amount"].
        "</td><td>".$stay["bonus_point"]."</td><td>".$stay["c_email"]."</td><td>".$stay["promo_name"].
        "</td><td><a href='cancelReservation.php?stayid=$stayid'>Cancel</a></td></tr>";
    }
    echo "</table>";
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