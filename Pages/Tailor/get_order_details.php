<?php
include_once('../../inc/conn.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Query the database to fetch order details for the specified order
    $query = "SELECT order_id, cus_id, tailor_id, category, order_date FROM tbl_order WHERE order_id = $order_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(['error' => 'Database query failed']);
    }

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No order details found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
