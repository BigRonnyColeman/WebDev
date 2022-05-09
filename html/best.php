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

<!--USE THIS PAGE FOR REFERENCE TO BUILD OTHER PAGES-->

<head>
    <link rel ="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.jpeg"/>
    <title>Best Sellers</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
        header{
            background-color:black;
        }
    </style>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const artistvalue = urlParams.get('artist');
        const artistint = parseInt(artistvalue);
        console.log(artistvalue);
    </script>

</head>
<body>

    <!-- Header -->
    <div id="navbar">
        <header>
            <img class ="logo" src ="../images/logoWhite.jpeg" alt = "logo">
            <nav>
                <ul class = "navLinks">
                    <li><a href="index.php">HOME</u></a></li>
                    <li><a href="artists.php">ARTISTS</a></li>
                    <li><a href="best.php"><u style="text-underline-offset: 0.7em";>BEST SELLERS</u></a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                </ul>
            </nav>
            <!--Cart-->
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
                            <td style="text-align:center; "><a href="best.php?action=remove&code=<?php echo $item["artpieceID"]; ?>" class="btnRemoveAction" style="font-family: Arial, Helvetica, sans-serif; width:1vw; colour:white;"><img src="../images/delete.jpeg" height="9vw"/></a></td>
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
                </div>
        </header>
    </div>
    <hr></hr>

    
    </div>
    <hr></hr>
    <h2 style = "padding-top:4vw;">SHOP BEST SELLERS</h2>
    <div class="section">
    <?php include('../php/getbest.php');?>
    <div class="row">
        <div class="column">
            <?php
            for ($k = 0 ; $k < 2; $k++) {
                echo
                ' <a href="artpiece.php?artist=' . $array[$k]["x"] . '&artnumber=' . $array[$k]["y"] . '">
                    <div class =artistGroup>
                        <img src="../images/artist' . $array[$k]["x"] . '/artist' . $array[$k]["x"] . '_' . $array[$k]["y"] . '.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    </div> 
                </a> ';
            }
            ?>
        </div>
        <div class="column">
            <?php
            for ($k = 2 ; $k < 4; $k++) {
                echo
                ' <a href="artpiece.php?artist=' . $array[$k]["x"] . '&artnumber=' . $array[$k]["y"] . '">
                    <div class =artistGroup>
                        <img src="../images/artist' . $array[$k]["x"] . '/artist' . $array[$k]["x"] . '_' . $array[$k]["y"] . '.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    </div> 
                </a> ';
            }
            ?>
        </div>
        <div class="column">
            <?php
            for ($k = 4 ; $k < 6; $k++) {
                echo
                ' <a href="artpiece.php?artist=' . $array[$k]["x"] . '&artnumber=' . $array[$k]["y"] . '">
                    <div class =artistGroup>
                        <img src="../images/artist' . $array[$k]["x"] . '/artist' . $array[$k]["x"] . '_' . $array[$k]["y"] . '.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    </div> 
                </a> ';
            }
            ?>
        </div>
        <div class="column">
            <?php
            for ($k = 6 ; $k < 8; $k++) {
                echo
                ' <a href="artpiece.php?artist=' . $array[$k]["x"] . '&artnumber=' . $array[$k]["y"] . '">
                    <div class =artistGroup>
                        <img src="../images/artist' . $array[$k]["x"] . '/artist' . $array[$k]["x"] . '_' . $array[$k]["y"] . '.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    </div> 
                </a> ';
            }
            ?>
        </div>
    </div>
    </div>

        <!--Rest of Page-->
    
        <hr></hr>
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
    <script src ="../js/responsiveHeader"></script>    
</body>
</html>
