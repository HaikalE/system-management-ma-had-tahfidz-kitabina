<?php
// Database configuration
$hostname = 'localhost'; // Replace with your database host name or IP address
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'pesantren'; // Replace with your database name

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
