<?php
// Include the head.php file
require_once('header.php');
// Include your database configuration
require_once('../../config.php');
$alertMsg = ""; // Initialize the alert message

// Fetch Pesantren IDs and Names from the database
$pesantrenOptions = [];
$query = "SELECT id, nama FROM pesantren";
$result = $mysqli->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pesantrenOptions[$row['id']] = $row['nama'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $Name = $_POST['Name'];
    $Gender = $_POST['Gender'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Email = $_POST['Email'];
    $SubjectsTaught = $_POST['SubjectsTaught'];
    $id_pesantren = $_POST['id_pesantren'];
    $guru_id = $_POST['guru_id'];

    if (empty($Name) || empty($Gender) || empty($id_pesantren)) {
        $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Name, Gender, and Pesantren ID are required fields.</div>';
    } else {
        // Prepare an SQL UPDATE statement
        $sql = "UPDATE guru_detail SET Name=?, Gender=?, DateOfBirth=?, PhoneNumber=?, Email=?, SubjectsTaught=?, id_pesantren=? WHERE TeacherID=?";

        // Create a prepared statement
        $stmt = $mysqli->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssssii", $Name, $Gender, $DateOfBirth, $PhoneNumber, $Email, $SubjectsTaught, $id_pesantren, $guru_id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Data was successfully updated
            $alertMsg = '<div class="alert alert-success mt-3" role="alert">Data has been updated successfully.</div>';
        } else {
            // Error occurred during update
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error: ' . $stmt->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }
} else {
    // Check if a guru ID parameter is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Retrieve the guru data based on the provided ID
        $guru_id = $_GET['id'];
        $query = "SELECT * FROM guru_detail WHERE TeacherID=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $guru_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $guru_data = $result->fetch_assoc();
                
                // Display the form when guru data is found
                $displayForm = true;
            } else {
                $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Guru not found.</div>';
            }
        } else {
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error fetching guru data: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } else {
        $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Invalid guru ID.</div>';
    }
}

// Close the database connection
$mysqli->close();
?>

<!-- The rest of your HTML code remains the same -->

<div class="container mt-5">
    <h2>Update Guru Data</h2>
    
<ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="akun_pesantren.php">Guru</a></li>
        <li class="breadcrumb-item active">Edit data guru</li>
    </ul>
</div>
<div class="container mt-3">
<?php echo $alertMsg; ?>
    <?php if (isset($guru_data)): ?>
    <form method="post">
        <input type="hidden" name="guru_id" value="<?php echo $guru_data['TeacherID']; ?>">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $guru_data['Name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Gender">Gender</label>
            <select class="form-control" id="Gender" name="Gender" required>
                <option value="Male" <?php if ($guru_data['Gender'] === 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($guru_data['Gender'] === 'Female') echo 'selected'; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="DateOfBirth">Date of Birth</label>
            <input type="date" class="form-control" id="DateOfBirth" name="DateOfBirth" value="<?php echo $guru_data['DateOfBirth']; ?>" required>
        </div>
        <div class="form-group">
            <label for="PhoneNumber">Phone Number</label>
            <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo $guru_data['PhoneNumber']; ?>">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $guru_data['Email']; ?>">
        </div>
        <div class="form-group">
            <label for="SubjectsTaught">Subjects Taught</label>
            <input type="text" class="form-control" id="SubjectsTaught" name="SubjectsTaught" value="<?php echo $guru_data['SubjectsTaught']; ?>">
        </div>
        <div class="form-group">
            <label for="id_pesantren">Pesantren ID</label>
            <select class="form-control" id="id_pesantren" name="id_pesantren" required>
                <option value="" disabled>Select Pesantren ID</option>
                <?php
                // Populate the select options with Pesantren IDs
                foreach ($pesantrenOptions as $id => $name) {
                    $selected = ($id == $guru_data['id_pesantren']) ? 'selected' : '';
                    echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php endif; ?>
</div>

<?php
require_once('../footer.php');
?>
