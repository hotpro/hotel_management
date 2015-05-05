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
$invoiceid=$_GET["invoiceid"];
$sql = "SELECT I.invoice_id, S.stay_id, C.last_name, C.first_name, C.email, C.address, 
                S.check_in_date, S.check_out_date, I.point_amount, S.bonus_point, I.cash_amount,
                I.credit_card_amount, S.money_amount
        FROM invoice I, stay S, customer C
        WHERE I.invoice_id=$invoiceid AND I.stay_id=S.stay_id AND S.c_email=C.email";
$result = mysql_query($sql);
if($invoice = mysql_fetch_array($result)){
    echo "<h1>Invoice</h1>";
    echo "<p>Date: ".$invoice["check_out_date"]."</p>";
    echo "<p>Invoice#: ".$invoice["invoice_id"]."</p>";
    echo "<p>Stay ID: ".$invoice["stay_id"]."</p>";
    echo "<p>Name: ".$invoice["first_name"]." ".$invoice["last_name"]."</p>";
    echo "<p>Email: ".$invoice["email"]."</p>";
    echo "<p>Address: ".$invoice["address"]."</p>";
    echo "<p>Check-in date: ".$invoice["check_in_date"]."</p>";
    echo "<p>Check-out date: ".$invoice["check_out_date"]."</p>";
    echo "<p>Room amount: $".$invoice["money_amount"]."</p>";
    echo "<p>Points amount: ".$invoice["point_amount"]."</p>";
    echo "<p>Bonus points: ".$invoice["bonus_point"]."</p>";
    echo "Services ordered: ";
    $stayid=$invoice["stay_id"];
    $servicesql="select * FROM service NATURAL JOIN service_ordered WHERE stay_id=$stayid";
        $resultservice = mysql_query($servicesql);
        echo "<table><tr><th>Service name</th><th>Date</th><th>Quantity</th><th>Unit price</th>"; 
        while($service = mysql_fetch_array($resultservice)){
            echo "<tr><td>".$service["service_name"]."</td><td>".$service["service_date"]."</td><td>"
                .$service["quantity"]."</td><td>".$service["price"]."</td></tr>";
        }
        echo "</table>";
        $totalprice=$invoice["cash_amount"]+$invoice["credit_card_amount"];
        echo "<p>Total price: $".$totalprice."</p>";
        echo "<p>Cash payment: $".$invoice["cash_amount"]."</p>";
        echo "<p>Credit card payment: $".$invoice["credit_card_amount"]."</p>";
        
}
?>
</body>
</html>