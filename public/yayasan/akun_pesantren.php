<?php
// Include the database configuration and establish a database connection
require_once('../../config.php');
require_once('header.php');

// Assuming you have already established a database connection, you can run a query
// to fetch the data from the 'account' table where the 'role' is 'pesantren'.
$query = "SELECT account.username, account.password, pesantren.nama AS nama_pesantren
          FROM account
          LEFT JOIN pesantren ON account.pesantren_id = pesantren.id
          WHERE account.role = 'pesantren'";
$result = mysqli_query($mysqli, $query);

?>

<div class="container mt-5">
    <h2>Form Akun Pesantren</h2>
    <a href="tambah_akun_pesantren.php" class="btn btn-success mb-3">Tambah Akun</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama pesantren</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['nama_pesantren'] . '</td>';
                    echo "<td>
                    <a href='update_akun_pesantren.php?username={$row['username']}' class='btn btn-primary'>Edit</a>
                    </td><td>
                    <a href='hapus_akun_pesantren.php?username={$row['username']}' class='btn btn-danger'>Delete</a>
                </td>";
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once('../footer.php');
?>
