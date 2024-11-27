<?php
function customLog($message) {
    $logFilePath = '../logs/custom-log.txt';  // Make sure the 'logs' directory is writable
    $timeStamp = date('Y-m-d H:i:s');         // Add a timestamp to each log
    $logMessage = "[" . $timeStamp . "] " . $message . PHP_EOL;
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);  // Append the log
}
?>

