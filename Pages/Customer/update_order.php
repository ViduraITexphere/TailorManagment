<?php
session_start();
include('../../inc/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $billing_address = $_POST['billing_address'];
    $mobile = $_POST['mobile'];
    // console log the data
    echo "order_id: " . $order_id . "<br>";
    echo "billing_address: " . $billing_address . "<br>";
    echo "mobile: " . $mobile . "<br>";

    // Update the tbl_cost table
    $sqlUpdate = "UPDATE `tbl_cost` SET billing_address = '$billing_address', mobile = '$mobile' WHERE order_id = $order_id";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
