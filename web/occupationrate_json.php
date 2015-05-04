<?php 
include 'connection.php';

// $ar = array('apple', 'orange', 'banana', 'strawberry');
// echo json_encode($ar); // ["apple","orange","banana","strawberry"]

$startdate = date_create(test_input($_POST["startdate"]));
$enddate = date_create(test_input($_POST["enddate"]));
$duration = date_diff($startdate,$enddate)->days + 1;

$totalRoomsql="SELECT count(*) as total  FROM room";
$result=mysql_query($totalRoomsql);
$totalRooms=floatval(mysql_fetch_array($result)['total']);

$totalrate=0;
$json = array();
while($startdate <= $enddate){
    $date = $startdate->format('Y-m-d');
    $occupiedsql="select	count(room_id) as occupied
                    from		stay
                    where		check_in_date<='$date' and check_out_date>'$date'";
    $resultdate=mysql_query($occupiedsql);
    $occupied=floatval(mysql_fetch_array($resultdate)['occupied']);
    
    $rate=number_format($occupied/$totalRooms, 2, '.', '');
    $totalrate=$totalrate+$rate;
    // echo " ".$date." ".$rate." ".$occupied." ";
    $item = array();
    $item[] = $date;
    $item[] = $occupied;
    $json[] = $item;
    date_add($startdate,date_interval_create_from_date_string('1 day'));
}
$averagerate=$totalrate/$duration;
// echo "<p>Average occupation rate = ".number_format($averagerate, 2, '.', '')."</p>";

echo json_encode($json); 

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>