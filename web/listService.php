<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<?php
include 'connection.php';
include 'return_to_home.php';
?>
<h2>Order a Service</h2>
<?php
    $query="select	*   from	service";
    
    $result = mysql_query($query);
    
    echo "<table><tr><th>ID</th><th>Name</th><th>Price</th>";
    while($service = mysql_fetch_array($result)){
        $id=$service["service_id"];
        $name=$service["service_name"];
        $price=$service["price"];
        echo "<tr><td>".$service["service_id"]."</td><td>".$service["service_name"]."</td><td>"
        .$service["price"]."</td><td><a href='orderservice.php?id=$id'>Book</a></td></tr>";
    }
    echo "</table>";
        
?>

</body>
</html>