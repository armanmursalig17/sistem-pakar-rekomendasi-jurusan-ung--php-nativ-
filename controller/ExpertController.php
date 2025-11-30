<?php

require_once __DIR__ . '/../config/koneksi.php';

class ExpertController
{
    private $conn;
    private $root_fact = 'F01'; 

    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function initQuiz($nama)
    {
      
        $candidates = [];
        $sql = "SELECT kode_jurusan FROM jurusan";
        $res = $this->conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $candidates[] = $row['kode_jurusan'];
        }

        $_SESSION['quiz_data'] = [
            'nama' => $nama,
            'candidates' => $candidates,
            'answered_facts' => [],
            'history_answers' => [],
            'current_fact' => $this->root_fact, 
            'status' => 'ongoing'
        ];
    }

   
    public function handleQuizPost()
    {

        if (isset($_POST['step']) && $_POST['step'] == 1) {
            $this->initQuiz($_POST['nama']);
            header("Location: index.php?action=quiz");
            exit;
        }

        if (isset($_POST['kode_fakta']) && isset($_POST['jawaban'])) {
            $fact = $_POST['kode_fakta'];
            $ans  = $_POST['jawaban'];


            $_SESSION['quiz_data']['answered_facts'][] = $fact;
            $_SESSION['quiz_data']['history_answers'][$fact] = $ans;

           
            $this->filterCandidates($fact, $ans);

            if (empty($_SESSION['quiz_data']['candidates'])) {


                $first_answer = $_SESSION['quiz_data']['history_answers'][$this->root_fact] ?? null;

                if ($first_answer === 'Ya') {
                    $_SESSION['quiz_data']['status'] = 'fallback_education';
                } elseif ($first_answer === 'Tidak') {
                    $_SESSION['quiz_data']['status'] = 'fallback_non_education';
                } else {
                    $_SESSION['quiz_data']['status'] = 'no_match';
                }

                header("Location: index.php?action=result");
                exit;
            }


            $next = $this->getNextRelevantFact();

            if ($next) {
                $_SESSION['quiz_data']['current_fact'] = $next;
                header("Location: index.php?action=quiz");
            } else {

                $_SESSION['quiz_data']['status'] = 'found';
                header("Location: index.php?action=result");
            }
            exit;
        }
    }

    // --- 3. FILTER JURUSAN ---
    private function filterCandidates($fact_code, $answer)
    {
        $current_candidates = $_SESSION['quiz_data']['candidates'];
        $survivors = [];


        $majors_with_this_fact = [];
        $sql = "SELECT kode_jurusan FROM aturan WHERE kode_fakta = '$fact_code'";
        $res = $this->conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $majors_with_this_fact[] = $row['kode_jurusan'];
        }

        foreach ($current_candidates as $major) {
            $has_rule = in_array($major, $majors_with_this_fact);

            if ($answer === 'Ya') {
                if ($has_rule) $survivors[] = $major;
            } else {
                if (!$has_rule) $survivors[] = $major;
            }
        }

        $_SESSION['quiz_data']['candidates'] = $survivors;
    }


    private function getNextRelevantFact()
    {
        $candidates = $_SESSION['quiz_data']['candidates'];
        $answered = $_SESSION['quiz_data']['answered_facts'];

        if (empty($candidates)) return null;

        $candidate_str = "'" . implode("','", $candidates) . "'";
        $answered_str = empty($answered) ? "''" : "'" . implode("','", $answered) . "'";

        $sql = "SELECT kode_fakta, COUNT(*) as freq 
                FROM aturan 
                WHERE kode_jurusan IN ($candidate_str) 
                AND kode_fakta NOT IN ($answered_str)
                GROUP BY kode_fakta 
                ORDER BY freq DESC 
                LIMIT 1";

        $res = $this->conn->query($sql);
        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc()['kode_fakta'];
        }
        return null;
    }


    public function renderQuizPage()
    {
        if (!isset($_SESSION['quiz_data']) || !isset($_SESSION['quiz_data']['current_fact'])) {
            header("Location: index.php");
            exit;
        }

        $fact_code = $_SESSION['quiz_data']['current_fact'];

        $desc = "Pertanyaan ?";
        $res = $this->conn->query("SELECT deskripsi FROM fakta WHERE kode_fakta = '$fact_code'");
        if ($res->num_rows > 0) $desc = $res->fetch_assoc()['deskripsi'];


?>
        <!doctype html>
        <html lang="id">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Analisis Minat</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body {
                    background-color: #f0f2f5;
                }

                .quiz-card {
                    border: 0;
                    border-radius: 20px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                }

                .btn-answer {
                    border-radius: 15px;
                    padding: 15px;
                    font-weight: bold;
                    font-size: 1.2rem;
                    transition: transform 0.2s;
                }

                .btn-answer:hover {
                    transform: scale(1.05);
                }
            </style>
        </head>

        <body>
            <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
                <div class="card quiz-card p-4" style="width: 100%; max-width: 600px;">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-muted mb-4 ls-2">Pertanyaan Minat</h6>
                        <h3 class="font-weight-bold mb-5 text-dark"><?= $desc ?>?</h3>
                        <form action="index.php?action=quiz" method="POST">
                            <input type="hidden" name="kode_fakta" value="<?= $fact_code ?>">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" name="jawaban" value="Ya" class="btn btn-success btn-block btn-answer shadow-sm">YA</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="jawaban" value="Tidak" class="btn btn-danger btn-block btn-answer shadow-sm">TIDAK</button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-4 text-muted small">Jawablah dengan jujur sesuai minat Anda saat ini.</p>
                    </div>
                </div>
            </div>
        </body>

        </html>
    <?php
    }


    public function showResult()
    {
        if (!isset($_SESSION['quiz_data'])) {
            header("Location: index.php");
            exit;
        }

        $data = $_SESSION['quiz_data'];
        $status = $data['status'] ?? '';

        $final_candidates = [];
        $title_message = "";
        $alert_message = "";


        if ($status === 'found' && !empty($data['candidates'])) {
            $candidate_ids = "'" . implode("','", $data['candidates']) . "'";
            $sql = "SELECT * FROM jurusan WHERE kode_jurusan IN ($candidate_ids)";
            $title_message = "Jurusan yang Sangat Sesuai";
            $alert_message = "Jurusan ini cocok dengan semua jawaban spesifik Anda.";
        } elseif ($status === 'fallback_education') {

            $sql = "SELECT * FROM jurusan WHERE 
                    nama_jurusan LIKE '%Pendidikan%' OR 
                    nama_jurusan LIKE '%PGSD%' OR 
                    nama_jurusan LIKE '%PAUD%' OR 
                    nama_jurusan LIKE '%Bimbingan%' OR 
                    nama_jurusan LIKE '%Penjaskes%'
                    ORDER BY nama_jurusan ASC";
            $title_message = "Rekomendasi Jalur Pendidikan";
            $alert_message = "Karena Anda memilih <strong>Suka Mengajar</strong> namun belum memilih minat spesifik lainnya, kami merekomendasikan seluruh program studi Kependidikan.";
        } elseif ($status === 'fallback_non_education') {
            // Ambil jurusan yang BUKAN pendidikan
            $sql = "SELECT * FROM jurusan WHERE 
                    nama_jurusan NOT LIKE '%Pendidikan%' AND 
                    nama_jurusan NOT LIKE '%PGSD%' AND 
                    nama_jurusan NOT LIKE '%PAUD%' AND 
                    nama_jurusan NOT LIKE '%Bimbingan%' AND 
                    nama_jurusan NOT LIKE '%Penjaskes%'
                    ORDER BY nama_jurusan ASC";
            $title_message = "Rekomendasi Jalur Non-Kependidikan (Murni/Teknik)";
            $alert_message = "Karena Anda memilih <strong>Jalur Non-Mengajar</strong> namun belum ada minat spesifik yang cocok, berikut adalah pilihan program studi ilmu murni dan terapan.";
        } else {
            $this->displayNoMatchView();
            return;
        }

        // Eksekusi Query
        if (isset($sql)) {
            $res = $this->conn->query($sql);
            if ($res) {
                while ($row = $res->fetch_assoc()) {
                    $final_candidates[] = $row;
                }
            }
        }


    ?>
        <!doctype html>
        <html lang="id">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Hasil Rekomendasi</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>

        <body class="bg-light">
            <div class="container mt-5 mb-5">
                <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-primary text-white text-center py-5">
                        <h1 class="font-weight-bold">🎉 Hasil Rekomendasi 🎉</h1>
                        <p class="mb-0">Halo <strong><?= htmlspecialchars($data['nama']) ?></strong>, berikut hasilnya:</p>
                    </div>
                    <div class="card-body p-5">

                        <div class="alert alert-info text-center shadow-sm">
                            <h4 class="alert-heading font-weight-bold"><?= $title_message ?></h4>
                            <p class="mb-0"><?= $alert_message ?></p>
                        </div>

                        <?php if (count($final_candidates) == 1): ?>
                            <div class="text-center mt-4">
                                <h2 class="text-dark font-weight-bold mb-2">
                                    <?= $final_candidates[0]['nama_jurusan'] ?>
                                </h2>
                                <h4 class="text-muted mb-4"><?= $final_candidates[0]['jenjang'] ?> - <?= $final_candidates[0]['fakultas'] ?></h4>
                                <div class="alert alert-success d-inline-block">
                                    <i class="fas fa-check-circle"></i> Pilihan Terbaik
                                </div>
                            </div>
                        <?php else: ?>
                            <h5 class="text-center mt-4 mb-3">Daftar Jurusan:</h5>
                            <div class="list-group">
                                <?php foreach ($final_candidates as $jur): ?>
                                    <div class="list-group-item list-group-item-action flex-column align-items-start p-3 mb-2 shadow-sm border-0 rounded">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-primary font-weight-bold"><?= $jur['nama_jurusan'] ?></h5>
                                            <span class="badge badge-info p-2"><?= $jur['jenjang'] ?></span>
                                        </div>
                                        <small class="text-muted"><?= $jur['fakultas'] ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="text-center mt-5">
                            <a href="index.php" class="btn btn-outline-dark px-5 py-3 rounded-pill font-weight-bold">Coba Analisis Lagi</a>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    }

    private function displayNoMatchView()
    {


        echo '<div class="container mt-5 text-center"><h1>Error: Data tidak ditemukan</h1><a href="index.php">Kembali</a></div>';
    }
}
?>