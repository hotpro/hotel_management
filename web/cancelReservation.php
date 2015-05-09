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
    echo " - <a href='customerReservation.php'>Back</a>";
    $stayid = $_GET["stayid"];

    $getstay = "SELECT * FROM stay WHERE stay_id='$stayid'";
    $resultGetStay = mysql_query($getstay);
    if($stayItem = mysql_fetch_array($resultGetStay)){
        $points = $stayItem["point_amount"];
        $email = $stayItem["c_email"];
    }

    // begin transaction
    mysql_query("BEGIN");

    $member="UPDATE membership SET points=points + $points WHERE c_email='$email'";
    $updateMember = mysql_query($member);

    $sql = "DELETE FROM stay WHERE stay_id='$stayid'";
    $resultsql = mysql_query($sql);

    if ($updateMember and $resultsql) {
        mysql_query("COMMIT");
        echo "<h2 style='color:red'>Reservation ".$stayid." cancelled successfully</h2>";
    } else {
        mysql_query("ROLLBACK");

        if (!$updateMember) {
            echo "Error update member point: " . $updateMember.mysql_error($conn);
        } else if (!$resultsql) {
            echo "Error deleting record: " . $resultsql.mysql_error($conn);
        }
    }

    // if (mysql_query($sql)) {
    //     echo "<h2 style='color:red'>Reservation ".$stayid." cancelled successfully</h2>";
    // } else {
    //     echo "Error deleting record: " . mysql_error($conn);
    // }
?>
</body>
</html>