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
    $room = test_input($_POST["room#"]);
    $cash_rate = test_input($_POST["cash_rate"]);
    $point_rate = test_input($_POST["point_rate"]);
    $max_capacity = test_input($_POST["max_capacity"]);
    $type = test_input($_POST["type"]);
   }
    
    function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>

<h2>Add a room</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>Input Values</legend>
         <p>
          <label>Room number:</label>
          <input type="text" name="room#">
          </p>
          <p>
          <label>Cash rate:</label>
          <input type="text" name="cash_rate">
          </p>
          <p>
          <label>Point rate:</label>
          <input type="text" name="point_rate">
          </p>
          <p>
          <label>Max capacity:</label>
          <input type="text" name="max_capacity">
          </p>
          <p>
          <label>Type:</label>
          <input type="radio" name="type" value="standard">Standard
          <input type="radio" name="type" value="ballroom">Ballroom
          </p>
          <p>
          <input type="submit" name="submit" value="Submit">
          </p>
    </fieldset>
</form>
   
    


</body>
</html>