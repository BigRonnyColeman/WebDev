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
  echo 'Errno: ' . $mysqli->connect_errno;
  echo '<br>';
  echo 'Error: ' . $mysqli->connect_error;
  exit();
}

//Get values within users table
$user = $_POST['user_email'];
$pass = $_POST['user_password'];

//Checks for corresponding user
$result = $mysqli->query("SELECT * FROM users WHERE 'user_email' = " . $user . " AND 'user_password'=" . md5($password));

if ($result->num_rows) {
//match user
}
else {
//error, incorrect user or password
}