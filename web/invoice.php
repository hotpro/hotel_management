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
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stayid = $_SESSION['stayid'];
        $cash = test_input($_POST["cash"]);
        $credit = test_input($_POST["credit"]);
        
        $sql="select point_amount, address, check_in_date, check_out_date, bonus_point, S.c_email, first_name, last_name
            from    stay S, customer C
            where   S.c_email=C.email and stay_id=$stayid";
            
        $result=mysql_query($sql);
        $stay=mysql_fetch_array($result);
        
        $point=$stay["point_amount"];
        $address=$stay["address"];
        $checkin=$stay["check_in_date"];
        $checkout=$stay["check_out_date"];
        $bonus=$stay["bonus_point"];
        $email=$stay["c_email"];
        $firstname=$stay["first_name"];
        $lastname=$stay["last_name"];
        
        $addinvoice="INSERT INTO invoice(point_amount, cash_amount, credit_card_amount, mailing_address,
        invoice_date, stay_id)
        VALUES ($point, $cash, $credit, '$address', '$checkout', $stayid)";
        
        if(mysql_query($addinvoice)){
            $invoiceid=mysql_insert_id();
            $member="UPDATE membership SET points=points+$bonus-$point WHERE c_email='email'";
            if($memberresult=mysql_query($member)){
                echo "<h2>Check out successfully</h2>";
                echo "<h1>Invoice</h1>";
                echo "<p>Date: ".$checkout."</p>";
                echo "<p>Invoice#: ".$invoiceid."</p>";
                echo "<p>Stay ID: ".$stayid."</p>";
                echo "<p>Name: ".$lastname." ".$firstname."</p>";
                echo "<p>Email: ".$email."</p>";
                echo "<p>Address: ".$address."</p>";
                echo "<p>Check-in date: ".$checkin."</p>";
                echo "<p>Check-out date: ".$checkout."</p>";
                echo "<p>Room amount: $".$_SESSION['roomprice']."</p>";
                echo "<p>Points amount: ".$point."</p>";
                echo "<p>Bonus points: ".$bonus."</p>";
                echo "Services ordered: ";
                
                $servicesql="select * FROM service natural join service_ordered WHERE stay_id=$stayid";
                $resultservice = mysql_query($servicesql);
                echo "<table><tr><th>Service name</th><th>Date</th><th>Quantity</th><th>Unit price</th>"; 
                while($service = mysql_fetch_array($resultservice)){
                    echo "<tr><td>".$service["service_name"]."</td><td>".$service["service_date"]."</td><td>"
                    .$service["quantity"]."</td><td>".$service["price"]."</td></tr>";
                }
                echo "</table>";
                echo "<p>Total price: $".$_SESSION['totalprice']."</p>";
                echo "<p>Cash payment: $".$cash."</p>";
                echo "<p>Credit card payment: $".$credit."</p>";
            }
        }
        else{
            echo "<br>Error to add invoice".$addinvoice.mysql_error($conn);
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

</body>
</html>