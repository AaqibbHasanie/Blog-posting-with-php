<?php
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: Aaqib_task1.php");
exit;
?>
