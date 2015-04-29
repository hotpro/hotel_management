<?php
include 'connection.php';
session_start();

$points=$_GET['points'];
$roomnumber=$_GET['room'];
$email=$_SESSION['memberemail'];
$sql="SELECT * FROM membership WHERE c_email='$email'";
$result=mysql_query($sql);
        if($member=mysql_fetch_array($result)){
            $totalpoints=$member["points"];
            if($totalpoints<$points){
                echo "<p style='color:red'>Not enough points </p>".$totalpoints." ".$points;
                echo "<p><a href=searchroompoint.php>Search again</p>";
                echo "<p><a href=index.html>Home</p>";
            }
            else{
                $_SESSION['pointroomnumber']=$roomnumber;
                $_SESSION['points']=$points;
                echo "roomnumber:".$roomnumber."<br>points: ".$points;
                header('Location: bookroompoint.php');
            }
        }
        else{
            echo "Error<br>".mysql_error($sql);
        }

?>
