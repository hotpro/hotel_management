<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
<link rel="stylesheet" href="css/table.css"

</head>
<body>
<?php 
include 'connection.php';
include 'return_to_home.php';
?>
<h2>Register for Membership</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>Input Information</legend>
          <p>
          <label>Email:</label>
          <input type="text" name="email">
          </p>
          <p>
          <label>First name:</label>
          <input type="text" name="firstname">
          </p>
          <p>
          <label>Last name:</label>
          <input type="text" name="lastname">
          </p>
          <p>
          <label>Company name:</label>
          <input type="text" name="compname">
          </p>
          <p>
          <label>Address:</label>
          <input type="text" name="address">
          </p>
          <p>
          <label>Phone number:</label>
          <input type="text" name="phone">
          </p>
          <p>
          <input type="submit" value="Confirm" />
          </p>
    </fieldset>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $compname = test_input($_POST["compname"]);
    $address = test_input($_POST["address"]);
    $phone = test_input($_POST["phone"]);
    
    $check = "SELECT * FROM membership M, customer C WHERE M.c_email=C.email AND C.email='$email'";
    $checkresult = mysql_query($check);
    if (mysql_fetch_array($checkresult)) {
        echo "<p style='color:red'>This email is already registered.</p>";
    } else {
        $check2 = "SELECT * FROM customer WHERE email='$email'";
        $result2 = mysql_query($check2);
        if(mysql_num_rows($result2) <> 0){
            $customer = "UPDATE customer SET first_name='$firstname', last_name='$lastname', 
            company_name='$compname', address='$address', phone_no='$phone'  WHERE email='$email'";
        }
        else{
            $customer = "INSERT INTO customer  VALUES ('$email', '$firstname', '$lastname', '$compname',
        '$address', '$phone')";
        }
        $addmember= "INSERT INTO membership(points, level, c_email) VALUES(0, 1, '$email')";
        if(mysql_query($customer) && mysql_query($addmember)){
            $memberid=mysql_insert_id();
            echo "<p style='color:red'>Member added successfully. Your membership number is ".
            $memberid."</p>";
        }
        else{
            echo "<p style='color:red'>Error to add member</p>".mysql_error($conn);
        }
    }
}
    
     function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>

</body>
</html>