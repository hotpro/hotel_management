<?php 
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startdate = date_create(test_input($_POST["startdate"]));
    $enddate = date_create(test_input($_POST["enddate"]));
    $duration = date_diff($startdate,$enddate)->days + 1;
    
    $totalRoomsql="SELECT count(*) as total  FROM room";
    $result=mysql_query($totalRoomsql);
    $totalRooms=floatval(mysql_fetch_array($result)['total']);
    
    
    echo "<p>Start date: ".$startdate->format('Y-m-d').", End date: ".$enddate->format('Y-m-d').
        ", Duration: ".$duration." days.</p>";
    echo "<p>Total number of rooms: ".$totalRooms."</p>";
    $totalrate=0;
    echo "<table><tr><th>Date</th><th>Occupation rate</th><th>Occupied number</th>";
    
    while($startdate <= $enddate){
        $date = $startdate->format('Y-m-d');
        $occupiedsql="select	count(room_id) as occupied
                        from		stay
                        where		check_in_date<='$date' and check_out_date>'$date'";
        $resultdate=mysql_query($occupiedsql);
        $occupied=floatval(mysql_fetch_array($resultdate)['occupied']);
        
        $rate=number_format($occupied/$totalRooms, 2, '.', '');
        $totalrate=$totalrate+$rate;
        echo "<tr><td>".$date."</td><td>".$rate."</td><td>".$occupied."</td></tr>";
        date_add($startdate,date_interval_create_from_date_string('1 day'));
    }
    $averagerate=$totalrate/$duration;
    echo "<p>Average occupation rate = ".number_format($averagerate, 2, '.', '')."</p>";
}
    
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>