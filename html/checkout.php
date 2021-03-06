<?php
    session_start();
    require_once("../php/dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM artpiece WHERE artpieceID='" . $_GET["artpieceID"] . "'");
                    $itemArray = array($productByCode[0]["artpieceID"]=>array('artpieceID'=>$productByCode[0]["artpieceID"], 'name'=>$productByCode[0]["name"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["artpieceID"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["artpieceID"] == $_SESSION["cart_item"][$k]["artpieceID"]) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $_SESSION["cart_item"][$k]["artpieceID"]) {
                            if($_SESSION["cart_item"][$k]["quantity"] == 1) {
                                unset($_SESSION["cart_item"][$k]);
                            }
                            else if ($_SESSION["cart_item"][$k]["quantity"] > 1) {
                                $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"] - 1;
                            }
                        }
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);				
                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
            break;	
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" href="../css/siteStyling.css">
        <link rel="icon" href="../images/icon.png"/>
        <title>Checkout</title>
        <meta name="description" content="Art Dealer Home page">
        <style>
        /*General Page Styling*/
            *{
                box-sizing: border-box;
                margin:0;
                padding:0;
            }

            .section {
                padding: 3vw;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                margin: 5vw;
                background-color:rgba(255, 255, 255, 0.5);
                width:40vw;
            }

            body {font-family: Arial, Helvetica, sans-serif;}
                * {box-sizing: border-box;}

            input[type=text], select, textarea {
                width: 100%;
                padding: 1vw;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 3vw;
                resize: vertical;
            }

            input[type=month], select, textarea {
                width: 100%;
                padding: 1vw;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 3vw;
                resize: vertical;
            }

            input[type=submit] {
                background-color: rgb(68, 68, 68);
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                opacity:0.8;
            }

            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 7vw;
            }

            /* Split the screen in half */
            .split {
                height: 100%;
                width: 50%;
                position: fixed;
                z-index: 1;
                top: 0;
                overflow-x: hidden;
            }

            /* Control the left side */
            .left {
                left: 0;
            }

            /* Control the right side */
            .right {
                right: 0;
                background-color:hsl(21, 12%, 72%);
            }

            /* If you want the content centered horizontally and vertically */
            .centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }

            .tbl-cart td{
                color: rgb(68, 68, 68);
                text-align:center;
                font-family: Arial;
                margin: 0;
                font-size:1.5vw;
            }
        </style>
    </head>
    <body>
        <div class="split left">
            <header style="padding-top:6vw"><img class ="logo" style = "height:3vw; margin-left:auto; margin-right:auto; display: block;" src ="../images/logoBlack.jpeg" alt = "logo"></header>
            <div class="section">
                <form style="text-align: left;">
                    <label for="contact">Contact Information</label>
                    <div style="display:flex;">
                        <input type="text" id="shipping" name="fname" placeholder="First Name.." style="font-size:1vw;">
                        <input type="text" id="shipping" name="lname" placeholder="Last Name.." style="font-size:1vw;">
                    </div>
                    <input type="text" id="contact" name="email" placeholder="Email.." style="font-size:1vw;">
                    <input type="text" id="contact" name="number" placeholder="Mobile Phone Number.." style="font-size:1vw;">

                    <select id="shipping" name="mode" style="font-size:1vw;">
                            <option value="delivery">Delivery</option>
                            <option value="pickup">Pickup</option>
                    </select>
                    <label for="shipping">Address</label>

                    <input type="text" id="shipping" name="address" placeholder="Address.." style="font-size:1vw;">
                    <div style="display:flex;">
                        <select id="shipping" name="State" style="font-size:1vw;">
                            <option value="ACT">ACT</option>
                            <option value="NSW">NSW</option>
                            <option value="VIC">VIC</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="SA">SA</option>
                            <option value="WA">WA</option>
                        </select>
                        <input type="text" id="shipping" name="suburb" placeholder="Suburb.." style="font-size:1vw;">
                        <input type="text" id="shipping" name="postcode" placeholder="Postcode.." style="font-size:1vw;">
                    </div>

                    <label for="card">Payment Information</label>
                    <input type="text" id="cardname" name="cardname" placeholder="Name on Card.." style="font-size:1vw;">
                    <input type="text" id="cardnumber" name="cardnumber" placeholder="Card Number.." style="font-size:1vw;" maxlength="16">
                    <div style="display:flex;">
                        <input type="month" id="expdate" name="expdate" placeholder="Expiry Date.." style="font-size:1vw;">
                        <input type="text" id="shipping" name="suburb" placeholder="CVV.." style="font-size:1vw;" maxlength="3">
                    </div>
                    <input type="submit" id ="myBtn" value="Submit" style="font-size:1vw;">
                    <a href = "artists.php" style="color:black; font-size:1vw; text-decoration: underline; padding-left:1vw;">Return to Artists...</a>
                </form>
            </div>

            <div class="split right">
                <div class="centered">
                    <div class="section" style="text-align:center">
                        <h2 style="padding-top:1vw;">CART</h2>
                        <?php
                            if(isset($_SESSION["cart_item"])){
                                $total_quantity = 0;
                                $total_price = 0;
                        ?>	
                        <table class="tbl-cart" cellspacing="7vw" style="padding-bottom:3vw">
                            <tbody>
                                <tr>
                                    <th style="text-align:left; padding = 1%" name="Name"></th>
                                    <th style="text-align:right; width = 0.8%" name = "Quantity"></th>
                                    <th style="text-align:right; width = 0.8%" name = "Price"></th>
                                    <th style="text-align:right; width = 0.2%" name = "Remove"></th>
                                </tr>	
                                <?php		
                                    foreach ($_SESSION["cart_item"] as $item){
                                        $item_price = $item["quantity"]*$item["price"];
                                ?>
                                <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                    <td style="text-align:right; "><?php echo "$ ". number_format($item_price,2); ?></td>
                                    <td style="text-align:center; "><a href="checkout.php?action=remove&code=<?php echo $item["artpieceID"]; ?>" class="btnRemoveAction" style="font-family: Arial, Helvetica, sans-serif; width:1vw; colour:white;"><img src="../images/delete.jpeg" height="9vw"/></a></td>
                                </tr>
                                    <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["price"]*$item["quantity"]);
                                        }
                                    ?>
                                <tr>
                                    <td align="center" span="2">Total:</td>
                                    <td align="right"><?php echo $total_quantity; ?></td>
                                    <td align="right"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php 
                            }
                        ?>
                        <?php
                            if (isset($_GET["fname"])) {
                                echo
                                " <h2>Address</h2>" . 
                                "<p>" . $_GET["fname"] . " " . $_GET["lname"] . "<br>"
                                . $_GET["email"] . "<br>"
                                . $_GET["number"] . "<br>"
                                . $_GET["address"] . " " . $_GET["suburb"] . " " . $_GET["State"] . " " . $_GET["postcode"] . "<br>";
                            }
                            else {
                                echo "<p> <b>Please Complete Customer Form</b> </p>";
                            }
                        ?>
                        <br>
                        <?php
                            if (isset($_GET["fname"])) {
                        ?> 
                        <form action="checkoutcomplete.php?action=checkout&name= <?php  echo $_GET["fname"] . " " . $_GET["lname"] . "&mode=" . $_GET["mode"] . "&email=" . $_GET["email"] . "&number=" . $_GET["number"] . "&address=" . $_GET["address"] . " " . $_GET["suburb"] . " " . $_GET["State"] . " " . $_GET["postcode"] ?>" method="post" style="text-align:center;"> 
                            <input type="submit" value="Checkout" style="font-size:1vw;"/>
                        </form>  
                        <?php
                            }      
                        ?>
                    </div>
                    <br>
                    <footer style ="text-align:center; opacity:50%; font-size:1vw;display:block;">?? 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>
                </div>
            </div>
        </div>        
    </body>
</html>
