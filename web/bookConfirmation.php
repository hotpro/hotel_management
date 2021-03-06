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

$stayid="";

$roomid=$_SESSION['roomnumber'];
$checkin=$_SESSION['checkin'];
$checkout=$_SESSION['checkout'];
$price=$_SESSION['price'];
$promo=$_SESSION['promo'];
$bonus_point=$_SESSION['bonus_point'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $companyname = test_input($_POST["companyname"]);
    $address = test_input($_POST["address"]);
    $phone = test_input($_POST["phone"]);
    
    $query = "SELECT *    FROM customer   WHERE email='$email'";
    $result = mysql_query($query);
    //if the customer already exists, update the information
    if($cemail = mysql_fetch_array($result))
    {
        $customersql="UPDATE customer SET first_name='$firstname', last_name='$lastname', 
        company_name='$companyname', address='$address', phone_no='$phone'  WHERE email='$email'";
    }
    //if the customer does not exist, add it to table
    else
    {
        $customersql="INSERT INTO customer  VALUES ('$email', '$firstname', '$lastname', '$companyname',
        '$address', '$phone')";
    }
    
    //if successfully add/update the customer information
    if(mysql_query($customersql)){
        //add stay
        if($promo===null){
            $addstay="INSERT INTO stay(check_in_date, check_out_date, point_amount, money_amount,
                bonus_point, c_email, room_id) 
            VALUES ('$checkin','$checkout',0,$price,$bonus_point,'$email', $roomid)";
        }
        else{
            $addstay="INSERT INTO stay(check_in_date, check_out_date, point_amount, money_amount,
                bonus_point, c_email, room_id, promo_name) 
            VALUES ('$checkin','$checkout',0,$price,$bonus_point,'$email', $roomid, '$promo')";
        }
        //if successfully add the stay
        if($resultaddstay=mysql_query($addstay)){
            //get the stay_id of the stay just added
            $stayid=mysql_insert_id();
                    echo "<h1>Thank you! Your stay ID is ".$stayid."</h1>";
                    echo "<p>Room#: ".$roomid."</p>";
                    echo "<p>Check-in date: ".$checkin."</p>";
                    echo "<p>Check-out date: ".$checkout."</p>";
                    echo "<p>Total price: $".$price."</p>";
                    echo "<p>Promotion name: ".$promo."</p>";
                    echo "<p>Bonus points: ".$bonus_point."</p>";
                    echo "<p>Name: ".$firstname." ".$lastname."</p>";
                    echo "<p>Email: ".$email."</p>";
        }
        else{
            echo "<br>Error to add stay ".mysql_error($conn);
        }
    }
    else{
        echo "<br>Error to add/update customer ".mysql_error($conn);
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