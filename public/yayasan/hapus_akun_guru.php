<?php
// Include the database configuration
require_once('../../config.php');

// Check if the 'id' parameter is provided in the query string
if (isset($_GET['id'])) {
    // Get the ID of the record to be deleted
    $teacherID = $_GET['id'];

    // Construct the DELETE query
    $delete_query = "DELETE FROM account WHERE guru_detail_id = $teacherID";

    // Execute the DELETE query
    if ($mysqli->query($delete_query)) {
        // Redirect back to the account table page after successful deletion
        header('Location: akun_guru.php');
        exit();
    } else {
        // Handle the case where the deletion fails
        echo "Deletion failed: " . $mysqli->error;
    }
} else {
    // If 'id' parameter is not provided, display an error message
    echo "Invalid request. Missing 'id' parameter.";
}
?>
