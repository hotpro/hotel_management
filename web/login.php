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
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $sql="select * from membership where c_email='$email'";
        $result=mysql_query($sql);
        if($member=mysql_fetch_array($result)){
            $_SESSION['memberemail']=$email;
            header('Location: searchroompoint.php');
        }
        else{
            echo "<p style='color:red'>Invalid email</p>";
        }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>
<h2>Member Log in</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    <fieldset>
         <legend>Input Information</legend>
         <p>
          <label>Email:</label>
          <input type="text" name="email">
          </p>
          <p>
          <label>Password:</label>
          <input type="password" name="password">
          </p>
          <p>
          <input type="submit" value="Submit" />
          </p>
    </fieldset>
</form>

</body>
</html>