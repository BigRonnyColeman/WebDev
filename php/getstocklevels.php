<?php
require_once ("../php/cart.php");

  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'artdealer';

  $artistvalue = $_GET['artist'];
  $artnumber = $_GET['artnumber'];
  $cartquantity = 0;
  if (isset($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
      if($item["artpieceID"] == $artnumber){
        $cartquantity = $cartquantity - $item["quantity"];
      }
    }
  }

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

  $sql = "SELECT stock FROM artpiece WHERE artistID = '$artistint' AND artpieceNumber = '$artistnumint'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo ($row["stock"]+$cartquantity);
    }
  } else {
    echo "<br>NO RESULTS";
  }

  $mysqli->close();
?>