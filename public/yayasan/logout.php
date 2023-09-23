<?php
session_start();

// Check if the user is logged in and has a 'username' session variable
if (isset($_SESSION['username'])) {
    // Unset or destroy the 'username' session variable
    unset($_SESSION['username']);
    header("Location: ../login.php");
}

// Destroy the entire session
session_destroy();
?>