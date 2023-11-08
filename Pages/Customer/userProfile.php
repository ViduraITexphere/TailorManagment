<?php
include_once('../../components/Header/header.php');
// Check if the user is logged in
if (isset($_SESSION['user_email']) && isset($_SESSION['user_type'])) {
    $userEmail = $_SESSION['user_email'];
    $userType = $_SESSION['user_type'];
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];
} else {
    // User is not logged in, handle accordingly
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tailor</title>
    <!-- sometimes css doesnt work here -->
    <link rel="stylesheet" href="tailorProfile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        /* //////////////////////You can edit this ////////////////////// */

        .row1 {
            display: flex;
            flex-direction: row;

        }

        .left {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 30%;
            background-color: #f1f1f1;
            height: calc(100vh - 60px);
        }

        .right {
            width: 70%;
            padding: 30px;
        }

        .content {
            padding: 20px 40px;
            display: flex;
        }

        .wrapper {
            display: flex;
            flex-direction: row;
        }

        .heading {
            font-weight: 600;
            margin: 20px 40px;
        }

        .btn {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container_main">
        <div class="wrapper">
            <div class="left">

                <h4><?php echo $userName ?></h4>
                <p><?php echo $userEmail ?></p>
                <div class="buttons">
                    <button class="btn"><i class="fa fa-plus"></i> Follow</button>
                    <button class="btn"><i class="fa fa-comment"></i> Message</button>
                </div>
            </div>

            <div class="right">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Tailor ID</th>
                            <th scope="col">Approved Date</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once('../../inc/conn.php');

                        if (isset($userId)) {
                            $sql = "SELECT * FROM `tbl_cost` WHERE cus_id = '$userId'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                        ?>
                                    <tr class="order-row" onclick="redirectToTrackOrder(<?php echo $row['order_id'] ?>)">
                                        <td><?php echo $row['order_id'] ?></td>
                                        <td><?php echo $row['cus_id'] ?></td>
                                        <td><?php echo $row['tailor_id'] ?></td>
                                        <td><?php echo $row['orderrequest_date'] ?></td>
                                        <td><?php echo $row['cost'] ?></td>
                                        <!-- need a button to approve the order -->
                                        <td>
                                            <?php
                                            if ($row['pay_status'] == 'paid') {
                                                // If pay_status is 'paid', display a disabled "Paid" button
                                                echo '<button class="btn btn-success" disabled style="background-color: red;">Paid</button>';
                                            } else {
                                                // If pay_status is not 'paid', show the "Checkout" button
                                                echo '<a href="checkout.php?order_id=' . $row['order_id'] . '" class="btn btn-success">Checkout</a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                // Handle query execution errors
                                echo "Query execution failed: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Database connection failed: " . mysqli_connect_error();
                        }
                        ?>
                    </tbody>
                    </table>
                    <?php
                    include_once('trackOrder.php');
                    ?>
            </div>
        </div>
    </div>
    <script>
function redirectToTrackOrder(orderId) {
    // Redirect to trackOrder.php with the order_id as a query parameter
    window.location.href = 'userprofile.php?order_id=' + orderId;
    
}
</script>

</body>

</html>