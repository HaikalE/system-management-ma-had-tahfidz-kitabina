<?php
require_once('header.php');
// Include your database configuration
require_once('../../config.php');
$alertMsg = ""; // Initialize the alert message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted for editing
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_berdiri = $_POST['tanggal_berdiri'];
        $no_telepon = $_POST['no_telepon'];
        $email = $_POST['email'];

        if (empty($nama) || empty($alamat) || empty($tanggal_berdiri) || empty($no_telepon) || empty($email)) {
            $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Harus mengisi semua data.</div>';
        } else {
            if (!preg_match("/^\d{10,}$/", $no_telepon)) {
                $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Nomor Telepon tidak valid. Harap masukkan minimal 10 digit angka.</div>';
            } else {
                // Prepare an SQL UPDATE statement
                $sql = "UPDATE pesantren SET nama=?, alamat=?, tanggal_berdiri=?, no_telepon=?, email=? WHERE id=?";

                // Create a prepared statement
                $stmt = $mysqli->prepare($sql);

                // Bind parameters to the prepared statement
                $stmt->bind_param("sssssi", $nama, $alamat, $tanggal_berdiri, $no_telepon, $email, $id);

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
        }
    } else {
        $alertMsg = '<div class="alert alert-danger mt-3" role="alert">Invalid request.</div>';
    }
}
?>
<!-- Rest of your code here -->

<div class="container mt-5">
    <h2>Edit Data Pesantren</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="pesantren.php">Pesantren</a></li>
        <li class="breadcrumb-item active">Edit Pesantren</li>
    </ul>
    <?php echo $alertMsg; // Display the alert message here ?>
    <?php
    // Check if an id is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Retrieve the existing data for editing
        $sql = "SELECT * FROM pesantren WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
<<<<<<< HEAD
        $row = $result->fetch_assoc();
=======
<<<<<<< HEAD
        $row = $result->fetch_assoc();
=======

        // Check if any rows were returned
        if ($result->num_rows === 0) {
            echo '<div class="alert alert-danger mt-3" role="alert">ID not found in the table.</div>';
        } else {
            $row = $result->fetch_assoc();
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
    ?>
    <form method="post">
        <!-- Include a hidden input field to pass the ID for editing -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="nama">Nama Pesantren</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $row['alamat']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="tanggal_berdiri">Tanggal Berdiri</label>
            <input type="date" class="form-control" id="tanggal_berdiri" name="tanggal_berdiri" value="<?php echo $row['tanggal_berdiri']; ?>">
        </div>
        <div class="form-group">
            <label for="no_telepon">Nomor Telepon</label>
            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $row['no_telepon']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
        }
        // Close the prepared statement
        $stmt->close();
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Invalid request. Please provide an id.</div>';
    }
    ?>
</div>
<?php
<<<<<<< HEAD
    require_once('../footer.php');
=======
<<<<<<< HEAD
    require_once('../footer.php');
=======
require_once('../footer.php');
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
?>
