<?php
require_once('../../config.php');
require_once('header.php');

$alertMsg = ""; // Initialize the alert message

// Check if TeacherID is provided in the URL
if (isset($_GET['id'])) {
    $teacherID = $_GET['id'];

    // Query to retrieve guru's username, password, and pesantren_id based on TeacherID
    $query = "SELECT guru_detail.Name, account.username, account.password, guru_detail.id_pesantren
              FROM guru_detail
              LEFT JOIN account ON guru_detail.TeacherID = account.guru_detail_id
              WHERE guru_detail.TeacherID = $teacherID";

    // Execute the query
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $username = $row['username'];
        $password = $row['password'];
        $pesantrenID = $row['id_pesantren'];
    } else {
        // Handle the case where no guru with the specified ID is found
        $alertMsg = "Guru not found.";
    }
} else {
    // Handle the case where TeacherID is not provided in the URL
    $alertMsg = "TeacherID not provided.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pesantrenID = $_POST['pesantren_id']; // Add this line to get pesantren_id from the form

    // Check if the guru_detail_id exists in the account table
    $check_query = "SELECT guru_detail_id FROM account WHERE guru_detail_id = $teacherID";
    $result = $mysqli->query($check_query);

    if ($result->num_rows > 0) {
        // If the guru_detail_id exists, update the record
        $update_query = "UPDATE account
                         SET username = '$username', password = '$password', pesantren_id = $pesantrenID
                         WHERE guru_detail_id = $teacherID";

        if ($mysqli->query($update_query)) {
            // Redirect back to the account table page after a successful update
            header('Location: akun_guru.php');
            exit();
        } else {
            // Handle the case where the update fails
            $alertMsg = "Update failed: " . $mysqli->error;
        }
    } else {
        // If the guru_detail_id does not exist, insert a new record
        $insert_query = "INSERT INTO account (guru_detail_id, username, password, role, pesantren_id)
                         VALUES ($teacherID, '$username', '$password', 'guru', $pesantrenID)";

        if ($mysqli->query($insert_query)) {
            // Redirect back to the account table page after a successful insert
            header('Location: akun_guru.php');
            exit();
        } else {
            // Handle the case where the insertion fails
            $alertMsg = "Insertion failed: " . $mysqli->error;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Edit Guru</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="akun_guru.php">Akun guru</a></li>
        <li class="breadcrumb-item active">Edit akun guru</li>
    </ul>   
    <!-- Display the alert message -->
    <?php if (!empty($alertMsg)) : ?>
        <div class="alert alert-danger mt-3" role="alert"><?php echo $alertMsg; ?></div>
    <?php else : ?>

        <?php if (isset($name)) : ?>

            <form method="POST">
                <input type="hidden" name="teacherID" value="<?php echo $teacherID; ?>">
                <input type="hidden" name="pesantren_id" value="<?php echo $pesantrenID; ?>"> <!-- Hidden pesantren_id field -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>

        <?php endif; ?>

    <?php endif; ?>
</div>


<?php
require_once('../footer.php');
?>
