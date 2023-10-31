<?php
include_once('../../inc/conn.php');

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Query the database to get measurements for the selected category
    $sql = "SELECT measure FROM categories WHERE category = '$category'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $measurements = $row['measure'];

        // Convert the measurements string to an array
        $measurementsArray = explode(', ', $measurements);

        echo json_encode($measurementsArray);
    } else {
        echo json_encode([]); // Return an empty array if no measurements were found for the category
    }
} else {
    echo json_encode([]); // Return an empty array if no category is provided
}
