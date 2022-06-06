<?php
session_start();

unset($_SESSION["loggedin"]);
unset($_SESSION["id"]);
unset($_SESSION["username"]);
$_SESSION["type"] = "public";

header("location: index.php");
exit;
?>
