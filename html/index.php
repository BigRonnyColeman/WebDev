<?php
session_start();
require_once("../php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
    case "contact":
        require_once("../php/dbinsertcontact.php");
    break;
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
    <link rel="icon" href="../images/icon.jpeg"/>
    <title>Art Dealer</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
         /*General Page Styling*/
        * {
            box-sizing: border-box;
            margin:0;
            padding:0;
        }   

        /*Background Image at beginning of page + Fade In*/
        .backgroundImage {
            background-image: url("../images/frontPageImage.jpeg");
            height:70vw;
            background-repeat: no-repeat;
            width:100%;
            background-size:cover;
            animation: fadeIn 1s;
            -webkit-animation: fadeIn 1s;
            -moz-animation: fadeIn 1s;
            -o-animation: fadeIn 1s;
            -ms-animation: fadeIn 1s;
        }

        .sticky {
            top: 0;
            width: 100%;
            z-index:999;
            position:fixed;
        }

        @keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }

        @-moz-keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }

        @-webkit-keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }

        @-o-keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }

        @-ms-keyframes fadeIn {
            0% {opacity:0;}
            100% {opacity:1;}
        }

        /*Artist Grid styling*/ 
        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            padding: 0 4px;
            
        }
       
        .column { /* Create four equal columns that sits next to each other */
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
            max-width: 25%;
            padding: 0 4px;
        }

        .column img {
            margin-top: 8px;
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
            text-align:center;
            font-size:2vw;
            font-weight:100;
            color: rgb(255, 255, 255);
        }

        .artistGroup {
            position: relative;
            cursor:pointer;
        }
         
        .artistGroup:hover {
            opacity: 0.8;
        }

        .btnStyle {
            font-size: 2vw;
            color: rgb(68, 68, 68);
            border: 1px solid #818181;
            background-color:transparent;
            cursor: pointer;
            text-decoration:none;
            padding:3vw;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
    </style>  
</head>

<body>
    <!-- Header -->
    <div class ="backgroundImage">
        <div id="navbar">
            <header>
                <img class ="logo" src ="../images/logoWhite.jpeg" alt = "logo">
                <nav>
                    <ul class = "navLinks">
                        <li><a href="index.php"><u style="text-underline-offset: 0.7em";>HOME</u></a></li>
                        <li><a href="artists.php">ARTISTS</a></li>
                        <li><a href="best.php">BEST SELLERS</a></li>
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
                </div>
            </header>
        </div>
    </div>


    <!--Artists-->
    <hr></hr>
    <h2 style = "padding-top:7vw; padding-bottom: 2vw;">SHOP BY ARTIST</h2>
    <div class="row">
        <div class="column">
            <a href="artist.php?artist=1">
                <div class =artistGroup>
                    <img src="../images/artist1/artist1_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">SOPHIE LAWRENCE</div>
                </div>
            </a>
            <a href="artist.php?artist=5">
                <div class =artistGroup>
                    <img src="../images/artist5/artist5_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">KATE ROGER</div>
                </div>
            </a>
            <a href="artist.php?artist=9">
                <div class =artistGroup>
                    <img src="../images/artist9/artist9_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">KAREN LEE MUNGARRJA</div>
                </div>
            </a>
        </div>
        <div class="column">
            <a href="artist.php?artist=2">
                <div class =artistGroup>
                    <img src="../images/artist2/artist2_overview.jpeg" style= "border:rgb(68, 68, 68) solid;"/>
                    <div class="artistText"> SUSAN TRUDINGER</div>
                </div>
            </a>
            <a href="artist.php?artist=6">
                <div class =artistGroup>
                    <img src="../images/artist6/artist6_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">LILIAN GIGOVIC</div>
                </div>
            </a>
            <a href="artist.php?artist=10">
                <div class =artistGroup>
                    <img src="../images/artist10/artist10_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">DINAH WAKEFIELD</div>
                </div>
            </a>
        </div>
        <div class="column">
            <a href="artist.php?artist=3">
                <div class =artistGroup>
                    <img src="../images/artist3/artist3_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">SALLY DUNBAR</div>
                </div>
            </a>
            <a href="artist.php?artist=7">
                <div class =artistGroup>
                    <img src="../images/artist7/artist7_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">ANGELA HAWKEY</div>
                </div>
            </a>
            <a href="artist.php?artist=11">
                <div class =artistGroup>
                    <img src="../images/artist11/artist11_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">MICHELLE KEIGHLYEY</div>
                </div>
            </a>
        </div>
        <div class="column">
            <a href="artist.php?artist=4">
                <div class =artistGroup>
                    <img src="../images/artist4/artist4_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">VALENTYNA CRANE</div>
                </div>
            </a>
            <a href="artist.php?artist=8">
                <div class =artistGroup>
                    <img src="../images/artist8/artist8_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">PIP PHELPS</div>
                </div>
            </a>
            <a href="artist.php?artist=12">
                <div class =artistGroup>
                    <img src="../images/artist12/artist12_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText">MARIA CROSS</div>
                </div>
            </a>
        </div>
        <div style="padding:8vw; margin:0 auto">
            <a class = "btnStyle" href="../html/best.php">View Best Sellers</a>
        </div>
    </div>

    <div class ="paragraph" style="padding-bottom:3vw">
        <p>Art Dealer is a Canberra-based online art-sharing emporium offering a unique selection of over 50+ handpicked high-quality posters and art prints from local underground artists. <br><br>With a strong focus on 20th-century modern style art, you'll be able to find historically rich art pieces that will transform the looks in your home. <br><br> Made to order & curated locally in Melbourne, Australia. We launched our premium giclee art print line in the hope to provide fellow humans looking to sprouce up their home the opportunity to do so at affordable pricing. <br><br>Here at Art Dealer we to focus mainly on high quality materials and sustainability. We're glad that you found us, and hope you’ll enjoy our unique art pieces as much as we do.</p>
    </div>

    <!--About Us-->
    <hr></hr>
    <!--End-->
    <!-- INSERT IN ASSIGNMENT 2
    <h2 style = "padding-bottom:1vw; padding-top:3vw;">Sign Up and Save</h2>
    <div class="signUpAndSave" style="padding:5vw;">
        <a class = "btnStyle" href="#">My Profile</a>
        <a class = "btnStyle" style="padding-right: 4vw;padding-left: 4vw;" href="#">Sign Up </a>
    </div> -->
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
    
    <!--JavaScript-->
    <script src ="../js/responsiveHeader"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>