<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css"
</head>
<body>
<div>
<?php include 'return_to_home.php'?>
</div>
<?php
    include 'connection.php';
    $roomID="";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomID = test_input($_POST["roomID"]);
   }
    
    function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>

<h2>Check room schedule</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>User Input</legend>
         <p>
          <label>Room number:</lable>
          <input type="text" name="roomID">
          </p>
          <p>
          <input type="submit" name="submit" value="Submit">
          </p>
    </fieldset>
</form>
   
    
    
<?php    
    $query = "select	R.room_id, S.stay_id, S.check_in_date, S.check_out_date
            FROM	room R, stay S
            WHERE	R.room_id = S.room_id AND R.room_id=$roomID";
    
    $result = mysql_query($query);
    
    if(!empty($result)){
    echo "<table><tr><th>Room_ID</th><th>Stay_ID</th><th>Check-in date</th>
        <th>Check-out date</th>";
    while($room = mysql_fetch_array($result)){
        echo "<tr><td>".$room["room_id"]."</td><td>".$room["stay_id"]."</td><td>"
        .$room["check_in_date"]."</td><td>".$room["check_out_date"]."</td></tr>";
    }
    echo "</table>";
    }
?>
</body>
</html>