<?php
session_start();
require_once("../php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM artpiece WHERE artpieceID='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["artpieceID"]=>array('name'=>$productByCode[0]["name"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["artpieceID"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["artpieceID"] == $k) {
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
					if($_GET["artpieceID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
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
        /*General Page Styling*/
        *{
            box-sizing: border-box;
            margin:0;
            padding:0;
        }

        .sticky {
            top: 0;
            width: 100%;
            z-index:999;
        }

        header{
            background-color:black;
        }

        .artistbox {

        display: flex;
        flex-direction: row;
        font-family: sans-serif;
        align-items:center;
        }

        .section {
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 50px;
            background-color:rgba(255, 255, 255, 0.5)
        }

        .paragraph {
        color: #555;
        display: flex;
        flex-direction: column;
        }

        .content {
        padding: 20px;
        }

        .title {
        font-size: 24px;
        color: #222;
        line-height: 24px;
        }

        .image {
            width: 25%;
        }

        a.button1{
            width: 40%;
            padding:0.35em 1.2em;
            border:0.1em solid #ffffff;
            margin:0 0.3em 0.3em 0;
            border-radius:0.12em;
            box-sizing: border-box;
            text-decoration:none;
            font-family:'Roboto',sans-serif;
            font-weight:300;
            color:#ffffff;
            text-align:center;
            transition: all 0.2s;
            }
            a.button1:hover{
                border:0.1em solid rgb(68, 68, 68);
                color:rgb(68, 68, 68);
                
            }
            @media all and (max-width:30em){
            a.button1{
            display:block;
            margin:0.4em auto;
            }
            }


        /*Artist Grid styling*/ 
        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            padding: 0; 
        }

        .column { /* Create four equal columns that sits next to each other */
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
            max-width: 50%;
            padding: 0 10px;
        }

        .column img {
            margin-top: 0px;
            vertical-align: middle;
            width: 100%;
        }

        @media screen and (max-width: 800px) { /* Responsive layout - makes a two column-layout instead of four columns */
            .column {
                -ms-flex: 50%;
                flex: 50%;
                max-width: 50%;
            }
        }

        .artistText {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Times New Roman', Times, serif;
            font-size:2.5vw;
            font-weight:100;
            color: rgb(230, 230, 230);
        }

        .artistGroup {
            position: relative;
            cursor:pointer;
        }
        
        .artistGroup:hover {
            opacity: 0.8;
        }

        .btnStyle{
            font-size: 2vw;
            color: rgb(68, 68, 68);
            border: 1px solid #818181;
            background-color:transparent;
            cursor: pointer;
            text-decoration:none;
            padding:3vw;
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
            <img class ="logo" src ="../images/logoWhite.png" alt = "logo">
            <nav>
                <ul class = "navLinks">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="artists.php"><u style="text-underline-offset: 0.7em";>ARTISTS</u></a></li>
                    <li><a href="best.php">BEST SELLERS</a></li>
                    <li><a href="about2.html">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                </ul>
            </nav>
                            <!--Cart-->
                <!-- Read Link https://phppot.com/php/simple-php-shopping-cart/ -->
                <!-- Run testing_shop/index.php , Needs database/tables imported -->
                <!-- Does not have a checkout, but uses sessions instead cookies -->
                <!-- Try This Next -->

                <button class="openbtn" onclick="openNav()"> <img src="../images/cart.jpeg" style="width:3.2vw; height:3vw; cursor: pointer;"/></button>  
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="font-family: Arial, Helvetica, sans-serif; font-size:3vw">x</a>
                    <h2 style="color:rgb(230, 230, 230); padding-bottom:1vw;">CART<h2>
                    <hr style="border-color: rgb(158, 158, 158);"></hr><br>
                    

                    
                    
                    <?php
                    if(isset($_SESSION["cart_item"])){
                        $total_quantity = 0;
                        $total_price = 0;
                    ?>	
                    <table class="tbl-cart" cellpadding="10" cellspacing="1">
                    <tbody>
                    <tr>
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:left;">Code</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                    </tr>	
                    <?php		
                        foreach ($_SESSION["cart_item"] as $item){
                            $item_price = $item["quantity"]*$item["price"];
                            ?>
                                    <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                                    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                                    <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["artpieceID"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                    </tr>
                                    <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"]*$item["quantity"]);
                            }
                            ?>

                        <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $total_quantity; ?></td>
                        <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                        <div style="padding-top:5vw;">
                        <button class ="checkoutbtn"><a href="checkout.php">Checkout</a></button> 
                        </div> 
                        <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
                        <td></td>
                        </tr>
                        </tbody>
                        </table>		
                        <?php
                        } else {
                        ?>
                        <div class="no-records">Your Cart is Empty</div>
                        <?php 
                        }
                        ?>
                    
                    </div>
                </div>
        </header>
    </div>
    <hr></hr>
    
    <div class="section">
        <h2 style = "padding-bottom: 2vw;"><?php include '../php/getartName.php';?></h2>
        <div class="row">
            <div class="column">
                <script language="javascript">
                    document.write('<img src="../images/artist' + artistvalue + '/artist' + artistvalue + '_'+artpieceint+'.png" style= "border:rgb(68, 68, 68) solid; width:100%;"; />')
                </script>   
            </div>
            <div class="column">
                <h2 style="font-size:60%;"> <?php include '../php/getartpieceprice.php';?> </p>
                <br>
                <br>
                <!-- add artpiece ID to global cookies?? Then Cart reads cookies and gets data from database -->
                <!-- https://www.w3schools.com/js/js_cookies.asp -->
                
                <form action="index.php?action=add&artpieceID=<?php include '../php/getartpieceID.php';?>" method="post">
                        <div class="cart-action">
                            <input type="number" class="product-quantity" name="quantity" min="1" max="2" />
                            <input type="submit" value="Add to Cart" class="btnAddAction" />
                        </div>
                </form>
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
