<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'artdealer';

  $artistvalue = $_GET['artist'];
  $artnumber = $_GET['artnumber'];

  $artistint = (int)$artistvalue;
  $artistnumint = (int)$artnumber;
 
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

  $sql = "SELECT artpieceID FROM artpiece WHERE artistID = '$artistint' AND artpieceNumber = '$artistnumint'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo $row["artpieceID"];
    }
  } else {
    echo "<br>NO RESULTS";
  }

  $mysqli->close();
?>