<?php
/* Inserts each item in $_SESSION["cart_item"] and add calls
    INSERT INTO Query for each. Then empty session cart is succession purchase */
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "checkout":
            require_once("../php/dbinsert.php");
            unset($_SESSION["cart_item"]);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.png" />
    <title>Checkout</title>
    <meta name="description" content="Art Dealer Check Out Complete Page">
</head>

<body>
    <p> Thank you <?php include('../php/getpurchasename.php') ?> for Your Purchase </p>
    <div style="padding-top:5vw; text-align:center">
        <button class="btnStyle"><a href="index.php" style="color:black">HOME</a></button>
    </div>
    <br><br><br>
    <footer style="text-align:center; opacity:50%; font-size:1vw;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>
</body>

</html>