<?php
// Include the database configuration and establish a database connection
require_once('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
    // Retrieve the username from the URL
    $username = $_GET['username'];

    // Prepare an SQL statement to delete the account based on username
    $deleteQuery = "DELETE FROM account WHERE username = ?";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($mysqli, $deleteQuery)) {
        // Bind the parameter and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            // Deletion was successful
            //echo "Account with username '$username' has been deleted successfully.";
            header("Location: akun_pesantren.php");
        } else {
            // Deletion failed
            echo "Error deleting account: " . mysqli_error($mysqli);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation failed
        echo "Error preparing statement: " . mysqli_error($mysqli);
    }

    // Close the database connection
    mysqli_close($mysqli);
} else {
    echo "Invalid request.";
}
?>
