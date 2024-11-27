<?php
include "../shared/common.php";
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: ../index.php");
exit();
?>
