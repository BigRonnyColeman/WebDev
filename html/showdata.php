
<!DOCTYPE html>
<html>
<head>
    <link rel ="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.jpeg"/>
    <title>Art Dealer</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
        table {
            border: solid 2px;
            width: 75%;
            text-align: left;
        }

        .first {
            border: solid 2px;
            border-color: black;
            width: 75%;
            text-align: left;
        }

        .second {
            border: dashed 2px;
            border-color: grey;
            width: 75%;
            text-align: left;
        }

        tr, td .first{
            padding: 10px;
            border: dashed 2px;
            border-color: black;
        }

        tr, td .second{
            padding: 10px;
            border: dashed 2px;
            border-color: grey;
        }
    </style>
</head>

<body>
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

        // output data of each row
        while($row = $result1->fetch_assoc()) {
        
        echo 
        "<br><br><br>" . 
            ' <table class="first"> ' . 
            " <tr>
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
            </table> ";
            echo
            ' <table class="second">' . 
                    "<tr>
                        <th>OrderID</th>
                        <th>ArtpieceID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price Per Item</th>
                    </tr> ";

                    $current2 = $row["orderID"];
                    $sql2 = "SELECT artpieceID, quantity FROM orderitem WHERE orderID = '$current2'";
                    $result3 = $mysqli->query($sql2);
                        // output data of each row
                        
                        
                        while($row3 = $result3->fetch_assoc()) {
                            $current4 = $row3["artpieceID"];
                            $sql3 = "SELECT name, price FROM artpiece WHERE artpieceID = '$current4'";
                            $result4 = $mysqli->query($sql3);
                            

                                // output data of each row
                                while($row4 = $result4->fetch_assoc()) {
                                echo 
                                    "
                                    <tr>
                                        <td> " . $row["orderID"] . "</td>
                                        <td> " . $row3["artpieceID"] . "</td>
                                        <td> " . $row4["name"] . "</td>
                                        <td> " . $row3["quantity"] . "</td>
                                        <td> " . $row4["price"] . "</td>
                                    </tr>"; 
                                } 
                                
                        } echo "</table>";
                    
                } 
    ?>
    <?php echo "<br><br><br>";

$sql4 = "SELECT * FROM contact";
$result4 = $mysqli->query($sql4);

// output data of each row
while($row4 = $result4->fetch_assoc()) {
    echo 
    " <table>
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
    </table> <br><br>";

}   ?>
</body>
