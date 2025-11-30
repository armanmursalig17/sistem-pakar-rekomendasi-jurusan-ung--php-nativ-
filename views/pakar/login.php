<?php

require_once '../../config/koneksi.php';
require_once '../../controller/AuthController.php';

$authController = new AuthController($conn);
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $error_message = $authController->login($_POST['username'], $_POST['password']);
    if (empty($error_message)) {
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Pakar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-ung-blue text-white text-center">
                        <h3 class="font-weight-light my-4">Login Pakar</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= $error_message ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Masukkan username" required/>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Masukkan password" required/>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="../../index.php">Kembali ke Beranda</a>
                                <button type="submit" name="login" class="btn btn-ung-blue text-white">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>