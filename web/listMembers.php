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

$sql = "SELECT * FROM membership M JOIN customer C ON M.c_email=C.email";
$result = mysql_query($sql);
echo "<table><tr><th>Member ID</th><th>First name</th><th>Last name</th>
        <th>Points</th><th>Level</th>";
    while($member = mysql_fetch_array($result)){
        echo "<tr><td>".$member["member_id"]."</td><td>".$member["first_name"]."</td><td>"
        .$member["last_name"]."</td><td>".$member["points"]."</td><td>".$member["level"]."</td></tr>";
    }
    echo "</table>";
?>


</body>
</html>