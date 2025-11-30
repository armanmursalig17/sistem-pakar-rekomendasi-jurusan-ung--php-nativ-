<?php

// 1. KONEKSI DATABASE
$host = "localhost";
$user = "root"; // Sesuaikan user database
$pass = "";     // Sesuaikan password database
$db   = "pakar_ung";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi bantu untuk eksekusi query
function runQuery($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

echo "<h3>Memulai Proses Seeding Data Pakar UNG...</h3>";

// 2. KOSONGKAN TABEL (Agar bersih saat dijalankan ulang)
runQuery($conn, "SET FOREIGN_KEY_CHECKS = 0");
runQuery($conn, "TRUNCATE TABLE aturan");
runQuery($conn, "TRUNCATE TABLE fakta");
runQuery($conn, "TRUNCATE TABLE jurusan");
runQuery($conn, "SET FOREIGN_KEY_CHECKS = 1");
echo "Tabel berhasil dikosongkan.<br><hr>";

$conn->query("ALTER TABLE fakta MODIFY COLUMN jenis_input VARCHAR(50)");
// ---------------------------------------------------------
// 3. DATA FAKTA (MINAT & BAKAT)
// ---------------------------------------------------------
$data_fakta = [
    ['F01', 'Suka mengajar, membimbing, dan berbagi ilmu', 'checkbox'], // Wajib untuk Pendidikan
    ['F02', 'Suka berhitung, logika matematika, dan angka', 'checkbox'],
    ['F03', 'Tertarik pada ilmu fisika, mekanika, atau bumi', 'checkbox'],
    ['F04', 'Tertarik pada makhluk hidup, biologi, dan lingkungan', 'checkbox'],
    ['F05', 'Suka melakukan eksperimen kimia atau laboratorium', 'checkbox'],
    ['F06', 'Tertarik pada komputer, coding, atau teknologi digital', 'checkbox'],
    ['F07', 'Memiliki minat pada seni (tari, musik, rupa, drama)', 'checkbox'],
    ['F08', 'Suka berolahraga dan aktivitas fisik', 'checkbox'],
    ['F09', 'Peduli sosial, suka berinteraksi dengan masyarakat', 'checkbox'],
    ['F10', 'Tertarik pada ekonomi, bisnis, dan keuangan', 'checkbox'],
    ['F11', 'Tertarik pada bidang kesehatan dan medis', 'checkbox'],
    ['F12', 'Suka kegiatan pertanian, tanaman, atau hewan ternak', 'checkbox'],
    ['F13', 'Suka mempelajari bahasa dan sastra (Indonesia/Asing)', 'checkbox'],
    ['F14', 'Tertarik pada hukum, aturan, dan debat', 'checkbox'],
    ['F15', 'Suka merancang bangunan atau teknik sipil', 'checkbox'],
    ['F16', 'Tertarik pada kelautan dan perikanan', 'checkbox'],
    ['F17', 'Suka administrasi dan tata kelola pemerintahan', 'checkbox'],
    ['F18', 'Suka hal-hal berbau teknik mesin atau elektro', 'checkbox'],
    ['F19', 'Tertarik pada pariwisata dan perhotelan', 'checkbox'],
    ['F20', 'Memiliki jiwa kepemimpinan dan manajemen', 'checkbox'],
];

foreach ($data_fakta as $f) {
    $sql = "INSERT INTO fakta (kode_fakta, deskripsi, jenis_input) VALUES ('$f[0]', '$f[1]', '$f[2]')";
    runQuery($conn, $sql);
}
echo "Data Fakta berhasil diinput.<br>";

// ---------------------------------------------------------
// 4. DATA JURUSAN DAN FAKULTAS
// ---------------------------------------------------------
// Format Array: Nama Fakultas => [List Jurusan]
$data_kampus = [
    'Fakultas Ilmu Pendidikan (FIP)' => [
        'Bimbingan dan Konseling', 'Pendidikan Masyarakat', 'Manajemen Pendidikan', 'PAUD', 'PGSD', 'Psikologi', 'Pendidikan Khusus'
    ],
    'Fakultas MIPA (FMIPA)' => [
        'Pendidikan Matematika', 'Pendidikan Fisika', 'Pendidikan Biologi', 'Pendidikan Kimia', 'Pendidikan Geografi',
        'Fisika', 'Biologi', 'Kimia', 'Matematika', 'Statistika', 'Pendidikan IPA', 'Teknik Geologi', 'Ilmu Lingkungan'
    ],
    'Fakultas Ilmu Sosial (FIS)' => [
        'Pendidikan Pancasila dan Kewarganegaraan', 'Pendidikan Sejarah', 'Sosiologi', 'Ilmu Komunikasi', 'Administrasi Publik'
    ],
    'Fakultas Sastra dan Budaya (FSB)' => [
        'Pendidikan Bahasa dan Sastra Indonesia', 'Pendidikan Bahasa Inggris', 'Pendidikan Sendratari / Sendratasik'
    ],
    'Fakultas Teknik (FT)' => [
        'Pendidikan Seni Rupa', 'Sistem Informasi', 'Teknik Sipil', 'Teknik Elektro', 'Teknik Arsitektur',
        'Pendidikan Teknologi Informasi', 'Pendidikan Vokasional Konstruksi Bangunan', 'Teknik Industri',
        'Perencanaan Wilayah Kota (PWK)', 'Pendidikan Teknik Mesin', 'Teknik Komputer'
    ],
    'Fakultas Pertanian (FAPERTA)' => [
        'Agribisnis', 'Agroteknologi', 'Peternakan', 'Ilmu Teknologi Pangan'
    ],
    'Fakultas Olahraga dan Kesehatan (FOK)' => [
        'Penjaskes (Pendidikan Jasmani dan Kesehatan)', 'Pendidikan Kepelatihan Olahraga', 'Keperawatan',
        'Kesehatan Masyarakat', 'Farmasi', 'D3 Farmasi'
    ],
    'Fakultas Ekonomi dan Bisnis (FEB)' => [
        'Pendidikan Ekonomi', 'Akuntansi', 'Manajemen', 'Ekonomi Pembangunan'
    ],
    'Fakultas Hukum (FH)' => [
        'Ilmu Hukum'
    ],
    'Fakultas Kelautan dan Perikanan (FKTP)' => [
        'Budidaya Perairan', 'Manajemen Sumber Daya Perairan', 'Teknologi Hasil Perikanan', 'Ilmu Kelautan', 'Teknologi Penangkapan Ikan'
    ],
    'Fakultas Kedokteran (FK)' => [
        'Kedokteran'
    ],
    'Program Vokasi' => [
        'D4 Teknologi Rekayasa Perangkat Lunak', 'D4 Arsitektur Bangunan Gedung',
        'D4 Teknologi Rekayasa Energi Terbarukan', 'D4 Agribisnis Perikanan', 'D3 Pariwisata'
    ]
];

$counter_jurusan = 1;
$counter_aturan = 1;

foreach ($data_kampus as $fakultas => $prodis) {
    foreach ($prodis as $nama_jurusan) {
        
        // A. Generate Kode Jurusan (J001, J002, dst)
        $kode_jurusan = 'J' . str_pad($counter_jurusan, 3, '0', STR_PAD_LEFT);
        
        // B. Tentukan Jenjang (S1, D3, D4)
        $jenjang = 'S1'; // Default
        if (strpos($nama_jurusan, 'D3') !== false) {
            $jenjang = 'D3';
        } elseif (strpos($nama_jurusan, 'D4') !== false) {
            $jenjang = 'D4';
        }

        // C. Insert ke Tabel Jurusan
        $sql_jur = "INSERT INTO jurusan (kode_jurusan, nama_jurusan, jenjang, fakultas) 
                    VALUES ('$kode_jurusan', '$nama_jurusan', '$jenjang', '$fakultas')";
        runQuery($conn, $sql_jur);

        // ---------------------------------------------------------
        // 5. LOGIKA OTOMATIS PEMBUATAN ATURAN (RULE)
        // ---------------------------------------------------------
        
        $facts_to_add = [];

        // RULE 1: JIKA ADA KATA "PENDIDIKAN" atau "PGSD" atau "PAUD" -> WAJIB SUKA MENGAJAR (F01)
        if (stripos($nama_jurusan, 'Pendidikan') !== false || stripos($nama_jurusan, 'PGSD') !== false || stripos($nama_jurusan, 'PAUD') !== false || stripos($nama_jurusan, 'Bimbingan') !== false || stripos($nama_jurusan, 'Penjaskes') !== false) {
            $facts_to_add[] = 'F01'; 
        }

        // RULE 2: MIPA & MATEMATIKA
        if (stripos($nama_jurusan, 'Matematika') !== false || stripos($nama_jurusan, 'Statistika') !== false || stripos($nama_jurusan, 'Akuntansi') !== false) {
            $facts_to_add[] = 'F02';
        }

        // RULE 3: FISIKA & TEKNIK
        if (stripos($nama_jurusan, 'Fisika') !== false || stripos($nama_jurusan, 'Teknik') !== false || stripos($nama_jurusan, 'Elektro') !== false || stripos($nama_jurusan, 'Mesin') !== false || stripos($nama_jurusan, 'Energi') !== false) {
            $facts_to_add[] = 'F03';
            $facts_to_add[] = 'F18';
        }

        // RULE 4: BIOLOGI & LINGKUNGAN & PERTANIAN
        if (stripos($nama_jurusan, 'Biologi') !== false || stripos($nama_jurusan, 'Lingkungan') !== false || stripos($nama_jurusan, 'Pertanian') !== false || stripos($nama_jurusan, 'Peternakan') !== false || stripos($nama_jurusan, 'Agro') !== false) {
            $facts_to_add[] = 'F04';
            $facts_to_add[] = 'F12';
        }

        // RULE 5: KIMIA & FARMASI
        if (stripos($nama_jurusan, 'Kimia') !== false || stripos($nama_jurusan, 'Farmasi') !== false || stripos($nama_jurusan, 'Pangan') !== false) {
            $facts_to_add[] = 'F05';
        }

        // RULE 6: KOMPUTER & SISTEM INFORMASI
        if (stripos($nama_jurusan, 'Komputer') !== false || stripos($nama_jurusan, 'Sistem Informasi') !== false || stripos($nama_jurusan, 'Teknologi Informasi') !== false || stripos($nama_jurusan, 'Perangkat Lunak') !== false) {
            $facts_to_add[] = 'F06';
            $facts_to_add[] = 'F02'; // Biasanya butuh logika
        }

        // RULE 7: SENI & BUDAYA
        if (stripos($nama_jurusan, 'Seni') !== false || stripos($nama_jurusan, 'Sendratari') !== false || stripos($nama_jurusan, 'Arsitektur') !== false) {
            $facts_to_add[] = 'F07';
        }
        
        // Arsitektur & Sipil butuh Rancang Bangun
        if (stripos($nama_jurusan, 'Arsitektur') !== false || stripos($nama_jurusan, 'Sipil') !== false || stripos($nama_jurusan, 'Bangunan') !== false || stripos($nama_jurusan, 'PWK') !== false) {
            $facts_to_add[] = 'F15';
        }

        // RULE 8: OLAHRAGA
        if (stripos($nama_jurusan, 'Olahraga') !== false || stripos($nama_jurusan, 'Penjaskes') !== false) {
            $facts_to_add[] = 'F08';
        }

        // RULE 9: SOSIAL, KOMUNIKASI, PSIKOLOGI
        if (stripos($nama_jurusan, 'Sosial') !== false || stripos($nama_jurusan, 'Komunikasi') !== false || stripos($nama_jurusan, 'Psikologi') !== false || stripos($nama_jurusan, 'Masyarakat') !== false || stripos($nama_jurusan, 'Konseling') !== false) {
            $facts_to_add[] = 'F09';
        }

        // RULE 10: EKONOMI & MANAJEMEN
        if (stripos($nama_jurusan, 'Ekonomi') !== false || stripos($nama_jurusan, 'Manajemen') !== false || stripos($nama_jurusan, 'Akuntansi') !== false || stripos($nama_jurusan, 'Agribisnis') !== false) {
            $facts_to_add[] = 'F10';
            $facts_to_add[] = 'F20';
        }

        // RULE 11: KESEHATAN & KEDOKTERAN
        if (stripos($nama_jurusan, 'Kedokteran') !== false || stripos($nama_jurusan, 'Keperawatan') !== false || stripos($nama_jurusan, 'Kesehatan') !== false || stripos($nama_jurusan, 'Farmasi') !== false) {
            $facts_to_add[] = 'F11';
            $facts_to_add[] = 'F04'; // Biologi
        }

        // RULE 12: BAHASA
        if (stripos($nama_jurusan, 'Bahasa') !== false || stripos($nama_jurusan, 'Sastra') !== false) {
            $facts_to_add[] = 'F13';
        }

        // RULE 13: HUKUM & PPKN
        if (stripos($nama_jurusan, 'Hukum') !== false || stripos($nama_jurusan, 'Pancasila') !== false) {
            $facts_to_add[] = 'F14';
            $facts_to_add[] = 'F09';
        }

        // RULE 14: KELAUTAN & PERIKANAN
        if (stripos($nama_jurusan, 'Kelautan') !== false || stripos($nama_jurusan, 'Perikanan') !== false || stripos($nama_jurusan, 'Perairan') !== false) {
            $facts_to_add[] = 'F16';
            $facts_to_add[] = 'F04';
        }

        // RULE 15: ADMINISTRASI
        if (stripos($nama_jurusan, 'Administrasi') !== false) {
            $facts_to_add[] = 'F17';
        }
        
        // RULE 16: PARIWISATA
        if (stripos($nama_jurusan, 'Pariwisata') !== false) {
            $facts_to_add[] = 'F19';
            $facts_to_add[] = 'F13'; // Bahasa penting di pariwisata
        }

        // D. Insert ke Tabel Aturan
        // Hilangkan duplikat fakta jika ada rule yang tumpang tindih
        $facts_to_add = array_unique($facts_to_add);

        foreach ($facts_to_add as $kode_fakta) {
            // Bobot default 0.8, jika Suka Mengajar (F01) beri bobot lebih tinggi 1.0
            $bobot = ($kode_fakta == 'F01') ? 1.0 : 0.8;
            
            $sql_rule = "INSERT INTO aturan (kode_jurusan, kode_fakta, bobot) 
                         VALUES ('$kode_jurusan', '$kode_fakta', '$bobot')";
            runQuery($conn, $sql_rule);
        }

        $counter_jurusan++;
    }
}

echo "Data Jurusan dan Aturan berhasil diinput.<br>";
echo "<hr><h3>Selesai! Database pakar_ung siap digunakan.</h3>";

$conn->close();
?>