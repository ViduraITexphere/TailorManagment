<?php
// updateTailor.php

include_once('../../inc/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $tailorId = $_POST['tailorId'];
    $name = $_POST['name'];
    $experience = $_POST['experience'];
    $reviews = $_POST['reviews'];
    $categories = $_POST['categories'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // Set user type to "tailor"
    $userType = "tailor";

    // Check if a new image is uploaded
    if (!empty($_FILES["image"]["name"])) {
        // Handle file upload
        $targetDir = "../../Assets/Images/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, update the database with the new file path
            $imagePath = $targetFile;
        } else {
            echo "Error uploading file.";
            exit(); // Stop execution if file upload fails
        }
    } else {
        // No new image uploaded, use the current image path
        $imagePath = $_POST['currentImage'];
    }

    // Update the database
    $sql = "UPDATE tailors SET name='$name', experience='$experience', reviews='$reviews', image='$imagePath', categories='$categories', username='$username', password='$password', email='$email', user_type='$userType' WHERE id=$tailorId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Tailor updated successfully!";
    } else {
        echo "Error updating tailor: " . mysqli_error($conn);
    }
}
?>
