<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $db = 'hotel';

    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($db);
?>
