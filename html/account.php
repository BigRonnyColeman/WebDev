<?php
require_once ("../php/cart.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.jpeg" />
    <title>Contact Us</title>
    <meta name="description" content="Art Dealer Contact Us">
    <style>
        /*General Page Styling*/

        header {
            background-color: black;
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
    </style>
</head>

<body>
    <!-- Navigation Header -->
    <div id="navbar">
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
                                    <button class="checkoutbtn"><a href="account.php" style="font-size:60%">Sign In/Register</a></button>
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
    <!-- Need to add php -->
    <!-- visible if not signed in -->
    <?php

    if(!isset($_SESSION["loggedin"]) or !isset($_SESSION["id"]) or !isset($_SESSION["username"])) {
        echo '
        <div class="centerpage">
        <div class="section2">
        <h2 style="padding:2vw;">MY ACCOUNT</h2>
            <div class="indexboxlink" style="padding-bottom:1vw;">
                <a class="indexbtnStyle" href="../html/login.php">Login</a>
            </div>
            <!-- Change to only show if admin credentials -->
            <div class="indexboxlink" style="padding-bottom:3vw;">
                <a class="indexbtnStyle" href="../html/signup.php">Sign Up</a>
            </div>
        </div>
    </div>
        ';
    }  else if(isset($_SESSION["loggedin"]) and isset($_SESSION["id"]) and isset($_SESSION["username"]) and ($_SESSION["type"] == "admin")) { 
        echo '
        <div class="centerpage">
        <div class="section2">
        <br>
        <!-- Change to only show if admin credentials -->
        <div class="indexboxlink" style="padding-bottom:1vw;">
            <a class="indexbtnStyle" href="../html/adminshowcontact.php">Contact Portal</a>
        </div>
        <!-- Change to only show if admin credentials -->
        <div class="indexboxlink" style="padding-bottom:1vw;">
            <a class="indexbtnStyle" href="../html/adminshoworders.php">Show Orders</a>
        </div>
        <br><div style="text-align:center;">
            <a class="indexbtnStyle" href="./logout.php"">Sign Out</a></div><br><br>
        </div>
        </div>
        ';
    } else if (isset($_SESSION["loggedin"]) and isset($_SESSION["id"]) and isset($_SESSION["username"]) and ($_SESSION["type"] == "user")) {
        echo '
        <br><br>
        <h2>ACCOUNT INFO</h2>
        <div class="centerpage">
        <div class="section2">
            <br><br>
            <div class="indexboxlink" style="padding-bottom:1vw;">
                <a class="indexbtnStyle" href="../html/pastorders.php">View Past Orders</a>
            </div>
            
            <br>
            <br>
            
            <form>
                <label for="logout">Log Out</label><br><br>
                <a class="indexbtnStyle2" href="./logout.php">Sign Out</a>
            </form>
            
            <br><br><br>
            <form action="reset.php">
                <label for="delete">Reset Password</label><br><br>
                <input type="submit" id="myBtn" value="Reset Password">
            </form>


            <br><br><br>
            <!-- Sends _POST varaiables to php on index, action=contact -->

            <form action="../php/delete.php" method="post">
                <label for="delete">Delete Account</label><br> ';
                if (isset($_SESSION["login_err"])) {
                    $temp = $_SESSION["login_err"];
                    echo '
                    <div class="invalid-feedback">' . $temp . '</div>
                    ';
                }
                echo '
                <input type="text" id="pass" name="pass" placeholder="Confirm Password to Proceed">
                <input type="submit" id="myBtn" value="Delete Account">
            </form>

        </div>
        </div>
        ';
    }

    ?>


    
    <hr>
    </hr>
    <!-- Footer -->
    <footer style="text-align:center;font-size:1vw; padding:3vw;">
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
</body>

</html>