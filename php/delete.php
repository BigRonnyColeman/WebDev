<?php
// Initialize the session
 
session_start();
 
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'artdealer');

$db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'artdealer';
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
 
// Define variables and initialize with empty values
$password = "";
$password_err = "";
$login_err = "";
unset($_SESSION["login_err"]);
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["pass"])) {
 
    // Check input errors before updating the database
    if(empty(trim($_POST["pass"]))){
        $_SESSION["login_err"] = "Please enter your password.";
        header("location: ../html/account.php");
        exit;
    } else{
        $password = trim($_POST["pass"]);
    }

    if(empty($password_err)){
        // Prepare a select statement
        $temp = $_SESSION["username"];
        $sql = "SELECT password FROM users WHERE username = '$temp'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct
                            // Prepare a select statement
                            $sql = "DELETE FROM users WHERE username = :username";
                            
                            if($stmt = $pdo->prepare($sql)){
                                // Bind variables to the prepared statement as parameters
                                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                                // Set parameters
                                $param_username = trim($_SESSION["username"]);
                                
                                // Attempt to execute the prepared statement
                                $stmt->execute();
                                header("location: ../html/logout.php");                    
                            }
                        }
                        else {
                                // Password is not valid, display a generic error message
                                $_SESSION["login_err"] = "invalid password";
                                header("location: ../html/account.php");
                        }
            }} 
            else {
                    echo "Oops! Something went wrong. Please try again later.";
            }
                // Close statement
                unset($stmt);
            }
        }
        // Close connection
        unset($pdo);
?>