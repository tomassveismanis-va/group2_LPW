<?php
// Start session so it can be accessed
session_start();
// Clear all session variables
session_unset();
// Destroy the session completely
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit();
?>