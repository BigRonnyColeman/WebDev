<?php

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

$first = $_GET['first'];
$last = $_GET['last'];
$email = $_GET['email'];
$message = $_GET['message'];
$timestamp = date("Y-m-d H:i:s");


$sql = $conn->prepare("INSERT INTO contact (contactID, first, last, email, message) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("dssss", $timestamp, $first, $last, $email, $message);
$sql->execute();

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
}
else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
/* close */
$conn->close();

?>