<?php
if (!isset($_SESSION["loggedin"])){
    $_SESSION["type"] = "public";
}
require_once ("../php/cart.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.jpeg" />
    <title>Art Dealer</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
        /*Background Image at beginning of page + Fade In*/
        .backgroundImage {
            background-image: url("../images/frontPageImage.jpeg");
            height: 70vw;
            background-repeat: no-repeat;
            width: 100%;
            background-size: cover;
            animation: fadeIn 1s;
            -webkit-animation: fadeIn 1s;
            -moz-animation: fadeIn 1s;
            -o-animation: fadeIn 1s;
            -ms-animation: fadeIn 1s;
        }

        .sticky {
            position: fixed;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @-moz-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @-o-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @-ms-keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="backgroundImage">
        <div id="navbar">
            <header>
                <a href="index.php" ><img class="logo" href="index.php" src="../images/logoWhite.jpeg" alt="logo"></a>
                <nav>
                    <ul class="navLinks">
                        <li><a href="index.php"><u style="text-underline-offset: 0.7em" ;>HOME</u></a></li>
                        <li><a href="artists.php">ARTISTS</u></a></li>
                        <li><a href="best.php">BEST SELLERS</a></li>
                        <li><a href="about.php">ABOUT US</u></a></li>
                        <li><a href="contact.php">CONTACT US</u></a></li>
                        <li>
                            <div class="searchDiv">
                                <form id="form" role="search" action="search.php?search=" method="post">
                                    <input type="text" id="search" name="search" minlength="3" required placeholder="Search..." aria-label="Search through site content">
                                    <button id="button">
                                        <svg viewBox="0 0 1024 1024">
                                            <path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Cart Items and Navigation -->
                <!-- Uses global variabl $_Session and stores all relevant data to 
                    each session in the array $_Session["cart_item"] -->
                <!-- Need to change so only visible if signed in -->
                <button class="acountbtn" onclick="window.location.href='account.php'"> <img src="../images/icon2.png" style="width:3.2vw; height:3vw; cursor: pointer;" /></button>
                <button class="openbtn" onclick="openNav()"> <img src="../images/cart.jpeg" style="width:3.2vw; height:3vw; cursor: pointer;" /></button>
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="font-family: Arial, Helvetica, sans-serif; font-size:3vw">x</a>
                    <h2 style="color:rgb(230, 230, 230); padding-bottom:1vw;">CART</h2>
                    <hr style="border-color: rgb(158, 158, 158);">
                    </hr><br>
                    <?php
                    if (isset($_SESSION["cart_item"])) {
                        $total_quantity = 0;
                        $total_price = 0;
                    ?>
                        <table class="tbl-cart" cellspacing="7vw">
                            <tbody>
                                <tr>
                                    <th style="text-align:left; padding:1%" name="Name"></th>
                                    <th style="text-align:right; width:0.8%;" name="Quantity"></th>
                                    <th style="text-align:right; width:0.8%;" name="Price"></th>
                                    <th style="text-align:right; width:0.2%;" name="Remove"></th>
                                </tr>
                                <?php
                                /* Loops through each item in array and prints a tr for it */
                                foreach ($_SESSION["cart_item"] as $item) {
                                    $item_price = $item["quantity"] * $item["price"];
                                ?>
                                    <tr>
                                        <td><?php echo $item["name"]; ?></td>
                                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                        <td style="text-align:right; "><?php echo "$ " . number_format($item_price, 2); ?></td>
                                        <td style="text-align:center; "><a href="index.php?action=remove&code=<?php echo $item["artpieceID"]; ?>" class="btnRemoveAction" style="font-family: Arial, Helvetica, sans-serif; width:1vw; colour:white;">-</a></td>
                                    </tr>
                                <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"] * $item["quantity"]);
                                }
                                ?>
                                <tr>
                                    <td align="center" span="2">Total:</td>
                                    <td align="right"><?php echo $total_quantity; ?></td>
                                    <td align="right"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php

                        if (isset($_SESSION["loggedin"]) and isset($_SESSION["id"]) and isset($_SESSION["username"]) and ($_SESSION["type"] == "user")) {
                            echo '
                                <div style="padding-top:5vw;">
                                    <button class="checkoutbtn"><a href="checkout.php">Checkout</a></button>
                                </div>
                                <a id="btnEmpty" href="index.php?action=empty" style="font-size:1vw;"><u>Empty Cart</u></a>
                            ';
                        }
                        else {
                            echo '
                                <div style="padding-top:5vw;">
                                    <button class="checkoutbtn"><a href="account.php" style="font-size:60%">Sign In/Register<br>to Checkout</a></button>
                                </div>
                                <a id="btnEmpty" href="index.php?action=empty" style="font-size:1vw;"><u>Empty Cart</u></a>
                            ';
                        } ?>
                    
                    <?php
                    } else {
                    ?>
                        <div class="no-records">
                            <h2 style="font-size:2vw; white-space: nowrap; color:grey;">Your Cart is Empty</h2>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </header>
        </div>
    </div>
    <hr>
    </hr>
    <!--Artists-->
    <h2 style="padding-top:7vw; padding-bottom: 2vw;">SHOP BY ARTIST</h2>
    <div class="section">
        <div class="row">
            <div class="column">
                <?php
                include('../php/getartistname.php');
                for ($k = 0; $k < 3; $k++) {
                    echo
                    ' <a href="artist.php?artist=' . $k + 1 . '">
                                <div class =artistGroup>
                                    <img src="../images/artist' . $k + 1 . '/artist' . $k + 1 . '_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                                    <div class="artistText"><p style="text-transform: uppercase; color:white">' . $array[$k] . '</p></div>
                                </div> 
                            </a> ';
                }
                ?>
            </div>
            <div class="column">
                <?php
                include('../php/getartistname.php');
                for ($k = 3; $k < 6; $k++) {
                    echo
                    ' <a href="artist.php?artist=' . $k + 1 . '">
                                <div class =artistGroup>
                                    <img src="../images/artist' . $k + 1 . '/artist' . $k + 1 . '_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                                    <div class="artistText"><p style="text-transform: uppercase; color:white">' . $array[$k] . '</p></div>
                                </div> 
                            </a> ';
                }
                ?>
            </div>
            <div class="column">
                <?php
                include('../php/getartistname.php');
                for ($k = 6; $k < 9; $k++) {
                    echo
                    ' <a href="artist.php?artist=' . $k + 1 . '">
                                <div class =artistGroup>
                                    <img src="../images/artist' . $k + 1 . '/artist' . $k + 1 . '_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                                    <div class="artistText"><p style="text-transform: uppercase; color:white">' . $array[$k] . '</p></div>
                                </div> 
                            </a> ';
                }
                ?>
            </div>
            <div class="column">
                <?php
                include('../php/getartistname.php');
                for ($k = 9; $k < 12; $k++) {
                    echo
                    ' <a href="artist.php?artist=' . $k + 1 . '">
                                <div class =artistGroup>
                                    <img src="../images/artist' . $k + 1 . '/artist' . $k + 1 . '_overview.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                                    <div class="artistText"><p style="text-transform: uppercase; color:white">' . $array[$k] . '</p></div>
                                </div> 
                            </a> ';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="indexboxlink" style="padding:1vw;width:50%;margin:0 auto;">
        <a class="indexbtnStyle" href="../html/best.php">View Best Sellers</a>
    </div>
    <br><br>
    <div class="paragraph" style="padding-bottom:3vw">
        <p>Art Dealer is a Canberra-based online art-sharing emporium offering a unique selection of over 50+ handpicked high-quality posters and art prints from local underground artists. <br><br>With a strong focus on 20th-century modern style art, you'll be able to find historically rich art pieces that will transform the looks in your home. <br><br> Made to order & curated locally in Melbourne, Australia. We launched our premium giclee art print line in the hope to provide fellow humans looking to sprouce up their home the opportunity to do so at affordable pricing. <br><br>Here at Art Dealer we to focus mainly on high quality materials and sustainability. We're glad that you found us, and hope you’ll enjoy our unique art pieces as much as we do.</p>
    </div>
    <hr>
    </hr>
    <!-- Footer -->
    <footer class="mainFooter">
        <div class="row2" style="padding-bottom: 3vw;">
            <div class="column2">
                <div class=infoGroup>
                    <img src="../images/infoImage.webp" style="width:100%; opacity: 75%;" />
                    <div class="infoText">
                        <h2 style="font-size:2.8vw">Premium Quality</h2><br>
                        <p>Printed using water-based inks and professional 12-colour giclée printers, giving it colour vibrancy that’s protected for 80+ years.</p>
                    </div>
                </div>
            </div>
            <div class="column2">
                <div class=infoGroup>
                    <img src="../images/infoImage2.webp" style="width:100%; opacity: 75%;" />
                    <div class="infoText">
                        <h2>We're Local</h2><br>
                        <p>Run and born out of Canbera, we launched our premium giclee art print line to promote and sell local talent to the nations capital.</p>
                    </div>
                </div>
            </div>
            <div class="column2">
                <div class=infoGroup>
                    <img src="../images/infoImage3.webp" style="width:100%; opacity: 75%;" />
                    <div class="infoText">
                        <h2>Quick Delivery</h2><br>
                        <p>Fast & reliable delivery through our own employees.</p>
                    </div>
                </div>
            </div>
        </div>
        <p style="opacity: 50%;">© Art Dealer Pty Ltd. ABN 98 427 123 056, <span id='date-time'></span></p>
        <p style="opacity: 50%;">See our <a style="color: rgb(68, 68, 68); text-align: center; text-decoration:underline; font-size:1vw;" href="about.php">Terms and Conditions</a></p>
    </footer>
    <!-- Javascript -->
    <script src="../js/responsiveHeader.js"></script>
    <script>
        var dt = new Date();
        document.getElementById('date-time').innerHTML=dt;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>

</html>