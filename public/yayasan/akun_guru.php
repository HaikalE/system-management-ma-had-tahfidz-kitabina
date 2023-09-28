<?php
// Include the database configuration
require_once('../../config.php');

// Include the header.php file
require_once('header.php');
?>

<div class="container mt-5">
    <h2>Account Table</h2>
    <form class="form-inline mb-3">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search">
        </div>
        <button type="button" class="btn btn-primary" id="searchButton">Search</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Pesantren Name</th> <!-- Change the header to "Pesantren Name" -->
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to retrieve data from the guru_detail, account, and pesantren tables
            $query = "SELECT guru_detail.Name, account.username, account.password, pesantren.nama AS pesantren_name, guru_detail.TeacherID
                      FROM guru_detail
                      LEFT JOIN account ON guru_detail.TeacherID = account.guru_detail_id
                      LEFT JOIN pesantren ON guru_detail.id_pesantren = pesantren.id";

            // Execute the query
            $result = $mysqli->query($query);

            // Check if there are any results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Name'] . "</td>"; // Display the "Name" column
                    if ($row['username']!=""&&$row['password']!="") {
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                    } else {
                        echo "<td class='text-danger'>Tidak ada</td>";
                        echo "<td class='text-danger'>Tidak ada</td>";
                    }
                    echo "<td>" . $row['pesantren_name'] . "</td>"; // Display the "nama" from the "pesantren" table
                    echo "<td>";
                    // Add the EDIT and DELETE buttons with Bootstrap classes
                    echo "<a href='update_akun_guru.php?id=" . $row['TeacherID'] . "' class='btn btn-primary'>Edit</a>";
                    echo "<td><a href='hapus_akun_guru.php?id=" . $row['TeacherID'] . "' class='btn btn-danger'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
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