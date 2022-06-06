<!-- This Page is used by the website host to easily read database Data -->
<!-- This page is not part of the user website submission --> 
<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" href="../css/siteStyling.css">
        <link rel="icon" href="../images/icon.jpeg"/>
        <title>Art Dealer</title>
        <meta name="description" content="Art Dealer Home page">
        <style>
            header {
                background-color: black;
                position: fixed;
                z-index: 100;
                width:100%;
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
                opacity: 0.8;
            }

            .indexbtnStyle2 {
                background-color: rgb(68, 68, 68);
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .indexbtnStyle2:hover {
                opacity: 0.8;
            }

                       * {
            box-sizing: border-box;
            }

            table {
            border-spacing: 0px;
            border-collapse: collapse;
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
            margin-bottom: 15px;
            background-color: transparent; /* Change the background-color of table here */
            text-align: left; /* Change the text-alignment of table here */
            }

            th {
            font-weight: bold;
            border: 1px solid #cccccc; /* Change the border-color of heading here */
            padding: 8px;
            }

            td {
            border: 1px solid #cccccc; /* Change the border-color of cells here */
            padding: 8px;
            }

            tr:hover {background-color: #D6EEEE;}

        </style>
    </head>
    <body>
    <div id="navbar" style="padding-bottom:10vw;">
        <header>
            <a href="index.php" ><img class="logo" href="index.php" src="../images/logoWhite.jpeg" alt="logo"></a>
            <nav>
                <ul class="navLinks">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="artists.php">ARTISTS</a></li>
                    <li><a href="best.php">BEST SELLERS</a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
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
        <?php include('../php/showdatainsert.php');?>
        <div class="indexboxlink" style="padding:1vw; width:30%">
                <a class="indexbtnStyle" href="../html/account.php">< Back</a>
        </div><br><br>
        <script src="../js/responsiveHeader.js"></script>
    </body>
</html>
