<?php
require_once '../../config/koneksi.php';
require_once '../../controller/AuthController.php';
AuthController::checkAuth(); 
?>
<!doctype html>
<html lang="id">
<head>
    <title>Dashboard Pakar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>  </style>
</head>
<body>
<nav class="navbar navbar-dark bg-ung-blue fixed-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Dashboard Pakar</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Sign out (<?= $_SESSION['pakar_username'] ?>)</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
       <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_fakta.php">Manajemen Fakta</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_jurusan.php">Manajemen Jurusan</a></li>
                        <li class="nav-item"><a class="nav-link " href="manage_rules.php">Manajemen Aturan</a></li>
                    </ul>
                </div>
            </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="jumbotron">
                <h1 class="display-4">Selamat Datang, Pakar!</h1>
                <p class="lead">Anda telah masuk ke panel administrasi sistem pakar rekomendasi jurusan UNG. Silakan kelola data Jurusan, Fakta, dan Aturan (Rule) untuk meningkatkan akurasi sistem Forward Chaining.</p>
                <hr class="my-4">
                <p>Gunakan menu di samping kiri untuk navigasi.</p>
            </div>
        </main>
    </div>
</div>
</body>
</html>