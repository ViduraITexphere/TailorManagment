<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment Success</title>
    <style>
        /* Style for the message box */
        .message-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Style for the success icon */
        .success-icon {
            font-size: 40px;
            margin-bottom: 20px;
        }
    </style>
    <!-- Include Font Awesome for the success icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <h1>Payment Successful</h1>
        <p>Thank you for your purchase.</p>

        <?php
        // Include the database connection file
        include_once('../../inc/conn.php');

        if (isset($_GET['order_id']) && isset($_GET['transaction_id'])) {
            $order_id = $_GET['order_id'];
            $transaction_id = $_GET['transaction_id'];

            // Update the pay_status to 'paid' for the specified order_id
            $sql = "UPDATE `tbl_cost` SET pay_status = 'paid' WHERE order_id = $order_id";

            if ($conn->query($sql) === TRUE) {
                echo "Payment status updated successfully.";
                // Display the success message box
                echo "<script>showSuccessMessage('Payment Successful')</script>";
            } else {
                echo "Error updating payment status: " . $conn->error;
            }
        }
        ?>

        <!-- Add additional details or links as needed -->
    </div>

    <!-- Success message box with image and icon -->
    <div id="success-message" class="message-box">
        <i class="fa fa-check-circle success-icon"></i>
        <p>Payment Successful</p>
    </div>

    <script>
        // Display the success message box
        document.getElementById('success-message').style.display = 'block';

        // Redirect to userProfile.php after 5 seconds
        setTimeout(function() {
            window.location.href = "userProfile.php";
        }, 5000);
    </script>
</body>

</html>
