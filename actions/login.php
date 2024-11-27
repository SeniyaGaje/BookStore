<?php

// Set the time zone
date_default_timezone_set('Asia/Colombo');

// Custom logging function
function customLog($message) {
    $logFilePath = '../logs/custom-log.txt';  // Make sure the 'logs' directory is writable
    $timeStamp = date('Y-m-d H:i:s');         // Add a timestamp to each log
    $logMessage = "[" . $timeStamp . "] " . $message . PHP_EOL;
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);  // Append the log
}

// Error logging setup
error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', '../logs/php_errors.log'); // Set the path for error logs

// Check if the form was submitted
if (!isset($_POST['submit'])) {
    customLog("Direct access attempt to login.php");
    die("You can't directly access this file");
}

include "../shared/DBconnection.php";
include "../shared/common.php";

$email = $_POST["login-email"];
$password = $_POST["login-pass"];
customLog("Login attempt for email: $email");

// Anti-brute-force setup
$max_failed_attempts = 5;
$lockout_duration = 15 * 60; // 15 minutes

// Fetch user data using prepared statement
$query = "SELECT * FROM users WHERE userEmail = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $hashedPassword = $user['userPass'];
    $failed_attempts = $user['failed_attempts'];
    $last_failed_attempt = strtotime($user['last_failed_attempt']);
    $current_time = time();

    // Check if the account is currently locked
    if ($failed_attempts >= $max_failed_attempts && ($current_time - $last_failed_attempt) < $lockout_duration) {
        $remaining_lock_time = ($lockout_duration - ($current_time - $last_failed_attempt)) / 60;
        customLog("Account locked for email: $email. Try again after " . round($remaining_lock_time) . " minutes.");
        echo "<h1>Your account is locked. Please try again after " . round($remaining_lock_time) . " minutes.</h1> <a href='../index.php'>Click</a> to redirect to homepage";
    } else {
        // If the password is correct
        if (password_verify($password, $hashedPassword)) {
            // Reset failed attempts on successful login
            $reset_query = "UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE userEmail = ?";
            $reset_stmt = $connection->prepare($reset_query);
            $reset_stmt->bind_param("s", $email);
            $reset_stmt->execute();

            session_start();
            $_SESSION["logged"] = $email;
            customLog("Successful login for email: $email.");
            header("Location: ../index.php");
            exit(); // Ensure no further code is executed
        } else {
            // Update failed attempts and last failed attempt time
            $update_failed_attempts_query = "UPDATE users SET failed_attempts = failed_attempts + 1, last_failed_attempt = NOW() WHERE userEmail = ?";
            $update_stmt = $connection->prepare($update_failed_attempts_query);
            $update_stmt->bind_param("s", $email);
            $update_stmt->execute();

            // Check if the user has reached the max failed attempts
            if ($failed_attempts + 1 >= $max_failed_attempts) {
                customLog("Too many failed login attempts for email: $email. Account locked for 15 minutes.");
                echo "<h1>Too many failed login attempts. Your account is locked for 15 minutes.</h1> <a href='../index.php'>Click</a> to redirect to homepage";
            } else {
                $remaining_attempts = $max_failed_attempts - ($failed_attempts + 1);
                customLog("Invalid login attempt for email: $email. Remaining attempts: $remaining_attempts.");
                echo "<h1>Invalid credentials. You have $remaining_attempts attempts remaining.</h1> <a href='../index.php'>Click</a> to redirect to homepage";
            }
        }
    }
} else {
    customLog("User not found: $email.");
    echo "<h1>User not found.</h1> <a href='../index.php'>Click</a> to redirect to homepage";
}

$connection->close();
?>