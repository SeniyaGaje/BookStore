<?php
session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set session lifetime (15 minutes)
$sessionLifetime = 15 * 60; // 15 minutes in seconds

// Check if session variable 'LAST_ACTIVITY' is set
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calculate session duration
    if (time() - $_SESSION['LAST_ACTIVITY'] > $sessionLifetime) {
        // Last activity was more than 15 minutes ago, destroy the session
        session_unset(); // Remove all session variables
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to the login page
        exit();
    }
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp
?>
