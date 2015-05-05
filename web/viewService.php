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
echo "- <a href='listReservations.php'>Back</a>";

$stayid = $_GET['stayid'];
$sql="SELECT * FROM service_ordered NATURAL JOIN service WHERE stay_id=$stayid";
$result=mysql_query($sql);
if(mysql_num_rows($result) == 0){
    echo "<p>No service ordered for this stay yet.</p>";
}
else{
    echo "<table><tr><th>Name</th><th>Date</th><th>Quantity</th><th>Unit price</th>";
    while($service=mysql_fetch_array($result)){
        $serviceid=$service["service_id"];
        $servicedate=$service["service_date"];
        echo "<tr><td>".$service["service_name"]."</td><td>".$servicedate."</td><td>".
        $service["quantity"]."</td><td>".$service["price"].
        "</td><td><a href='deleteservice.php?serviceid=$serviceid&servicedate=$servicedate&stayid=$stayid'>Cancel</a></td></tr>";
    }
}
?>


</body>
</html>