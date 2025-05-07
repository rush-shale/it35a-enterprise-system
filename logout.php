<?php
session_start();
session_unset();   // Unset all session variables
session_destroy(); // Destroy the session

// Optional: delay redirect with message
header("Location: login.php");
exit;
?>
