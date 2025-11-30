<?php




// index.php'
require_once 'config/koneksi.php';
require_once 'controller/ExpertController.php';

$expertController = new ExpertController($conn);


$action = $_GET['action'] ?? 'home';

// Handle POST request untuk kuis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'quiz') {
    $expertController->handleQuizPost();
    exit;
}

// Render tampilan berdasarkan action
if ($action === 'quiz') {
    // Tampilkan pertanyaan kuis di modal/halaman terpisah
    $expertController->renderQuizPage();
} elseif ($action === 'result') {
    // Tampilkan hasil rekomendasi
    $expertController->showResult();
} else {
    // Landing Page
    include 'views/landing.php';
}
?>