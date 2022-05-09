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

  $sql = "SELECT artistID, artpieceNumber FROM artpiece WHERE artpieceID IN (3,5, 21,32,41,17, 13, 8)";
  $result = $mysqli->query($sql);
  $array = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $temp = $row["artistID"];
      $temp2 = $row["artpieceNumber"];
      $sql2 = "SELECT name FROM artist WHERE artistID = '$temp'";
      $result2 = $mysqli->query($sql2);
      if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
          $temp3 = $row2["name"];
        }
      $array2 = array("x" => "$temp","y" => "$temp2","z" => "$temp3");
      array_push($array,$array2);
    }
  }
}

  
  $mysqli->close();
?>