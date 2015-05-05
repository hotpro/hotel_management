<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
<link rel="stylesheet" href="css/table.css"

</head>
<body>

<div>
<?php include 'return_to_home.php';?>
</div>
<h2>List All Reservations</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Input stay ID to cancel a reservation:<br>
<input type="text" name="deletename">
<input type="submit" value="Submit" />
</form>

<?php
    include 'connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stay_id = test_input($_POST["deletename"]);
        $sql = "DELETE FROM stay WHERE stay_id='$stay_id'";
        //$exec = mysql_query($sql); 
        if (mysql_query($sql)) {
            echo "<p style='color:red'>Reservation canceled successfully</p>";
        } else {
            echo "Error deleting record: " . mysql_error($conn);
        }
    }
    
     function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
    
    $query = "select *  from	stay
                where  stay_id not in (select stay_id from  invoice)";
    $result = mysql_query($query);
    
    echo "<table><tr><th>Stay ID</th><th>Room#</th><th>Check-in date</th><th>Check-out date</th>
        <th>Point amount</th><th>Money amount</th><th>Bonus point</th><th>Email</th><th>Promotion</th>";
    while($stay = mysql_fetch_array($result)){
        $stayid=$stay['stay_id'];
        $name=$stay["promo_name"];
        echo "<tr><td>".$stayid."</td><td>".$stay["room_id"]."</td><td>".$stay["check_in_date"]."</td><td>"
        .$stay["check_out_date"]."</td><td>".$stay["point_amount"]."</td><td>".$stay["money_amount"].
        "</td><td>".$stay["bonus_point"]."</td><td>".$stay["c_email"]."</td><td>".$stay["promo_name"].
        "</td><td><a href='viewService.php?stayid=$stayid'>View services</a></td>
        <td><a href='checkout.php?stayid=$stayid'>Check out</a></td></tr>";
    }
    echo "</table>";
    
   
?>
</body>
</html>