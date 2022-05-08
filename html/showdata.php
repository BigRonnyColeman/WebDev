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

  $sql = "SELECT * FROM customerorder";
  $result1 = $mysqli->query($sql);

  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
       echo 
        " <table>
        <tr>
            <th>Name</th>
            <th>Mode</th>
            <th>Address</th>
            <th>Number</th>
            <th>TimeStamp</th>
        </tr>
        <tr>
            <td> " . $row["name"] . "</td>
            <td> " . $row["mode"] . "</td>
            <td> " . $row["address"] . "</td>
            <td> " . $row["number"] . "</td>
            <td> " . $row["date"] . "</td>
        </tr>
        <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
        </tr>
        </table> ";

                $current2 = $row["orderID"];
                $sql = "SELECT (artpieceID, quantity) FROM orderitem WHERE orderID = $current2";
                $result3 = $mysqli->query($sql);

                if ($result3->num_rows > 0) {
                    // output data of each row
                    while($row3 = $result3->fetch_assoc()) {

                        $current4 = $row3["artpieceID"];
                        $sql = "SELECT (name, price) FROM artpiece WHERE artpieceID = $current4";
                        $result4 = $mysqli->query($sql);

                        if ($result3->num_rows > 0) {
                            // output data of each row
                            while($row4 = $result4->fetch_assoc()) {
                            echo 
                                " <table>
                                <tr>
                                    <th>OrderID</th>
                                    <th>ArtpieceID</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price Per Item</th>
                                </tr>
                                <tr>
                                    <td> " . $row["orderID"] . "</td>
                                    <td> " . $row3["artpieceID"] . "</td>
                                    <td> " . $row4["name"] . "</td>
                                    <td> " . $row3["quanitity"] . "</td>
                                    <td> " . $row4["price"] . "</td>
                                </tr>
                                </table> ";
                            }
                        }
                    }
                }
            }
  }
  
  
  else {
    echo "<br>NO RESULTS";
  }

?>