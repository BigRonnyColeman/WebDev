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

	$sql = "INSERT INTO customerorder (name, mode, address, number, date) VALUES ('$name', '$mode', '$address','$number','$timestamp')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully 1";
	  } else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	  } 

	$sql2 = "SELECT orderID FROM customerorder WHERE name = '$name' AND date = '$timestamp'";
  	
	$result = $conn->query($sql2);
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$r = $row["orderID"];
			foreach($_SESSION["cart_item"] as $k => $v){
				echo "<br><br>";
				$quantity = $_SESSION["cart_item"][$k]["quantity"];
				$currentItem = $_SESSION["cart_item"][$k]["artpieceID"];
				$currenttime = date("Y-m-d H:i:s") + rand();
				echo $currenttime . " , " . $currentItem . " , " . $quantity . "<br>";
				$sql3 = "INSERT INTO orderItem (orderItemID,orderID,artpieceID,quantity) VALUES ('$currenttime','$r','$currentItem','$quantity')";
				if ($conn->query($sql3) === TRUE) {
					echo "New record created successfully 2";
				} 
				else {
					echo "Error: " . "second" . "<br>" . $conn->error;
				}
			}
		}
		
	


	$conn->close();

?>