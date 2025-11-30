<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$in_pakar_folder = (strpos(dirname($_SERVER['PHP_SELF']), '/pakar') !== false);


if ($in_pakar_folder) {

    $home_link = '../../index.php';
    $login_link = 'login.php';
    $logout_link = 'logout.php';
} else {

    $home_link = 'index.php';
    $login_link = 'views/pakar/login.php';
    $logout_link = 'views/pakar/logout.php';
}


$is_logged_in = isset($_SESSION['pakar_logged_in']) && $_SESSION['pakar_logged_in'] === true;
$username = isset($_SESSION['pakar_username']) ? $_SESSION['pakar_username'] : 'Pakar';
?>

<nav class="navbar navbar-expand-lg navbar-dark  fixed-top shadow">
    <div class="container">
        <a class="navbar-brand" href="<?= $home_link ?>">
            <img src="<?= $in_pakar_folder ? '../../assets/img/logo.png' : 'assets/img/logo.png' ?>"
                alt="Logo UNG"
                style="height: 35px; width: auto; margin-right: 8px;">Sistem Rekomendasi Jurusan UNG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if ($is_logged_in): ?>
                        <a class="nav-link font-weight-bold text-warning" href="<?= $logout_link ?>">
                            Sign Out (<?= htmlspecialchars($username) ?>)
                        </a>
                    <?php else: ?>
                        <a class="nav-link" href="<?= $login_link ?>">
                            Login Pakar
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>