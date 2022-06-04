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

$emailErr = "";


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST" and (strlen($_POST['first'])<1 or strlen($_POST['last'])<1 or strlen($_POST['email'])<1 or strlen($_POST['message'])<1)) {
	$emailErr = "All Field Must be Completed";
}
// Form Processing
else if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['first']) and isset($_POST['last']) and isset($_POST['email']) and isset($_POST['message'])) {
    $first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$timestamp = date("Y-m-d H:i:s");

    //Validate Username
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if(empty(trim($_POST["email"]))){
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
			$sql = $conn->prepare("INSERT INTO contact (contactID, first, last, email, message) VALUES (?, ?, ?, ?, ?)");
			$sql->bind_param("sssss", $timestamp, $first, $last, $email, $message);
			$sql->execute();
			header("location: ../html/index.php");

			/* close */
			$conn->close();
		}
	}
}

?>