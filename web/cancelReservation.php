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
    $stayid = $_GET["stayid"];
    $sql = "DELETE FROM stay WHERE stay_id='$stayid'";
    if (mysql_query($sql)) {
        echo "<h2 style='color:red'>Reservation ".$stayid." cancelled successfully</h2>";
    } else {
        echo "Error deleting record: " . mysql_error($conn);
    }
?>
</body>
</html>