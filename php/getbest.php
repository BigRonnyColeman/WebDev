<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'artdealer';

 
  $mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  $sql = "SELECT artpieceID, COUNT(artpieceID) FROM orderItem GROUP BY artpieceID ORDER BY COUNT(artpieceID) DESC LIMIT 8";
  $result = $mysqli->query($sql);
  $array = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $temp = $row["artpieceID"];
      $sql2 = "SELECT artistID,artpieceNumber FROM artpiece WHERE artpieceID = '$temp'";
      $result2 = $mysqli->query($sql2);
      if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
          $tempnum = $row2["artpieceNumber"];
          $tempart = $row2["artistID"];
        }
        $array2 = array("x" => "$tempart","y" => "$tempnum");
        array_push($array,$array2);
      } 
    }
  }

  for ($i = count($array); $i < 8;$i+=1) {
    array_push($array,array("x" => "3","y" => "1"));
  }
  
  $mysqli->close();
?>