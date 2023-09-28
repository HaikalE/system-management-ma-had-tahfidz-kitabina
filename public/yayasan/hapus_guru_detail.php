<?php
// Include your database configuration
include('../../config.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the 'id' parameter to prevent SQL injection
    $teacherId = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Write the SQL query to delete the record
    $sql = "DELETE FROM guru_detail WHERE TeacherID = $teacherId";

    // Execute the query
    if ($mysqli->query($sql)) {
        // Deletion was successful, redirect to the page that lists Guru Pesantren data
        header("Location: guru.php");
        exit();
    } else {
        // Handle any errors if the deletion fails
        echo "Error deleting record: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
