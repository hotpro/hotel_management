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
    session_start();
      
    $_SESSION['serviceid']=$_GET['id'];
?>

<h2>Order a Service</h2>
<form method="post" action="orderserviceconfirmation.php"> 
    <fieldset>
         <legend>Input Information</legend>
          <p>
          <label>Stay ID:</label>
          <input type="text" name="stayid">
          </p>
          <p>
          <label>Service date:</label>
          <input type="date" name="servicedate">
          </p>
          <p>
          <label>Quantity:</label>
          <input type="number" name="quantity" value=1 min=1 max=20>
          </p>
          <p>
          <input type="submit" value="Confirm" />
          </p>
    </fieldset>
</form>

</body>
</html>