<?php

require_once '../../config/koneksi.php';
require_once '../../controller/AuthController.php';
AuthController::checkAuth();

$message = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_rule'])) {
    $kode_jurusan = $conn->real_escape_string($_POST['kode_jurusan']);
    $kode_fakta = $conn->real_escape_string($_POST['kode_fakta_rule']);
    $bobot = (float)$_POST['bobot'];

   
    $check = $conn->query("SELECT id_aturan FROM aturan WHERE kode_jurusan = '$kode_jurusan' AND kode_fakta = '$kode_fakta'");
    if ($check->num_rows > 0) {
        $error = "Aturan ini (Jurusan $kode_jurusan dengan Fakta $kode_fakta) sudah ada.";
    } else {
        $sql = "INSERT INTO aturan (kode_jurusan, kode_fakta, bobot) VALUES ('$kode_jurusan', '$kode_fakta', '$bobot')";
        if ($conn->query($sql)) {
            $message = "Aturan baru berhasil ditambahkan! Bobot: **$bobot**";
        } else {
            $error = "Gagal menambah aturan: " . $conn->error;
        }
    }
}


if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id_delete = (int)$_GET['delete'];
    
    $sql_delete = "DELETE FROM aturan WHERE id_aturan = $id_delete";
    if ($conn->query($sql_delete)) {
        header("Location: manage_rules.php");
        exit;
    } else {
        $error = "Gagal menghapus aturan: " . $conn->error;
    }
}


$jurusan_res = $conn->query("SELECT kode_jurusan, nama_jurusan, jenjang FROM jurusan ORDER BY nama_jurusan");
$fakta_res = $conn->query("SELECT kode_fakta, deskripsi FROM fakta ORDER BY kode_fakta");


$search_query = "";
$sql_rules = "SELECT a.id_aturan, a.bobot, j.nama_jurusan, j.kode_jurusan, j.jenjang, f.kode_fakta, f.deskripsi AS deskripsi_fakta
              FROM aturan a
              JOIN jurusan j ON a.kode_jurusan = j.kode_jurusan
              JOIN fakta f ON a.kode_fakta = f.kode_fakta";


if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
  
    $sql_rules .= " WHERE j.nama_jurusan LIKE '%$q%' OR j.kode_jurusan LIKE '%$q%'";
    $search_query = htmlspecialchars($_GET['q']);
}

$sql_rules .= " ORDER BY j.nama_jurusan ASC, a.kode_fakta ASC";
$rules_res = $conn->query($sql_rules);


$grouped_rules = [];
if ($rules_res->num_rows > 0) {
    while ($row = $rules_res->fetch_assoc()) {
        $key_jurusan = htmlspecialchars($row['nama_jurusan']) . ' (' . $row['jenjang'] . ')';
        $grouped_rules[$key_jurusan][] = $row;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manajemen Aturan & Rule</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        .table-valign-middle td { vertical-align: middle !important; }
        .merged-cell { background-color: #ffffff; font-weight: bold; color: #2c3e50; }
        .select2-container .select2-selection--single { height: 38px !important; }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered { line-height: 36px !important; }
    </style>
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
                        <li class="nav-item"><a class="nav-link" href="manage_jurusan.php">Manajemen Jurusan</a></li>
                        <li class="nav-item"><a class="nav-link active" href="manage_rules.php">Manajemen Aturan</a></li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manajemen Aturan (Rule)</h1>
                </div>

                <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

                <div class="card mb-4 shadow-sm">
                    <h5 class="card-header bg-success text-white">Tambahkan Aturan (Rule) Baru</h5>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="kode_jurusan">Jurusan (Goal)</label>
                                    <select class="form-control select2" name="kode_jurusan" required>
                                        <option value="">-- Cari Jurusan --</option>
                                        <?php while ($j = $jurusan_res->fetch_assoc()): ?>
                                            <option value="<?= $j['kode_jurusan'] ?>">
                                                <?= $j['kode_jurusan'] ?> - <?= htmlspecialchars($j['nama_jurusan']) ?> (<?= $j['jenjang'] ?>)
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kode_fakta_rule">Fakta (Kondisi)</label>
                                    <select class="form-control select2" name="kode_fakta_rule" required>
                                        <option value="">-- Cari Fakta --</option>
                                        <?php while ($f = $fakta_res->fetch_assoc()): ?>
                                            <option value="<?= $f['kode_fakta'] ?>">
                                                <?= $f['kode_fakta'] ?> - <?= htmlspecialchars($f['deskripsi']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" step="0.01" class="form-control" name="bobot" value="1.00" min="0.01" max="1.00" required>
                                </div>
                                <div class="col-md-2 mb-3 align-self-end">
                                    <button class="btn btn-success btn-block" type="submit" name="add_rule">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h3 class="">Daftar Aturan Tersimpan</h3>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Cari Nama Jurusan atau Kode..." value="<?= $search_query ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                    <?php if($search_query): ?>
                                        <a href="manage_rules.php" class="btn btn-secondary">Reset</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm table-valign-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 25%;">Jurusan (Goal)</th> 
                                <th style="width: 45%;">Fakta (Condition)</th>
                                <th style="width: 10%;">Bobot</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($grouped_rules)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3">
                                        <?= $search_query ? 'Data tidak ditemukan untuk pencarian: "<b>'.$search_query.'</b>"' : 'Belum ada aturan data yang tersimpan.' ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($grouped_rules as $jurusan_name => $rules): ?>
                                    <?php $rowspan_count = count($rules); ?>
                                    <?php foreach ($rules as $index => $rule): ?>
                                        <tr>
                                            <?php if ($index === 0): ?>
                                                <td rowspan="<?= $rowspan_count ?>" class="merged-cell text-center">
                                                    <?= $jurusan_name ?>
                                                    <br>
                                                    <small class="text-muted">(<?= $rule['kode_jurusan'] ?>)</small>
                                                </td>
                                            <?php endif; ?>
                                            
                                            <td>
                                                <span class="badge badge-info"><?= $rule['kode_fakta'] ?></span> 
                                                <?= htmlspecialchars($rule['deskripsi_fakta']) ?>
                                            </td>
                                            <td class="text-center"><?= $rule['bobot'] ?></td>
                                            <td class="text-center">
                                                <a href="manage_rules.php?delete=<?= $rule['id_aturan'] ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Yakin ingin menghapus aturan fakta ini?');">
                                                   Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
         
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: "Ketik untuk mencari...",
                allowClear: true
            });
        });
    </script>
</body>
</html>