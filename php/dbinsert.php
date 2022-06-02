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

$name = $_GET['name'];
$mode = $_GET['mode'];
$address = $_GET['address'];
$number = $_GET['number'];
$timestamp = date("Y-m-d H:i:s");

$sql = $conn->prepare("INSERT INTO customerorder (name, mode, address, number, date) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("sisid", $name, $mode, $address, $number, $timestamp);
$sql->execute();

if ($conn->query($sql) === TRUE) {
}
else {
}

//prepared statement for selection from customerorder 
$sql2 = $conn->prepare("SELECT orderID FROM customerorder WHERE name = ? AND date = ?");
$sql2->bind_param("sd", $name, $timestamp);
$sql2->execute();

$result = $conn->query($sql2);
// output data of each row
while ($row = $result->fetch_assoc()) {
	$r = $row["orderID"];
	foreach ($_SESSION["cart_item"] as $k => $v) {
		echo "<br><br>";
		$quantity = $_SESSION["cart_item"][$k]["quantity"];
		$currentItem = $_SESSION["cart_item"][$k]["artpieceID"];
		$currentTime = date("Y-m-d H:i:s");
		$sql3 = $conn->prepare("INSERT INTO orderItem (orderItemID,orderID,artpieceID,quantity) VALUES (?, ?, ?, ?)");
		$sql3->bind_param("diii", $currentTime, $r, $currentItem, $quantity);
		$sql3->execute();

		if ($conn->query($sql3) === TRUE) {
		}
		else {
		}
	}
}

$conn->close();

?>