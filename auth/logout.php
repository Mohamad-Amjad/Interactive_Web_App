<?php
require_once '../includes/functions.php';

// Destroy the entire session data
session_unset();
session_destroy();

// Redirect back to home
header("Location: ../index.php");
exit();
?>
