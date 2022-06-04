<?php
require_once ("../php/cart.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.jpeg" />
    <title>About Us</title>
    <meta name="description" content="Art Dealer About Page">
    <style>
        header {
            background-color: black;
        }
    </style>
</head>

<body>
    <!-- Navigation Header -->
    <div id="navbar">
        <header>
            <a href="index.php"><img class="logo" href="index.php" src="../images/logoWhite.jpeg" alt="logo"></a>
            <nav>
                <ul class="navLinks">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="artists.php">ARTISTS</a></li>
                    <li><a href="best.php">BEST SELLERS</a></li>
                    <li><a href="about.php"><u style="text-underline-offset: 0.7em" ;>ABOUT US</u></a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                    <li>
                        <div class="searchDiv">
                            <form id="form" role="search" action="search.php?search=" method="post">
                                <input type="text" id="search" name="search" placeholder="Search..." minlength="3" required aria-label="Search through site content">
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
                                    <button class="checkoutbtn"><a href="account.php" style="font-size:60%">Sign In/Register to Checkout</a></button>
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
    <hr>
    </hr>
    <!-- About Us Text -->
    <div class=paragraph>
        <h2 style="padding-top:4vw; padding-bottom: 1vw;">ABOUT ART DEALER</h2>
        <div class="paragraph">
            <p>Art Dealer is a Canberra-based online art-sharing emporium offering a unique selection of over 50+ handpicked high-quality posters and art prints from local underground artists. <br><br>With a strong focus on 20th-century modern style art, you'll be able to find historically rich art pieces that will transform the looks in your home. <br><br> Made to order & curated locally in Melbourne, Australia. We launched our premium giclee art print line in the hope to provide fellow humans looking to sprouce up their home the opportunity to do so at affordable pricing. <br><br>Here at Art Dealer we to focus mainly on high quality materials and sustainability. We're glad that you found us, and hope you’ll enjoy our unique art pieces as much as we do.</p><br>
            <p>We have had a total of <?php include('../php/getsales.php') ?> sales, delivering quality Canberran Art to the Region.</p>
        </div>
        <img src="../images/aboutusimage.jpeg" style="width:75%; height:75%; margin-left:auto; display: block; margin-right:auto; opacity: 75%; border:rgb(68, 68, 68) solid" />
    </div>
    <div class=paragraph>
        <div class="paragraph">
            <h2>TERMS AND CONDITIONS</h2>
            <h3 style="padding-top:3vw; padding-bottom: 1vw; text-align:center"><b>LICENSE</b></h3>
            <p>Unless otherwise stated, Art Dealer and/or its licensors own the intellectual property rights for all material on this website. All intellectual property rights are reserved. You may access this from Art Dealer for your own personal use subjected to restrictions set in these terms and conditions.</p>
            <br>
            <p>You must not repbulish material, sell, rent or sub-license material, reproduce, duplicate or copy from Art Dealer, or redistribute content from Art Dealer</p>
            <br>
            <h3 style="padding-top:3vw; padding-bottom: 1vw; text-align:center"><b>SHIPPING POLICIES</b></h3>
            <p>Australia wide, shipping is covered by Art Dealer. The price you see on the checkout is all inclusive and there are no additional costs required.</p>
            <br>
            <p>After ordering online, you will receive an email confirmation containing your order details, as well as an email directly from Art Dealer, to the email address you have specified on your account. We will normally confirm receipt of your order within the business day of your order.</p>
            <br>
            <p>We will attempt to have your artwork sent by the artist and associated freight provider within five (5) business days; and delivered within fourteen (14) business days.
                Please allow longer for artworks coming from remote areas, or if you have chosen to have the work framed. We do NOT accept PO Box delivery options. If you wish to query a delivery please contact us.</p>
            <br>
            <h3 style="padding-top:3vw; padding-bottom: 1vw; text-align:center"><b>FREE RETURNS POLICY</b></h3>
            <p>Free returns are designed to ensure you get an artwork you love, and one that fits your space at home or work. With that in mind Art Dealer will allow a customer to return up to two (2) artworks free of charge, with our company paying the return shipping. Returns above this quantity require written approval from Art Dealer.</p>
            <br>
            <p>Lay-By orders are subject to different returns policy due to the fact they take an extended time to complete payment.
                In the event that the artwork from a Layby order is not suitable, Art Dealer reserves the right to void the returns policy with prior notice or allow the return and the buyer may return the artwork in exchange for a gift voucher to the equivalent value of the artwork purchased.
                The gift voucher cannot be redeemed for cash, it can only be used to purchase an alternative artwork.</p>
            <br>
            <h3 style="padding-top:3vw; padding-bottom: 1vw; text-align:center"><b>INSURANCE</b></h3>
            <p>Art Dealer insures all artworks in transit. In the rare case an artwork is damaged in transit, we have it fully covered. You can either be refunded in full, request the artist to create something unique for you or purchase any other piece from our website (store credit) immediately without having to wait for the insurance claim.</p>
            <br>
            <p>Insurance cases are handled by our professional team and artists are compensated in full as well (if damaged in transit due to courier handling).</p>
            <br>
            <p>If the artworks are returned directly by you, they must be returned via a trackable and insured shipping carrier, and the tracking information must be provided to Art Dealer.</p>
            <br>
            <p>Insurance is valid for the time the artwork is in transit only.</p>
            <br>
            <h3 style="padding-top:3vw; padding-bottom: 1vw; text-align:center"><b>COOKIES</b></h3>
            <p>We employ the use of cookies. By accessing Art Dealer, you agreed to use cookies in agreement with the Company's Privacy Policy.</p>
            <br>
            <p>Most interactive websites use cookies to let us retrieve the user's details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
        </div>
    </div>
    <h2>HAVE ANY QUESTIONS?</h2>
    <p>Feel free to contact us and leave any questions, queries or doubtful points with our polite team!</p>
    <div style="padding:4vw;">
        <a class="btnStyle" href="../html/contact.php">Get in Touch</a>
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
        document.getElementById('date-time').innerHTML = dt;
    </script>
</body>

</html>