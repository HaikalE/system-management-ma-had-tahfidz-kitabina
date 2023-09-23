<?php
// Include your database configuration
include('../../config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the input to prevent SQL injection (use mysqli_real_escape_string or prepared statements for production)
    $id = $_GET['id'];

    // SQL query to delete a record with a specific ID
    $sql = "DELETE FROM pesantren WHERE id = $id";

    // Execute the delete query
    if ($mysqli->query($sql) === TRUE) {
        echo "Record with ID $id has been deleted successfully.";
        header("Location: pesantren.php");
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Invalid or missing ID parameter.";
}

// Close the database connection
$mysqli->close();
?>
