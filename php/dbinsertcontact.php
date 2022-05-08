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

	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$message = $_POST["message"];
	$timestamp = date("Y-m-d H:i:s");

	$sql = "INSERT INTO contact (contactID, first, last, email, message) VALUES ('$timestamp','$fname', '$lname', '$email','$message')";

	if ($conn->query($sql) === TRUE) {
	}  
	$conn->close();

?>