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

$serviceid=$_GET['serviceid'];
$servicedate=$_GET['servicedate'];
$stayid=$_GET['stayid'];

$sql="DELETE FROM service_ordered WHERE service_id=$serviceid AND service_date='$servicedate'
        AND stay_id=$stayid";
if(mysql_query($sql)){
    echo "<h2>Service deleted successfully!</h2>";
}
?>
</body>
</html>