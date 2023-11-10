<?php
// getTailorDetails.php

include_once('../../inc/conn.php');

if (isset($_POST['tailorId'])) {
    $tailorId = $_POST['tailorId'];
    // Use the tailorId to fetch details from the database
    $sql = "SELECT * FROM tailors WHERE id = $tailorId";
    $result = mysqli_query($conn, $sql);
    $tailorDetails = mysqli_fetch_assoc($result);

    // Return tailor details as JSON
    echo json_encode($tailorDetails);
}
?>
