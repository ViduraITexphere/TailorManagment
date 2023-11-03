<?php
include_once('../../inc/conn.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Construct your SQL query to select non-null values
    $query = "SELECT * FROM tbl_order WHERE order_id = $order_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Database query error: " . mysqli_error($conn);
    } else {
        $data = mysqli_fetch_assoc($result);

        // Create an array to store non-null values
        $nonNullData = array();

        // Iterate through the columns and add non-null values to the array
        foreach ($data as $column => $value) {
            if ($value !== null) {
                $nonNullData[$column] = $value;
            }
        }

        echo json_encode($nonNullData);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
