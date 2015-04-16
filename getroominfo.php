<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Room Info</title>
</head>
<body>
  <h1>Room Information</h1>
  <p>
    <?php>
      class Room
      {
          private room_id;
          private cash_rate;
          private point_rate;
          private max_capacity;
          private type;

          public function getRoomId()       { return $this->room_id; }
          public function getCashRate()     { return $this->cash_rate; }
          public function getPointRate()    { return $this->point_rate; }
          public function getMaxCapacity()  { return $this->max_capacity; }
          public function getType()         { return $this->type; }
      }

      function createTableRow(Person $room)
      {
          print "        <tr>\n";
          print "            <td>" . $room->getRoomId()       . "</td>\n";
          print "            <td>" . $room->getCashRate()     . "</td>\n";
          print "            <td>" . $room->getPointRate()    . "</td>\n";
          print "            <td>" . $room->getMaxCapacity()  . "</td>\n";
          print "            <td>" . $room->getType()         . "</td>\n";
          print "        </tr>\n";
      }

      $roomid = filter_input(INPUT_GET, "roomid");
      try {
        // connect to database
        $con = new PDO("mysql:host=localhost;dbname=hotel",
                        "team6", "team6");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $query = "SELECT * FROM room";

        // Fetch the matching database table rows.
        $data = $con->query($query);        
        $data->setFetchMode(PDO::FETCH_CLASS, "Room");

        // We're going to construct an HTML table.
        print "    <table border='1'>\n";

        // Fetch the database field names.
        $result = $con->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // Constrain the query if we got first and last names.
        if (strlen($roomid) > 0) {
            $query = "SELECT * FROM room ".
                 "WHERE room_id = :roomid";
            $ps = $con->prepare($query);
            $ps->bindParam(':roomid', $roomid);
        }
        else {
            $ps = $con->prepare($query);
        }

        // Fetch the matching database table rows.
        $ps->execute();
        $ps->setFetchMode(PDO::FETCH_CLASS, "Room");
        
        // Construct the HTML table row by row.
        while ($person = $ps->fetch()) {
            print "        <tr>\n";
            createTableRow($person);
            print "        </tr>\n";
        }
        
        print "    </table>\n";
      } catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
      }
    <?>
  </P
</body>
</html>
