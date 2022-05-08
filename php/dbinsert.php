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

	$name = $_GET['name'];
	$mode = $_GET['mode'];
	$address = $_GET['address'];
	$email = $_GET['email'];
	$timestamp = date("Y-m-d H:i:s");

	$sql = "INSERT INTO customerorder (name, mode, address, number, date) VALUES ($name, $mode, $address,$email,$timestamp)";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$sql2 = "SELECT orderID FROM customerorder WHERE name = $_GET['name'] AND date = $timestamp";
  	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$r = $row["orderID"];
			foreach ($_SESSION["cart_item"] as $item){
				$sql = "INSERT INTO orderitem (orderID,artpieceID) VALUES ($r,$item)";
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
					} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}

		}

	}

	$conn->close();

?>