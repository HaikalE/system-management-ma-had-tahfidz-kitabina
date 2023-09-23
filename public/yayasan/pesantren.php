<?php
    require_once('header.php');
?>
<div class="container mt-5">
    <h2>Pesantren Data</h2>
    <a href="tambah_pesantren.php" class="btn btn-success mb-3">Tambah Pesantren</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <!-- Remove the "ID" column from the visible table header -->
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Berdiri</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include your database configuration
            include('../../config.php');

            // Query to fetch data from the pesantren table
            $sql = "SELECT * FROM pesantren";

            // Execute the query and fetch results
            $result = $mysqli->query($sql);

            // Loop through the results and display data in the table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                // Use a hidden input field to store the ID
                echo "<input type='hidden' name='id' value='{$row['id']}'>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['alamat']}</td>";
                echo "<td>{$row['tanggal_berdiri']}</td>";
                echo "<td>{$row['no_telepon']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>
                    <a href='update_pesantren.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                    <a href='hapus_pesantren.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>";
                echo "</tr>";
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </tbody>
    </table>
</div>
<?php
    require_once('../footer.php');
?>
