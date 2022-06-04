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
            table {
                border: solid 2px;
                width: 75%;
                text-align: left;
                margin: 0 auto;
            }

            .first {
                border: solid 2px;
                border-color: black;
                width: 75%;
                text-align: left;
            }

            .second {
                border: dashed 2px;
                border-color: grey;
                width: 75%;
                text-align: left;
            }

            tr, td .first{
                padding: 10px;
                border: dashed 2px;
                border-color: black;
            }

            tr, td .second{
                padding: 10px;
                border: dashed 2px;
                border-color: grey;
            }
        </style>
    </head>
    <body>
        <?php include('../php/admincontact.php');?>
    </body>
</html>
