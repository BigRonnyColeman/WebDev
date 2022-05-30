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
    require_once("../php/dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            /* Insert's Message from user to contact database */
            case "contact":
                require_once("../php/dbinsertcontact.php");
            break;
            /* Add's artpiece to cart, designated through URL Parameter set using the form on artpiece.php */
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
            /* Removes particular item from cart, designated by particular artpiece ID linked to the x clicked on by user */
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
            /* Unset the array variable "cart_item". As this is the array that stores all elements of the
            shopping cart, all items are essentially deleted from the session */
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
        <link rel="icon" href="../images/icon.jpeg"/>
        <title>Contact Us</title>
        <meta name="description" content="Art Dealer Contact Us">
        <style>
        /*General Page Styling*/

            header{
                background-color:black;
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
        </style>
    </head>
    <body>
        <!-- Navigation Header -->
        <div id="navbar">
            <header>
            <!-- Navigation Bar Items -->
                <img class ="logo" src ="../images/logoWhite.jpeg" alt = "logo">
                <nav>
                    <ul class = "navLinks">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="artists.php">ARTISTS</a></li>
                        <li><a href="best.php">BEST SELLERS</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="#"><u style="text-underline-offset: 0.7em";>CONTACT US</u></a></li>
                    </ul>
                </nav>
                <!--Cart-->
                <!-- Uses global variabl $_Session and stores all relevant data to 
                each session in the array $_Session["cart_item"] -->
                <button class="openbtn" onclick="openNav()"> <img src="../images/cart.jpeg" style="width:3.2vw; height:3vw; cursor: pointer;"/></button>  
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="font-family: Arial, Helvetica, sans-serif; font-size:3vw">x</a>
                    <h2 style="color:rgb(230, 230, 230); padding-bottom:1vw;">CART</h2>
                    <hr style="border-color: rgb(158, 158, 158);"></hr><br>
                    <?php
                        if(isset($_SESSION["cart_item"])){
                            $total_quantity = 0;
                            $total_price = 0;
                    ?>	
                    <table class="tbl-cart" cellspacing="7vw">
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
                                <td style="text-align:center; "><a href="index.php?action=remove&code=<?php echo $item["artpieceID"]; ?>" class="btnRemoveAction" style="font-family: Arial, Helvetica, sans-serif; width:1vw; colour:white;"><img src="../images/delete.jpeg" height="9vw"/></a></td>
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
                    <div style="padding-top:5vw;">
                        <button class ="checkoutbtn"><a href="checkout.php">Checkout</a></button> 
                    </div> 
                    <a id="btnEmpty" href="index.php?action=empty" style = "font-size:1vw;"><u>Empty Cart</u></a>		
                    <?php
                        } else {
                    ?>
                    <div class="no-records"><h2 style="font-size:2vw; white-space: nowrap; color:grey;">Your Cart is Empty</h2></div>
                    <?php 
                        }
                    ?>
                </div>
            </header>
        </div>

        <h2 style = "padding-top:4vw;">Past Orders</h2>
        <div class="centerpage">
        <div class="section">
            <?php include('../php/showdatainsert.php');?>

            <br>
            <div class="indexboxlink" style="padding:1vw;">
                <a class = "indexbtnStyle" href="../html/account.php">Back to My Account</a>
            </div>
            <br>
            <!-- Sends _POST varaiables to php on index, action=contact --> 
            <form action="index.php?action=contact" method="post" >
                <label for="delete">Delete Account</label>
                <input type="text" id="pass" name="pass" placeholder="Confirm Password to Proceed">

                <input type="submit" id = "myBtn" value="Delete Account">
            </form>
        </div>
        </div>
        <hr></hr>
        <!-- Footer -->
        <footer style ="text-align:center;font-size:1vw; padding:3vw;">
            <div class="row2" style="padding-bottom: 3vw;">
                <div class="column2">
                    <div class =infoGroup>
                        <img src="../images/infoImage.webp" style= "width:100%; opacity: 75%;"/>
                        <div class="infoText"><h2 style="font-size:2.8vw">Premium Quality</h2><br><p>Printed using water-based inks and professional 12-colour giclée printers, giving it colour vibrancy that’s protected for 80+ years.</p></div>
                    </div>
                </div>
                <div class="column2">
                    <div class =infoGroup>
                        <img src="../images/infoImage2.webp" style= "width:100%; opacity: 75%;"/>
                        <div class="infoText"> <h2>We're Local</h2><br><p>Run and born out of Canbera, we launched our premium giclee art print line to promote and sell local talent to the nations capital.</p></div>
                    </div>
                </div>
                <div class="column2">
                    <div class =infoGroup>
                        <img src="../images/infoImage3.webp" style= "width:100%; opacity: 75%;"/>
                        <div class="infoText"><h2>Quick Delivery</h2><br><p>Fast & reliable delivery through our own employees.</p></div>
                    </div>
                </div>
            </div>
            <p style="opacity: 50%;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</p>
        </footer> 
        <!-- Javascript -->
        <script src ="../js/responsiveHeader.js"></script>  
    </body>
</html>