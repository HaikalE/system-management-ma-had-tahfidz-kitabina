<?php
    require_once('header.php');
    // Include your database configuration
require_once('../../config.php');
$alertMsg = ""; // Initialize the alert message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
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
        } else{
    // Prepare an SQL INSERT statement
    $sql = "INSERT INTO pesantren (nama, alamat, tanggal_berdiri, no_telepon, email) 
            VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $mysqli->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssss", $nama, $alamat, $tanggal_berdiri, $no_telepon, $email);

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
}

// Close the database connection
$mysqli->close();
?>
<div class="container mt-5">
        <h2>Form Data Pesantren</h2>
        <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="pesantren.php">Pesantren</a></li>
        <li class="breadcrumb-item active">Tambah Pesantren</li>
    </ul>
        <?php echo $alertMsg; // Display the alert message here ?>
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Pesantren</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_berdiri">Tanggal Berdiri</label>
                <input type="date" class="form-control" id="tanggal_berdiri" name="tanggal_berdiri">
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="tel" class="form-control" id="no_telepon" name="no_telepon">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
<?php
    require_once('../footer.php');
?>