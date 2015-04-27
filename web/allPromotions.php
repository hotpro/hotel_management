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
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Input promotion name to delete:<br>
<input type="text" name="deletename">
<input type="submit" value="Submit" />
</form>

<?php
    include 'connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $deletename = test_input($_POST["deletename"]);
        $sql = "DELETE FROM promotion WHERE promo_name='$deletename'";
        //$exec = mysql_query($sql); 
        if (mysql_query($sql)) {
            echo "Record deleted successfully";
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