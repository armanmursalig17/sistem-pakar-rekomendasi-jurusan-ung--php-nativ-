<?php
// config/koneksi.php
$host = "localhost";
$user = "root"; 
$pass = "";    
$db = "pakar_ung";


$conn = @new mysqli($host, $user, $pass, $db);

// Cek koneksi secara eksplisit
if ($conn->connect_error) {
   
    die("❌ Koneksi database gagal: " . $conn->connect_error . "
    <br>Pastikan server MySQL (Laragon/XAMPP) berjalan dan kredensial di koneksi.php benar.");
}


$conn->set_charset("utf8");

session_start();


?>