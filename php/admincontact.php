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

    $sql4 = "SELECT * FROM contact";
     $result4 = $mysqli->query($sql4);
            
    // output data of each row
    while($row4 = $result4->fetch_assoc()) {
        echo "<br><br><br>
            <table>
                <tr>
                    <th>ContactID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
                <tr>
                    <td> " . $row4["contactID"] . "</td>
                    <td> " . $row4["first"] . "</td>
                    <td> " . $row4["last"] . "</td>
                    <td> " . $row4["email"] . "</td>
                    <td> " . $row4["message"] . "</td>
                </tr>
            </table> 
        <br><br>";
    }
?>