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
    $Cemail="";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cemail = test_input($_POST["Cemail"]);
   }
    
    function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>

<h2>Get stay history</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>User Input</legend>
         <p>
          <label>Email address:</lable>
          <input type="text" name="Cemail">
          </p>
          <p>
          <input type="submit" name="submit" value="Submit">
          </p>
    </fieldset>
</form>
   
    
    
<?php    
    $query = "select	*
            FROM	stay S
            WHERE	c_email='$Cemail'";
    
    $result = mysql_query($query);
    
    if(!empty($result)){
    echo "<table><tr><th>Email</th><th>reservation#</th><th>Room#</th><th>Check-in date</th>
        <th>Check-out date</th><th>Money amount</th><th>Point amount</th><th>Bonus point
        </th><th>Promotion</th>";
    while($stay = mysql_fetch_array($result)){
        echo "<tr><td>".$stay["c_email"]."</td><td>".$stay["reserve_no"]."</td><td>"
        .$stay["room_id"]."</td><td>".$stay["check_in_date"]."</td><td>"
        .$stay["check_out_date"]."</td><td>".$stay["money_amount"]."</td><td>".$stay["point_amount"].
        "</td><td>".$stay["bonus_point"]."</td><td>".$stay["promo_name"]."</td></tr>";
    }
    echo "</table>";
    }
?>
</body>
</html>