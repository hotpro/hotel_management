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
        
        $datesql = "SELECT check_in_date, check_out_date
                    FROM stay WHERE stay_id=$stayid";
        $result = mysql_query($datesql);
        if(mysql_num_rows($result) == 0){
            echo "<h2>Invalid stayid!</h2>";
        }
        else{
            $stay = mysql_fetch_array($result);
            if($date<$stay["check_in_date"] || $date>$stay["check_out_date"]){
                echo "<h2>Please input valid date!</h3>";
                echo "<p>Stay ID: ".$stayid.", Check-in date: ".$stay["check_in_date"].", Check-out date: "
                .$stay["check_out_date"]."</p>";
            }
            else{
                $sql="INSERT INTO service_ordered(service_id, stay_id, service_date, quantity)
                VALUES ($serviceid, $stayid, '$date', $quantity)";
                if (mysql_query($sql)) {
                    echo "<h2>Service added to stay ".$stayid."</h2>";
                }
                else{
                    echo "<br>Error: ".$sql.mysql_error($conn);
                }
            }
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