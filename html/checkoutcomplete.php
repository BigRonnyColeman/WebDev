<?php

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
	    case "checkout":
            require_once("../php/dbinsert.php");
    }
}
?>
<!DOCTYPE html>
<html>

<!--USE THIS PAGE FOR REFERENCE TO BUILD OTHER PAGES-->

<head>
    <link rel ="stylesheet" href="../css/siteStyling.css">
    <link rel="icon" href="../images/icon.png"/>
    <title>Checkout</title>
    <meta name="description" content="Art Dealer Home page">
    <style>
    /*General Page Styling*/
        *{
            box-sizing: border-box;
            margin:0;
            padding:0;
        }

         .section {
            padding: 3vw;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 5vw;
            background-color:rgba(255, 255, 255, 0.5);
            width:40vw;
        }

        body {font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box;}

        input[type=text], select, textarea {
            width: 100%;
            padding: 1vw;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 3vw;
            resize: vertical;
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
            opacity:0.8;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 7vw;
        }

        /* Split the screen in half */
        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 0;
            overflow-x: hidden;
        }

        /* Control the left side */
        .left {
            left: 0;
        }

        /* Control the right side */
        .right {
            right: 0;
            background-color:hsl(21, 12%, 72%);
        }

        /* If you want the content centered horizontally and vertically */
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

    </style>
</head>
<body>

    <p> Thank you for Your Purchase </p>
        
    <div style="padding-top:5vw; text-align:center">
                            <button class ="checkoutbtn"><a href="index.php">HOME</a></button> 
    </div> 
    <br>
    <br><br>
    <footer style ="text-align:center; opacity:50%; font-size:1vw;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>

</body>
</html>