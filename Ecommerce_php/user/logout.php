<?php
// Start the session
session_start();

// If the user is logged in, destroy the session and redirect to the homepage
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}

// Redirect to the homepage
header("Location: ../index.php");
exit();
?>
