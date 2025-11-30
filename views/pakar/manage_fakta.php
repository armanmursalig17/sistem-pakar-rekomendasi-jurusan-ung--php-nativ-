<?php

require_once '../../config/koneksi.php';
require_once '../../controller/AuthController.php';
AuthController::checkAuth(); 

$message = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_fakta'])) {
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    
    
    $q_last = $conn->query("SELECT kode_fakta FROM fakta ORDER BY LENGTH(kode_fakta) DESC, kode_fakta DESC LIMIT 1");
    
    if ($q_last->num_rows > 0) {
        $last_data = $q_last->fetch_assoc();
      
        $last_number = (int)substr($last_data['kode_fakta'], 1);
        $next_number = $last_number + 1;
    } else {
       
        $next_number = 1;
    }
    
    
    $kode_baru = 'F' . $next_number;

   
    $sql = "INSERT INTO fakta (kode_fakta, deskripsi, jenis_input) VALUES ('$kode_baru', '$deskripsi', NULL)";
    
    if ($conn->query($sql)) {
        $message = "Fakta baru berhasil ditambahkan! Kode Otomatis: **$kode_baru**";
    } else {
        $error = "Gagal menambah fakta: " . $conn->error;
    }
}


if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $kode_delete = $conn->real_escape_string($_GET['delete']);
    
    
    $sql_delete = "DELETE FROM fakta WHERE kode_fakta = '$kode_delete'";
    if ($conn->query($sql_delete)) {
        $message = "Fakta dengan kode **$kode_delete** berhasil dihapus.";
    
        header("Location: manage_fakta.php"); 
        exit;
    } else {
        $error = "Gagal menghapus fakta: " . $conn->error;
    }
}


$fakta_res = $conn->query("SELECT * FROM fakta ORDER BY LENGTH(kode_fakta) ASC, kode_fakta ASC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manajemen Fakta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include '../partials/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">
           <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link active" href="manage_fakta.php">Manajemen Fakta</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_jurusan.php">Manajemen Jurusan</a></li>
                        <li class="nav-item"><a class="nav-link " href="manage_rules.php">Manajemen Aturan</a></li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manajemen Fakta (Kondisi/Pertanyaan)</h1>
                </div>

                <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

                <div class="card mb-4 shadow-sm">
                    <h5 class="card-header bg-info text-white">Tambah Fakta/Kondisi Baru</h5>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-row">
                                <div class="col-md-10 mb-3">
                                    <label for="deskripsi">Deskripsi Fakta (Pertanyaan)</label>
                                    <small class="text-muted">Kode Fakta akan dibuat otomatis oleh sistem (misal: F1, F2, dst).</small>
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Contoh: Apakah Anda tertarik pada bidang kedirgantaraan?" required>
                                    
                                </div>
                                
                                <div class="col-md-2 mb-3 align-self-center">
                                    <label class="d-none d-md-block">&nbsp;</label> <button class="btn btn-primary btn-block" type="submit" name="add_fakta">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h3 class="mt-4">Daftar Fakta Tersedia (Total: <?= $fakta_res->num_rows ?>)</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 10%;">Kode</th>
                                <th style="width: 80%;">Deskripsi</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($f = $fakta_res->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center font-weight-bold"><?= htmlspecialchars($f['kode_fakta']) ?></td>
                                    <td><?= htmlspecialchars($f['deskripsi']) ?></td>
                                    <td class="text-center">
                                        <a href="manage_fakta.php?delete=<?= $f['kode_fakta'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus fakta ini? Semua aturan yang menggunakan fakta ini akan terhapus.');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>