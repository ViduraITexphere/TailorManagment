<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Progress</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            margin : 0;
            padding: 0;
        }
        .progress {
            height: 40px;
        }
        .progress-bar {
            background-color: #0d6efd;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Order Progress</h1>
        <!-- Create a Bootstrap progress bar -->
        <div class="progress">
            <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Step 0: Processing</div>
        </div>
        <p class="mt-2" id="status-text">Order Processing</p>
    </div>
    <!-- Include Bootstrap JS for the progress bar functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-Pzjw7bgiDM8GA36F5xjty7PPpRz78M/xJw8fQqcOjVRb/VyUMFqSg3LSdHkr4d0E" crossorigin="anonymous"></script>
    
    <?php
    try {
        include_once('../../inc/conn.php');
    
        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $sql = "SELECT order_status FROM `tbl_cost` WHERE order_id = $order_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $status = $row['order_status'];
            
            // Pass the order_id from PHP to JavaScript
            echo "<script>const order_id = $order_id;</script>";
            
            // Wrap the JavaScript code in a DOMContentLoaded event listener
            echo "<script>document.addEventListener('DOMContentLoaded', function() { updateProgress('$status'); });</script>";
            // save ststus globally
            
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    
    <script>
        function calculateProgress(status) {
            switch (status) {
                case 'Pending':
                    return 0; // 10%
                case 'Sewing':
                    return 25; // 25%
                case 'Processing':
                    return 50; // 50%
                case 'Shipped':
                    return 70; // 70%
                case 'Delivered':
                    return 100; // 100%
                default:
                    return 0; // 0%
            }
        }

        // Update progress bar width and status text
        function updateProgress(status) {
            const newProgress = calculateProgress(status);
            const statusText = `Step ${newProgress}%: ${status}`;

            // Update the progress bar and status text
            document.getElementById('progress-bar').style.width = newProgress + '%';
            document.getElementById('status-text').textContent = statusText;
        }
    </script>
</body>
</html>
