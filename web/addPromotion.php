<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Management</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
<div>
<?php include 'return_to_home.php'?>
</div>
<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'hotel';

    // Create connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $startdate = test_input($_POST["startdate"]);
    $enddate = test_input($_POST["enddate"]);
    $discount = $_POST["discount"];
    $pointbonus = $_POST["pointbonus"];
    $duration = $_POST["duration"];
    
    $sql = "INSERT INTO promotion (promo_name, start_date, end_date, discount_amount, extra_bonus_point, required_stay_duration)
    VALUES ('$name', '$startdate','$enddate', $discount, $pointbonus, $duration)";
    
    $exec = mysqli_query($conn, $sql); 
     
    if(isset($_POST["type"])){
        $type=$_POST["type"];
        $sql_1="INSERT INTO promo_room VALUES ('$type', '$name')";
        $exec = mysqli_query($conn, $sql_1); 
    }
    if(isset($_POST["type1"])){
        $type1=$_POST["type1"];
        $sql_2="INSERT INTO promo_room VALUES ('$type1', '$name')";
        $exec = mysqli_query($conn, $sql_2); 
    }
    
    if (mysqli_query($conn, $sql)) {
     echo "New record created successfully";
    } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    
    function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }

?>

<h2>Add a Promotion</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>Input Values</legend>
         <p>
          <label>Promotion name:</label>
          <input type="text" name="name">
          </p>
          <p>
          <label>Start date:</label>
          <input type="text" name="startdate">
          </p>
          <p>
          <label>End date:</label>
          <input type="text" name="enddate">
          </p>
          <p>
          <label>Discount rate:</label>
          <input type="text" name="discount">
          </p>
          <p>
          <label>Extra bonus point: </label>
          <input type="text" name="pointbonus">
          </p>
          <p>
          <label>Required stay duration: </label>
          <input type="text" name="duration">
          </p>
          <p>
          <label>Room type: </label>
          <input type="checkbox" name="type" value="Standard"> Standard
          <input type="checkbox" name="type1" value="Ballroom"> Ballroom
          </p>
          <p>
          <input type="submit" value="Submit" />
          </p>
    </fieldset>
</form>
   
    


</body>
</html>