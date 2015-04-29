<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<?php 
    include 'return_to_home.php';
    include 'connection.php';
    echo " - <a href='listService.php'>Back</a><br><br>";
    session_start();
    
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stayid = test_input($_POST["stayid"]);
        $date = test_input($_POST["servicedate"]);
        $quantity = test_input($_POST["quantity"]);
        $serviceid=$_SESSION['serviceid'];
        
        $sql="INSERT INTO service_ordered(service_id, stay_id, service_date, quantity)
        VALUES ($serviceid, $stayid, '$date', $quantity)";
        if (mysql_query($sql)) {
            echo "<h2>Service added to stay ".$stayid."</h2>";
        }
        else{
            echo "<br>Error: ".$sql.mysql_error($conn);
        }
    }
        
        function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
   session_unset(); 
?>