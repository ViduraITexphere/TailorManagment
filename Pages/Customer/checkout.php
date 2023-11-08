<?php
session_start();
// include config file
require_once "config.php";
include_once('../../inc/conn.php');

// Check if the 'order_id' parameter is in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch the cost related to the order_id
    $sql = "SELECT cost FROM `tbl_cost` WHERE order_id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cost = $row['cost'];
    } else {
        $cost = "Not found";
    }
} else {
    $cost = "Invalid order_id";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=USD"></script>
    <style>
        @font-face {
            font-family: myFont;
            src: url("../../Assets/fonts/NeueHansKendrick-Regular.ttf");
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            justify-items: center;
            margin: 0 auto;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            padding: 10px 60px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            font-family: myFont;
        }

        h2 {
            font-size: 24px;
            color: #333;
            font-family: myFont;
        }

        h3 {
            font-family: myFont;
        }

        p {
            font-size: 18px;
            color: #555;
            font-family: myFont;
        }

        #paypal-button-container {
            text-align: center;
            margin-top: 30px;
        }

        /* Style the PayPal button */
        .paypal-button {
            max-width: 200px;
            margin: 0 auto;
        }

        /* Style success messages */
        .success-message {
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .checkout-container {
            display: flex;
            justify-content: flex-start;
        }

        form {
            display: flex;
            flex-direction: column;
            font-family: myFont;
            color: #555;
            font-size: 18px;
            gap: 10px;
        }

        form input {
            margin-bottom: 10px;
            margin-top: 5px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        p span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="details">
                <h2>Checkout</h2>
                <p>Subtotal: <?php echo 'Rs.' . +$cost . '.00'; ?></p>
                <p>Shipping Cost: Free</p>
                <p><span>Total: <?php echo 'Rs.' . +$cost . '.00'; ?></span></p>
                <h3>Order Details</h3>
                <p>Order ID: <?php echo $order_id; ?></p>
                <p>Customer Username: <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Not logged in'; ?></p>
            </div>

            <!-- Customer Information Form -->
            <form action="process_checkout.php" method="post">
                <label for="billing_address">Billing Address:</label>
                <textarea id="billing_address" name="billing_address" rows="4" cols="50" required></textarea>

                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" required>

                <!-- PayPal Buttons -->
                <div id="paypal-button-container"></div>
            </form>
        </div>
    </div>
    <script>
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $cost; ?>'
                        }
                    }]
                });
            },
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log(orderData.id);
                    console.log(orderData.status);

                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    let transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    console.log("Transaction details:\n", transaction);

                    // redirect to success page
                    window.location.href = "success.php?order_id=<?php echo $order_id; ?>&transaction_id=" + transaction.id;
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>