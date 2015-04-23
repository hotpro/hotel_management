<?php
  require '../db/connect.php';
  $query = mysql_query(
  SELECT 'room_id'
  FROM 'room'
  );
