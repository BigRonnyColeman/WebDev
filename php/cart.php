<!-- The PHP at the top of each page is used to add, remove or empty cart, as well as submit
messages from the user to the database. The first URL paramter that dictates which part
of th switch is activated is 'action'. Once the switch case is run, and the relevant data
has been maniupalted, the rest of the page can load. -->
<?php
/* creates a session or resumes the current one based on a session identifier 
    passed via a GET or POST request, or passed via a cookie. When session_start() 
    is called or when a session auto starts, PHP will call the open and read session
    save handlers. */

session_start();
$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

$currentTime = time();

if($currentTime > $_SESSION['expire']) {
session_unset();
session_destroy();
header('location:index.php');
}

require_once("../php/dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
            /* Insert's Message from user to contact database */
        case "contact":
            require_once("../php/dbinsertcontact.php");
            break;
            /* Add's artpiece to cart, designated through URL Parameter set using the form on artpiece.php */
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM artpiece WHERE artpieceID='" . $_GET["artpieceID"] . "'");
                $itemArray = array($productByCode[0]["artpieceID"] => array('artpieceID' => $productByCode[0]["artpieceID"], 'name' => $productByCode[0]["name"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"]));
                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["artpieceID"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["artpieceID"] == $_SESSION["cart_item"][$k]["artpieceID"]) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
            /* Removes particular item from cart, designated by particular artpiece ID linked to the x clicked on by user */
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $_SESSION["cart_item"][$k]["artpieceID"]) {
                        if ($_SESSION["cart_item"][$k]["quantity"] == 1) {
                            unset($_SESSION["cart_item"][$k]);
                        } else if ($_SESSION["cart_item"][$k]["quantity"] > 1) {
                            $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"] - 1;
                        }
                    }
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
            /* Unset the array variable "cart_item". As this is the array that stores all elements of the
            shopping cart, all items are essentially deleted from the session */
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>