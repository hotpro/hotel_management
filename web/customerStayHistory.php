<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css"
</head>
<body>
<div>
<?php include 'return_to_home.php'?>
</div>
<?php
    include 'connection.php';
    $Cemail="";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cemail = test_input($_POST["Cemail"]);
   }
    
    function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>

<h2>Get stay history</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>User Input</legend>
         <p>
          <label>Email address:</lable>
          <input type="text" name="Cemail">
          </p>
          <p>
          <label>Password:</lable>
          <input type="password" name="password">
          </p>
          <p>
          <input type="submit" name="submit" value="Submit">
          </p>
    </fieldset>
</form>
   
    
    
<?php    
    $query = "select	I.invoice_id, S.check_in_date, S.check_out_date, I.cash_amount, 
            I.credit_card_amount, I.point_amount
            FROM	invoice I, stay S
            WHERE	I.stay_id=S.stay_id AND S.c_email='$Cemail'";
    
    $result = mysql_query($query);
    
    if(!empty($result)){
    echo "<table><tr><th>Invoice ID</th><th>Check-in date</th><th>Check-out date</th><th>Cash amount</th>
        <th>Credit card amount</th><th>Point amount</th>";
    while($stay = mysql_fetch_array($result)){
        $invoiceid=$stay["invoice_id"];
        echo "<tr><td>".$invoiceid."</td><td>".$stay["check_in_date"]."</td><td>"
        .$stay["check_out_date"]."</td><td>".$stay["cash_amount"]."</td><td>"
        .$stay["credit_card_amount"]."</td><td>".$stay["point_amount"]."</td><td>
        <a href='getinvoice.php?invoiceid=$invoiceid'>View invoice</a></td></tr>";
    }
    echo "</table>";
    }
?>
</body>
</html>