<?php
require_once '../../config/koneksi.php';
require_once '../../controller/AuthController.php';
AuthController::checkAuth();

$message = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_jurusan'])) {
    $kode = $conn->real_escape_string($_POST['kode_jurusan']);
    $nama = $conn->real_escape_string($_POST['nama_jurusan']);
    $jenjang = $conn->real_escape_string($_POST['jenjang']);
    

    $check = $conn->query("SELECT kode_jurusan FROM jurusan WHERE kode_jurusan = '$kode'");
    if ($check->num_rows > 0) {
        $error = "Kode Jurusan **$kode** sudah ada. Mohon gunakan kode unik.";
    } else {
        $sql = "INSERT INTO jurusan (kode_jurusan, nama_jurusan, jenjang) VALUES ('$kode', '$nama', '$jenjang')";
        if ($conn->query($sql)) {
            $message = "Jurusan **$nama ($jenjang)** berhasil ditambahkan!";
        } else {
            $error = "Gagal menambah jurusan: " . $conn->error;
        }
    }
}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $kode_delete = $conn->real_escape_string($_GET['delete']);
    
    
    $sql_delete = "DELETE FROM jurusan WHERE kode_jurusan = '$kode_delete'";
    if ($conn->query($sql_delete)) {
        $message = "Jurusan dengan kode **$kode_delete** berhasil dihapus, termasuk semua aturan yang terkait.";
        header("Location: manage_jurusan.php");
        exit;
    } else {
        $error = "Gagal menghapus jurusan: " . $conn->error;
    }
}


$jurusan_res = $conn->query("SELECT * FROM jurusan ORDER BY jenjang DESC, nama_jurusan ASC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manajemen Jurusan</title>
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
                        <li class="nav-item"><a class="nav-link" href="manage_fakta.php">Manajemen Fakta</a></li>
                        <li class="nav-item"><a class="nav-link active" href="manage_jurusan.php">Manajemen Jurusan</a></li>
                        <li class="nav-item"><a class="nav-link " href="manage_rules.php">Manajemen Aturan</a></li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manajemen Jurusan</h1>
                </div>

                <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

                <div class="card mb-4 shadow-sm">
                    <h5 class="card-header bg-info text-white">Tambah Jurusan Baru</h5>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label for="kode_jurusan">Kode Jurusan</label>
                                    <input type="text" class="form-control" name="kode_jurusan" placeholder="Contoh: S37" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nama_jurusan">Nama Jurusan</label>
                                    <input type="text" class="form-control" name="nama_jurusan" placeholder="Contoh: Ilmu Komputer" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="jenjang">Jenjang</label>
                                    <select class="form-control" name="jenjang" required>
                                        <option value="S1">S1</option>
                                        <option value="D3">D3</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3 align-self-end">
                                    <button class="btn btn-primary btn-block" type="submit" name="add_jurusan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h3 class="mt-4">Daftar Jurusan Tersedia (Total: <?= $jurusan_res->num_rows ?>)</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="thead-dark">
                            <tr><th>Kode</th><th>Nama Jurusan</th><th>Jenjang</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php while ($j = $jurusan_res->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($j['kode_jurusan']) ?></td>
                                    <td><?= htmlspecialchars($j['nama_jurusan']) ?></td>
                                    <td><?= htmlspecialchars($j['jenjang']) ?></td>
                                    <td>
                                        <a href="manage_jurusan.php?delete=<?= $j['kode_jurusan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jurusan ini? Semua rule terkait akan ikut terhapus.');">Hapus</a>
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