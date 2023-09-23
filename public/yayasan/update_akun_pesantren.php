<?php
// Include the database configuration and establish a database connection
require_once('../../config.php');
require_once('header.php');

$alertMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pesantren_id = $_POST['pesantren_id'];

    // Prepare an SQL statement to update the data in the "account" table
    $updateQuery = "UPDATE account SET password=?, pesantren_id=? WHERE username=?";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($mysqli, $updateQuery)) {
        // Bind the parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "sis", $password, $pesantren_id, $username);

        if (mysqli_stmt_execute($stmt)) {
            // Update was successful
            $alertMsg = "<div class='alert alert-success mt-3' role='alert'>Account successfully updated</div>";
        } else {
            // Update failed
            echo "Error updating account: " . mysqli_error($mysqli);
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($mysqli) . '</div>';
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation failed
        echo "Error preparing statement: " . mysqli_error($mysqli);
    }
}

// Retrieve the account data based on the provided username
$username = $_GET['username'];
$query = "SELECT * FROM account WHERE username = ?";
if ($stmt = mysqli_prepare($mysqli, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $accountData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($mysqli);
}
?>

<div class="container mt-5">
    <h2>Edit Akun Pesantren</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="akun_pesantren.php">Akun Pesantren</a></li>
        <li class="breadcrumb-item active">Edit Akun Pesantren</li>
    </ul>
    <?php echo $alertMsg; // Display the alert message here ?>
    <form method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $accountData['username']; ?>" >
        </div>
        <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" value="<?php echo $accountData['password']; ?>" required>
</div>

        <div class="form-group">
            <label for="pesantren_id">ID Pesantren:</label>
            <select class="form-control" id="pesantren_id" name="pesantren_id" required>
                <?php
                // Populate the dropdown with pesantren data
                $query = "SELECT id, nama FROM pesantren";
                $result = mysqli_query($mysqli, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($row['id'] == $accountData['pesantren_id']) ? "selected" : "";
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nama'] . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php
require_once('../footer.php');
?>
