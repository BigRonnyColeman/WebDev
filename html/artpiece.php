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
    <title>Art Dealer | My Profile</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
        header{
            background-color:black;
        }

        input[type=number], select, textarea {
            width: 80%;
            padding: 1vw;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        
        input[type=submit], select, textarea {
            width: 80%;
            padding: 1vw;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            background-color: rgb(68, 68, 68);
            color: white;
            cursor: pointer;
        }

        input[type=submit]:hover {
            opacity:0.8;
        }
    </style>
    <script>

        const urlParams = new URLSearchParams(window.location.search);
        const artistvalue = urlParams.get('artist');
        const artistint = parseInt(artistvalue);
        const artpiecenum = urlParams.get('artnumber');
        const artpieceint = parseInt(artpiecenum);
        console.log(artistvalue);
        var cookiestring = "";
    </script>
</head>
<body>
    <!-- Header -->
    <div id="navbar">
        <header>
            <img class ="logo" src ="../images/logoWhite.jpeg" alt = "logo">
            <nav>
                <ul class = "navLinks">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="artists.php"><u style="text-underline-offset: 0.7em";>ARTISTS</u></a></li>
                    <li><a href="best.php">BEST SELLERS</a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                </ul>
            </nav>
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
                            <td style="text-align:center; "><a href="artpiece.php?action=remove&code=<?php echo $item["artpieceID"] . "&artist=" . $_GET["artist"] . "&artnumber=" . $_GET["artnumber"] ?>" class="btnRemoveAction" style="font-family: Arial, Helvetica, sans-serif; width:1vw; colour:white;"><img src="../images/delete.jpeg" height="9vw"/></a></td>
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
    
    <div class="section">
        <div class="row">
            <div class="column">
                <img src="../images/artist<?php echo $_GET["artist"] . "/artist" . $_GET["artist"] . "_" . $_GET["artnumber"] ?>.jpeg" style= "border:rgb(68, 68, 68) solid; width:100%;"; />')   
            </div>
            <div class="column">
                <h2 style = "padding-top:3vw;"><?php include '../php/getartName.php';?></h2>
                <h2 style="font-size:90%;opacity:0.7;"> <?php include '../php/getartpieceprice.php';?></h2>
                <br>
                <br>
                <!-- add artpiece ID to global cookies?? Then Cart reads cookies and gets data from database -->
                <!-- https://www.w3schools.com/js/js_cookies.asp -->
                
                <form action="artpiece.php?artist=<?php echo $_GET['artist'] ?>&artnumber=<?php echo $_GET['artnumber'] ?>&action=add&artpieceID=<?php include '../php/getartpieceID.php';?>" method="post" style="text-align:center;">
                    <input type="number" class="product-quantity" name="quantity" min="1"/>
                    <input type="submit" value="Add to Cart" class="btnAddAction" />
                </form>
                
                <br>
                <h3 style="padding-left:5vw; padding-bottom:1vw;">Description</h3>
                <p style="padding-left:5vw; font-size:1vw; text-align:left;"><?php include '../php/getartpiecedesc.php';?></p>

                <!--<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>-->
            </div>
        </div>

    </div>
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
