<?php
// Include the database configuration and establish a database connection
require_once('../../config.php');
require_once('header.php');
$query = "SELECT id, nama FROM pesantren";
$result = mysqli_query($mysqli, $query);
$alertMsg="";
if (!$result) {
    $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($mysqli) . '</div>';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pesantren_id = $_POST['pesantren_id'];

    // Prepare an SQL statement to insert the data into the "account" table
    $insertQuery = "INSERT INTO account (username, password, pesantren_id,role) VALUES (?, ?, ?,'pesantren')";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($mysqli, $insertQuery)) {
        // Bind the parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ssi", $username, $password, $pesantren_id);

        if (mysqli_stmt_execute($stmt)) {
            // Insertion was successful
            $alertMsg = "<div class='alert alert-success mt-3' role='alert'>Account successfully created</div>";
        } else {
            // Insertion failed
            echo "Error creating account: " . mysqli_error($mysqli);
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($mysqli) . '</div>';
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation failed
        echo "Error preparing statement: " . mysqli_error($mysqli);
    }

    // Close the database connection
    mysqli_close($mysqli);
} 
?>
<div class="container mt-5">
    <h2>Form Akun Pesantren</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="akun_pesantren.php">Akun Pesantren</a></li>
        <li class="breadcrumb-item active">Tambah Akun Pesantren</li>
    </ul>
    <?php echo $alertMsg; // Display the alert message here ?>
    <form method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="pesantren_id">ID Pesantren:</label>
            <select class="form-control" id="pesantren_id" name="pesantren_id" required size="5">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
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
