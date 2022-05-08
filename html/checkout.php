
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

    <div class="split left">
        
    <div class="centered">
        <header></header>
        <img class ="logo" style = "height:3vw;" src ="../images/logoBlack.png" alt = "logo">
        <div class="section">
        <form style="text-align: left;">
            <label for="contact">Contact Information</label>
            <div style="display:flex;">
                <input type="text" id="shipping" name="fname" placeholder="First Name.." style="font-size:1vw;">
                <input type="text" id="shipping" name="lname" placeholder="Last Name.." style="font-size:1vw;">
            </div>
            <input type="text" id="contact" name="contactinfo" placeholder="Email or Mobile Phone Number.." style="font-size:1vw;">

            <label for="shipping">Mailing Address</label>

            <input type="text" id="shipping" name="address" placeholder="Address.." style="font-size:1vw;">
            <div style="display:flex;">
                <select id="shipping" name="State" style="font-size:1vw;">
                    <option value="act">ACT</option>
                    <option value="nsw">NSW</option>
                    <option value="vic">VIC</option>
                    <option value="qld">QLD</option>
                    <option value="nt">NT</option>
                    <option value="sa">SA</option>
                    <option value="wa">WA</option>
                </select>
                <input type="text" id="shipping" name="suburb" placeholder="Suburb.." style="font-size:1vw;">
                <input type="text" id="shipping" name="postcode" placeholder="Postcode.." style="font-size:1vw;">
            </div>

            <input type="submit" id = "myBtn" value="Submit" style="font-size:1vw;">
            <a href = "artists.php" style="color:black; font-size:1vw; text-decoration: underline; padding-left:1vw;">Return to Artists...</a>
            <!-- The Modal -->
        </form>
    </div>
    </div>
    </div>

    <div class="split right">
    <div class="centered">

    <div class="section">
        <label">Mailing Address</label><br>
        <?php 
            foreach($_COOKIE as $key=>$value)
            {
            global $var;
            $var = $value;
            include '../php/getcartName.php';
        };
        ?>

        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
        <!-- Set up a container element for the button -->
        <div style = "padding-top: 8vw;" id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '77.44' // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </div>

    <footer style ="text-align:center; opacity:50%; font-size:1vw;">© 2022 Art Dealer Pty Ltd. ABN 98 427 123 056</footer>

</body>
</html>
