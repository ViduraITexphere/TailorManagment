<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired location
    header("Location: ../../../index.php"); // Replace "login.php" with the desired destination
    exit();
} else {
    // Redirect to a default page if the user is not logged in (optional)
    header("Location: ../../../index.php"); // Replace "index.php" with the desired destination
    exit();
}
