<?php
// Include the config.php file to establish a database connection
require_once('../config.php');

// Initialize an error message variable
$errorMsg = isset($_GET['error']) ? $_GET['error'] : '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform a query to check the username and password in the 'account' table
    $query = "SELECT * FROM account WHERE username = ? AND password = ?";
    
    // Prepare the query
    $stmt = $mysqli->prepare($query);
    
    // Bind parameters
    $stmt->bind_param("ss", $username, $password);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        session_start(); // Start a session
        $_SESSION['username'] = $username; // Set the username in the session
        // User is authenticated, redirect to a success page or perform further actions
        header("Location: yayasan/dashboard.php"); // Replace 'success.php' with the actual success page
        exit();
    } else {
        // Authentication failed, set an error message
        $errorMsg = "Authentication failed. Please try again.";
    }
    
    // Close the database connection
    $stmt->close();
}
?>

<?php
// Include the head.php file
require_once('head.php');
?>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <form method="post">
        <!-- ... Your form content ... -->
        <div class="mb-3">
            <div class="text-center mb-4">
                <img src="assets/images/logo.jpg" alt="Logo" width="100" height="100">
                <!-- Display error message if authentication fails -->
        <?php if (!empty($errorMsg)):?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $errorMsg==1?'Login dulu sebelum kehalaman tersebut':$errorMsg; ?>
            </div>
        <?php endif; ?>
            </div>
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        
        
    </form>
</div>

<?php
// Include the footer.php file
require_once('footer.php');
?>
