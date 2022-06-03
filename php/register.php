<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'artdealer');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
// Variables and Initialise EMpty Values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Form Processing
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name

    //Validate Username
    if (empty($_POST["username"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["username"]);
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $username_err = "Invalid email format";
        } else{
            $sql = "SELECT id FROM users WHERE username = :username";
            if($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":username", $param_username,PDO::PARAM_STR);

                // Set Paramters
                $param_username = trim($_POST["username"]);

                if($stmt->execute()) {
                    if($stmt->rowCount() == 1) {
                        $username_err = "An account already exists with this email";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Something Went Wrong. Please Try Again later";
                }
                unset($stmt);
            }
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, type) VALUES (:username, :password,:role)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":role", $param_role, PDO::PARAM_STR);

            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = "user";
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}


