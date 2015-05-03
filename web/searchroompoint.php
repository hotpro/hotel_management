<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<?php
include 'connection.php';
session_start();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
     <fieldset>
         <legend>User Input</legend>
         <p>
          <label>Check-in date:</label>
          <input type="date" name="date">
          </p>
          <p>
          <label>Nights of stay:</label>
          <input type="number" name="duration" min="1" max="15">
          </p>
          <label>Promotion:</label>
          <input type="text" name="promotion">
          <p>
          <input type="submit" value="Submit" />
          </p>
    </fieldset>
    <br>
</form>

<?php
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkindate = date_create($_POST["date"]);
    $checkoutdate = date_create($_POST["date"]);
    $nights=$_POST["duration"];
    $duration = (string)$_POST["duration"]." days";
    date_add($checkoutdate,date_interval_create_from_date_string($duration));
     
    $checkin=$checkindate->format('Y-m-d');
    $checkout=$checkoutdate->format('Y-m-d');
    $promo=test_input($_POST["promotion"]);
    $discount=0;
    $bonus_point=0;
    
    $promosql="select	distinct promo_name, discount_amount, extra_bonus_point
    from	promotion natural join (promo_room natural join guest_room)
    where	start_date<='$checkin' and required_stay_duration<=$nights and promo_name='$promo'";
    
    $resulta = mysql_query($promosql);
    if($promoname=mysql_fetch_array($resulta)){
        $discount=$promoname["discount_amount"];
        $bonus_point=$promoname["extra_bonus_point"];
        }
    else{
        echo "No available promotion<br>";
        $promo=null;
    }
    
    $query="select	G.room_id, G.room_level, RP.cash_rate, RP.point_rate, R.max_capacity
            from		guest_room G, room R, room_price RP
            where		G.room_id=R.room_id and R.type=RP.room_type 
                        AND R.max_capacity=RP.max_capacity and G.room_id not in
		                (select	room_id
                        from	stay
                        where	check_out_date>'$checkin' and check_in_date<'$checkout')";
    
    $result = mysql_query($query);
    
    echo "Check-in date: ".$checkin.", Nights: ".$_POST["duration"].
    "<br>Promotion: ".$promo.", Discount: ".$discount.", Bonus point: ".$bonus_point;
    $_SESSION['checkin']=$checkin;
    $_SESSION['checkout']=$checkout;
    $_SESSION['bonus_point']=$bonus_point;
    $_SESSION['promo']=$promo; 
    
    echo "<table><tr><th>Room#</th><th>Room level</th><th>Point rate</th><th>Max_capacity</th><th></th>";
    while($room = mysql_fetch_array($result)){
        $roomnumber=$room["room_id"];
        $points=$room["point_rate"]*$nights;
        echo "<tr><td>".$room["room_id"]."</td><td>".$room["room_level"]."</td><td>".
        $points."</td><td>".$room["max_capacity"].
        "</td><td><a href='checkpoint.php?room=$roomnumber&points=$points'>Book</a></td></tr>";
    }
    echo "</table>";
}
        
?>

</body>
</html>