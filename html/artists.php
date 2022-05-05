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
            position:fixed;
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
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
            max-width: 25%;
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
            padding-bottom: 20px;
        }
        
        .artistGroup:hover {
            opacity: 0.8;
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
            <img class ="logo" src ="../images/logoWhite.png" alt = "logo">
            <nav>
                <ul class = "navLinks">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#"><u style="text-underline-offset: 0.7em";>Artists</u></a></li>
                    <li><a href="best.php">Best Sellers</a></li>
                    <li><a href="about2.html">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <!--Cart-->
            <button class="openbtn" onclick="openNav()"> <img src="../images/cart.jpeg" style="width:3.2vw; height:3vw; cursor: pointer;r"/></button>  
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <h2 style="color: rgb(230, 230, 230); padding-bottom:1vw;">Cart<h2>
                <hr style="border-color: rgb(158, 158, 158);"></hr><br>
                <a>Item 1 x quantity</a>
                <a>Item 1 x quantity</a>
                <div style="padding-top:5vw;">
                    <button class ="checkoutbtn" onclick="">Checkout</button> 
                </div> 
            </div>
        </header>
    </div>
    <hr></hr>

    </div>
    <hr></hr>
    <h2 style = "padding-top:7vw; padding-bottom: 2vw;">Shop By Artist</h2>
    <div class="section">
    <div class="row">
        <div class="column">
            <a href="artist.php?artist=1">
                <div class =artistGroup>
                    <img src="../images/artist1/artist1_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=2">
                <div class =artistGroup>
                    <img src="../images/artist2/artist2_overview.png" style= "border:rgb(68, 68, 68) solid;"/>
                </div>
            </a>
            <div href="#" class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=3">
                <div class =artistGroup>
                    <img src="../images/artist3/artist3_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
        </div>
        <div class="column">
            <a href="artist.php?artist=4">
                <div class =artistGroup>
                    <img src="../images/artist4/artist4_overview.png" style= "border:rgb(68, 68, 68) solid"/>
                </div>
            </a>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
            </div>
            <div class =artistGroup>
                <img src="../images/artPlacement.jpeg" style= "border:rgb(68, 68, 68) solid"/>
                <div class="artistText"> Artist12</div>
            </div>
        </div>
    </div>
    </div>
        <!--Rest of Page-->

    <p><a href='https://www.freepik.com/vectors/human-avatar'>Human avatar vector created by freepik - www.freepik.com</a></p>
    <p><a href='https://bluethumb.com.au/sophie-lawrence/Artwork/green-farm-106x106-framed-large-textured-abstract-landscape'>Artwork</a></p>
    
    <footer style ="text-align:center; opacity:50%; font-size:1vw; padding:3vw;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>
    <script src ="../js/responsiveHeader"></script>

    
    
</body>
</html>
