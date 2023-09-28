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

    if (empty($Name) || empty($Gender) || empty($id_pesantren)) {
        $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Name, Gender, and Pesantren ID are required fields.</div>';
    } else {
        // Prepare an SQL INSERT statement
        $sql = "INSERT INTO guru_detail (Name, Gender, DateOfBirth, PhoneNumber, Email, SubjectsTaught, id_pesantren) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = $mysqli->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssssi", $Name, $Gender, $DateOfBirth, $PhoneNumber, $Email, $SubjectsTaught, $id_pesantren);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Data was successfully inserted
            $alertMsg = '<div class="alert alert-success mt-3" role="alert">Data has been added successfully.</div>';
        } else {
            // Error occurred during insertion
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Error: ' . $stmt->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Close the database connection
$mysqli->close();
?>

<!-- The rest of your HTML code remains the same -->

<div class="container mt-5">
    <h2>Form Data Guru</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="guru.php">guru</a></li>
        <li class="breadcrumb-item active">Tambah data guru</li>
    </ul>
</div>

<div class="container mt-3">
    <?php echo $alertMsg; // Display the alert message here ?>
    <form method="post">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" name="Name" required>
        </div>
        <div class="form-group">
            <label for="Gender">Gender</label>
            <select class="form-control" id="Gender" name="Gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="DateOfBirth">Date of Birth</label>
            <input type="date" class="form-control" id="DateOfBirth" name="DateOfBirth" required>
        </div>
        <div class="form-group">
            <label for="PhoneNumber">Phone Number</label>
            <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email">
        </div>
        <div class="form-group">
            <label for="SubjectsTaught">Subjects Taught</label>
            <input type="text" class="form-control" id="SubjectsTaught" name="SubjectsTaught">
        </div>
        <div class="form-group">
            <label for="id_pesantren">Pesantren ID</label>
            <select class="form-control" id="id_pesantren" name="id_pesantren" required>
                <option value="" disabled selected>Select Pesantren ID</option>
                <?php
                // Populate the select options with Pesantren IDs
                foreach ($pesantrenOptions as $id => $name) {
                    echo '<option value="' . $id . '">' . $name . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
require_once('../footer.php');
?>
