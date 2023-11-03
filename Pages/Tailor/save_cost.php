<?php
include_once('../../inc/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['cost'])) {
    $order_id = $_POST['order_id'];
    $cost = $_POST['cost'];
    $tailor_id = $_POST['tailor_id'];
    $cus_id = $_POST['cus_id'];

    // You can validate and sanitize the input here if needed

    // Insert the cost into the database
    $query = "INSERT INTO tbl_cost (order_id, cost, cus_id, tailor_id, orderrequest_date) VALUES ('$order_id', '$cost', $tailor_id, $cus_id, NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to save the cost']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
