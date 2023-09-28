<?php
    require_once('header.php');
?>
<div class="container mt-5">
    <h2>Pesantren Data</h2>
    <a href="tambah_pesantren.php" class="btn btn-success mb-3">Tambah Pesantren</a>
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
    <div class="table-responsive"> 
        
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
    <table class="table table-striped">
        <thead>
            <tr>
                <!-- Remove the "ID" column from the visible table header -->
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Berdiri</th>
                <th>No Telepon</th>
                <th>Email</th>
<<<<<<< HEAD
                <th>Action</th>
=======
<<<<<<< HEAD
                <th>Action</th>
=======
                <th>Edit</th>
                <th>Delete</th>
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
            </tr>
        </thead>
        <tbody>
            <?php
            // Include your database configuration
            include('../../config.php');
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
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
<<<<<<< HEAD
                    <a href='hapus_pesantren.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>";
=======
<<<<<<< HEAD
                    <a href='hapus_pesantren.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>";
=======
                    
                </td>";
                echo "<td><a href='hapus_pesantren.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>";
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
                echo "</tr>";
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </tbody>
    </table>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
    </div>
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
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
