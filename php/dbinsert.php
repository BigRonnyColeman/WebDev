<?php
session_start();
$host = "localhost";
$user = "root";
$password = "root";
$database = "artdealer";

// Create connection
$conn = @new mysqli($servername, $user, $password, $database);
// Check connection

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO customerorder (name, mode, address, number, date, userID) VALUES (?, ?, ?, ?, ?,?)");
$stmt->bind_param("sssiss", $name, $mode, $address, $number, $timestamp, $username);

echo $name . $mode;
$name = $_POST['name'];
$mode = $_POST['mode'];
$address = $_POST['address'];
$number = $_POST['number'];
$timestamp = date("Y-m-d H:i:s");
$username = $_SESSION["username"];
$stmt -> execute();

$stmt->close();

$r = "";
//prepared statement for selection from customerorder 
$stmt2 = "SELECT orderID FROM customerorder WHERE name = '$name' AND date = '$timestamp'";

$result = $conn->query($stmt2);
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$r = $row["orderID"];
			foreach($_SESSION["cart_item"] as $k => $v){
				echo "<br><br>";
				$quantity = $_SESSION["cart_item"][$k]["quantity"];
				$currentItem = $_SESSION["cart_item"][$k]["artpieceID"];
				$currentTime = date("Y-m-d H:i:s");
				$stmt3 = $conn->prepare("INSERT INTO orderItem (orderItemID,orderID,artpieceID,quantity) VALUES (?, ?, ?, ?)");
				$stmt3->bind_param("diii", $currentTime, $r, $currentItem, $quantity);
				$stmt3->execute();

				$stmt4 = $conn->prepare("UPDATE artpiece SET stock = stock - ? WHERE artpieceID = ?");
				$stmt4->bind_param("ii", $quantity, $currentItem);
				$stmt4->execute();
			}
		}

$conn->close();

?>