<?php
// Include your database connection code if needed
include_once('../../inc/conn.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID and new order status from the POST data
    $order_id = $_POST['order_id'];
    $new_status = $_POST['order_status'];

    // Update the order status in the database
    $sql = "UPDATE `tbl_cost` SET `order_status` = '$new_status' WHERE `order_id` = '$order_id'";
    $result = $conn->query($sql);

    // Check if the query was executed successfully
    if ($result) {
        // If the query was executed successfully, redirect the user to the trackOrder.php page
        header('Location: trackOrder.php');
    } else {
        // If the query was not executed successfully, display an error message
        echo "Query execution failed: " . mysqli_error($conn);
    }
}
?>