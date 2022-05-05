<!DOCTYPE html>
<html>
<head>
    <link rel ="stylesheet" href="../css/siteStyling.css">
    <title>Art Dealer | Shop Local Canberra Artists</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
         /*General Page Styling*/
         *{
            box-sizing: border-box;
            margin:0;
            padding:0;
        }   

        /*Background Image at beginning of page + Fade In*/
        .backgroundImage{
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

        /*About Us Styling*/
        .paragraph{
            padding-left:5vw;
            padding-right:5vw;
            padding-bottom:5vw;
        }

        .column2 {
            float: left;
            width: 33.33%;
            padding: 5px;
        }

        .row2::after {
            content: "";
            clear: both;
            display: table;
        }

        .infoText {
            text-align:center;
        }

        .infoGroup {
            position: relative;
            z-index: -1;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 75%;
        }

        /*Footer Styling*/
        .signUpAndSave{
            text-align: center;
        }
    </style> 
</head>

<body>
    <!-- Header -->
    <div class ="backgroundImage">
        <div id="navbar">
            <header>
                <img class ="logo" src ="../images/logoWhite.png" alt = "logo">
                <nav>
                    <ul class = "navLinks">
                        <li><a href="index.php"><u style="text-underline-offset: 0.7em";>HOME</u></a></li>
                        <li><a href="artists.php">ARTISTS</a></li>
                        <li><a href="best.php">BEST SELLERS</a></li>
                        <li><a href="about2.html">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
                    </ul>
                </nav>
                <!--Cart-->
                <button class="openbtn" onclick="openNav()"> <img src="../images/cart.jpeg" style="width:3.2vw; height:3vw; cursor: pointer;r"/></button>  
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <h2 style="color: rgb(230, 230, 230); padding-bottom:1vw;">Cart<h2>
                <hr style="border-color: rgb(158, 158, 158);"></hr><br>
                <a>item...</a>
                <div style="padding-top:5vw;">
                    <button class ="checkoutbtn">Checkout</button> 
                </div> 
            </div>
            </header>
        </div>
    
    <!--Artists-->
    </div>
    <hr></hr>
    <h2 style = "padding-top:7vw; padding-bottom: 2vw;">Shop By Artist</h2>
    <div class="row">
        <div class="column">
            <a href="artist.php?artist=1">
                <div class =artistGroup>
                    <img src="../images/artist1/artist1_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText"> Artist1</div>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist2</div>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist3</div>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=2">
                <div class =artistGroup>
                    <img src="../images/artist2/artist2_overview.png" style= "border:rgb(68, 68, 68) solid;"/>
                    <div class="artistText"> Artist2</div>
                </div>
            </a>
            <div href="#" class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist5</div>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist6</div>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=3">
                <div class =artistGroup>
                    <img src="../images/artist3/artist3_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText"> Artist3</div>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist8</div>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist9</div>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=4">
                <div class =artistGroup>
                    <img src="../images/artist4/artist4_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                    <div class="artistText"> Artist4</div>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist11</div>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist12</div>
            </div>
        </div>
        <div style="padding:8vw; margin:0 auto">
            <a class = "btnStyle" href="#">View Best Sellers</a>
        </div>
    </div>

    <!--About Us-->
    <hr></hr>
    <h2 style = "padding-bottom:1vw; padding-top:3vw;">About Us</h2>
    <div class ="paragraph">
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br>
    </div>

    <div class="row2" style="padding-bottom: 5vw;">
        <div class="column2">
            <div class =infoGroup>
                <img src="../images/infoImage.webp" style= "width:100%; opacity: 75%;"/>
                <div class="infoText"> <h2>Premium Quality</h2><br><p>Printed using water-based inks and professional 12-colour giclée printers, giving it colour vibrancy that’s protected for 80+ years.</p></div>
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

    <!--End-->
    <hr></hr>
    <!-- INSERT IN ASSIGNMENT 2
    <h2 style = "padding-bottom:1vw; padding-top:3vw;">Sign Up and Save</h2>
    <div class="signUpAndSave" style="padding:5vw;">
        <a class = "btnStyle" href="#">My Profile</a>
        <a class = "btnStyle" style="padding-right: 4vw;padding-left: 4vw;" href="#">Sign Up </a>
    </div>
    -->
    <button type="button"><a href="javascript:window.location.reload(true)">CLear Cookies</a></button>
    <footer style ="text-align:center; opacity:50%; font-size:1vw; padding:3vw;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>
    
    <!--JavaScript-->
    <script src ="../js/responsiveHeader"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>