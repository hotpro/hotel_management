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
<h2>Promotions</h2>
<?php
    include 'connection.php';
    //$roomtype="";
    
    $query = "select *  FROM promotion";
    $result = mysql_query($query);
    
    echo "<table><tr><th>Name</th><th>Start date</th><th>End date</th>
        <th>Discount amount</th><th>Extra bonus point</th><th>Required stay duration</th><th>Room type</th>";
    while($promo = mysql_fetch_array($result)){
        $name=$promo["promo_name"];
        echo "<tr><td>".$promo["promo_name"]."</td><td>".$promo["start_date"]."</td><td>"
        .$promo["end_date"]."</td><td>".$promo["discount_amount"]."</td><td>".$promo["extra_bonus_point"].
        "</td><td>".$promo["required_stay_duration"]."</td><td>";
        
        $querya = "SELECT room_type FROM promo_room WHERE promo_name='$name'";
        $resulta = mysql_query($querya);
        if(!empty($resulta)){
        while($roomtype=mysql_fetch_array($resulta)){
            echo $roomtype["room_type"]." "; 
            }
        }
        echo "</td></tr>";
    }
    echo "</table>";
    
   
?>
</body>
</html>