<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<h2>Payment</h2>
<?php
    include 'connection.php';
    session_start();
    $stayid=$_GET['stayid'];
    $_SESSION["stayid"]=$stayid;
      
    $sql="select money_amount from stay where stay_id=$stayid";
    $result=mysql_query($sql);
    $room=mysql_fetch_array($result);
    $roomprice=$room["money_amount"];
    
    $serviceprice=0;  
    $servicesql="select	price, quantity
                from	(stay natural join service) natural join service_ordered
                where	stay_id=$stayid";
    $serviceresult=mysql_query($servicesql);
    while($price=mysql_fetch_array($serviceresult)){
        $serviceprice=$serviceprice+($price["price"]*$price["quantity"]);
    }
    
    $totalprice=$roomprice+$serviceprice;
    $_SESSION['totalprice']=$totalprice;
    $_SESSION['roomprice']=$roomprice;

echo "<br><br>Total money price: $".$totalprice;
?>

<br><br>
<form method="post" action="invoice.php"> 
          <p>
          <label>Cash amount:</label>
          <input type="text" name="cash" value='0'>
          </p>
          <p>
          <label>Credit card amount:</label>
          <input type="text" name="credit" value='0'>
          </p>
          <p>
          <input type="submit" value="Confirm" />
          </p>
    </fieldset>
</form>

</body>
</html>