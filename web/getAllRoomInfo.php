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
<h2>Guest rooms</h2>
<?php
    include 'connection.php';

    $query = "select R.room_id, RP.cash_rate, RP.point_rate, R.max_capacity, G.room_level
                FROM room R, guest_room G, room_price RP
                WHERE R.room_id=G.room_id AND R.type=RP.room_type AND R.max_capacity=RP.max_capacity";

    $result = mysql_query($query);

    echo "<table><tr><th>Room ID</th><th>Cash_rate</th><th>Point_rate</th>
        <th>Max_capacity</th><th>Level</th>";
    while($room = mysql_fetch_array($result)){
        echo "<tr><td>".$room["room_id"]."</td><td>".$room["cash_rate"]."</td><td>"
        .$room["point_rate"]."</td><td>".$room["max_capacity"]."</td><td>".$room["room_level"]."</td></tr>";
    }
    echo "</table>";
?>

<br><h2>Ballrooms</h2>
<?php

    $query = "select * from room, ballroom WHERE room.room_id=ballroom.room_id";
    $query = "select 	R.room_id, RP.cash_rate, RP.point_rate, R.max_capacity
              FROM 	room R, room_price RP, ballroom B
              WHERE 	B.room_id=R.room_id AND R.type=RP.room_type AND R.max_capacity=RP.max_capacity;";

    $result = mysql_query($query);

    echo "<table><tr><th>Room ID</th><th>Cash_rate</th><th>Point_rate</th>
        <th>Max_capacity</th>";
    while($room = mysql_fetch_array($result)){
        echo "<tr><td>".$room["room_id"]."</td><td>".$room["cash_rate"]."</td><td>"
        .$room["point_rate"]."</td><td>".$room["max_capacity"]."</td></tr>";
    }
    echo "</table>";
?>
</body>
</html>
