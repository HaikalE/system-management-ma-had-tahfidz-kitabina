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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
    <form class="form-inline mb-3">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search">
        </div>
        <button type="button" class="btn btn-primary" id="searchButton">Search</button>
    </form>
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<script>
    document.getElementById("searchButton").addEventListener("click", function () {
        // Get the search input value
        var searchInput = document.getElementById("searchInput").value.toLowerCase();
        
        // Get all table rows
        var tableRows = document.querySelectorAll("tbody tr");

        // Loop through each table row and check if it contains the search input
        tableRows.forEach(function (row) {
            var rowData = row.textContent.toLowerCase();
            if (rowData.includes(searchInput)) {
                row.style.display = "table-row"; // Show the row if it matches the search
            } else {
                row.style.display = "none"; // Hide the row if it doesn't match the search
            }
        });
    });
</script>
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
