<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'artdealer';

  $search = $_POST['search'];
 
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

  $sql = "SELECT * FROM artpiece WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
  $result = $mysqli->query($sql);

  $array = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      array_push($array,$row["name"]);
    }
  }

  $mysqli->close();
?>