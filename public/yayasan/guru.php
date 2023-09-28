<?php
    require_once('header.php');
?>
<div class="container mt-5">
    <h2>Guru Pesantren Data</h2>
    <a href="tambah_guru.php" class="btn btn-success mb-3">Tambah Guru Pesantren</a>
    <form class="form-inline mb-3">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search">
        </div>
        <button type="button" class="btn btn-primary" id="searchButton">Search</button>
    </form>
    <div class="table-responsive"> 
        
    <table class="table table-striped">
        <thead>
            <tr>
                <!-- Adjust the table headers to match the Guru Pesantren data -->
                <th>Nama</th>
                <th>Gender</th>
                <th>Tanggal Lahir</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Mata Pelajaran</th>
                <th>Pesantren</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include your database configuration
            include('../../config.php');
            
            // Query to fetch data from the Guru Pesantren table (adjust the table name)
            $sql = "SELECT * FROM guru_detail";

            // Execute the query and fetch results
            $result = $mysqli->query($sql);

            // Loop through the results and display data in the table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                // Use a hidden input field to store the ID
                echo "<input type='hidden' name='id' value='{$row['TeacherID']}'>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Gender']}</td>";
                echo "<td>{$row['DateOfBirth']}</td>";
                echo "<td>{$row['PhoneNumber']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['SubjectsTaught']}</td>";
                echo "<td>{$row['id_pesantren']}</td>";
                echo "<td>
                    <a href='update_guru.php?id={$row['TeacherID']}' class='btn btn-primary'>Edit</a>
                </td>";
                echo "<td><a href='hapus_guru_detail.php?id={$row['TeacherID']}' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </tbody>
    </table>
    </div>
</div>
<?php
    require_once('../footer.php');
?>
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
