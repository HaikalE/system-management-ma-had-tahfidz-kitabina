<?php
// Include the head.php file
require_once('../head.php');
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to the login page with an error message
    header("Location: ../login.php?error=1");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php"><img src="../assets/images/logo.jpg" alt="Logo" width="50" height="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pesantren.php">Pesantren</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="akun_pesantren.php">Akun Pesantren</a>
        </li>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
        <li class="nav-item">
          <a class="nav-link" href="guru.php">Guru</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="akun_guru.php">Akun Guru</a>
        </li>
>>>>>>> 6e25d9b (Add system-management-ma-had-tahfidz-kitabina submodule)
>>>>>>> be62ca8 (Your commit message here)
      </ul>
      <span class="navbar-text">
        <a class="nav-link" href="logout.php">Logout</a>
      </span>
    </div>
  </div>
</nav>