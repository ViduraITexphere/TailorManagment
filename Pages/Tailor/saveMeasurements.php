<?php
include_once('../../inc/conn.php');

if (isset($_POST['tailorId']) && isset($_POST['userId']) && isset($_POST['measurements'])) {
    $tailorId = $_POST['tailorId'];
    $userId = $_POST['userId'];
    $category = $_POST['category'];
    $measurements = json_decode($_POST['measurements'], true);

    // Create placeholders for measurements in the SQL query
    $measurementFields = implode(', ', array_map(function ($measurement) {
        return "`$measurement`";
    }, array_keys($measurements)));

    $measurementValues = "'" . implode("', '", array_map(function ($measurement) use ($conn) {
        return mysqli_real_escape_string($conn, $measurement);
    }, $measurements)) . "'";

    // Create the order_date
    $orderDate = date('Y-m-d'); // Assuming you want to save the current date, you can change this to your specific date format if needed

    // Insert the data into your MySQL database
    $sql = "INSERT INTO tbl_order (tailor_id, cus_id, order_date, category, $measurementFields)
            VALUES ($tailorId, $userId, '$orderDate', '$category', $measurementValues)";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
