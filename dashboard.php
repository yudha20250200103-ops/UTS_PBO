<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';

$pdo = get_database_connection();
$totalUsers = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$newUsers = (int) $pdo->query(
    'SELECT COUNT(*) FROM users WHERE created_at >= DATE_FORMAT(CURRENT_DATE, "%Y-%m-01")'
)->fetchColumn();
$pageTitle = 'Dashboard';
$activePage = 'dashboard';
require __DIR__ . '/includes/header.php';
?>
            <section class="welcome-banner">
                <div>
                    <span class="welcome-label"><i class="fa-regular fa-sun me-2"></i>RINGKASAN HARI INI</span>
                    <h2>Halo, <?= escape_html($_SESSION['user']['name']) ?> <span class="wave">👋</span></h2>
                    <p>Selamat datang kembali. Berikut ringkasan sistem Anda.</p>
                </div>
                <div class="welcome-art" aria-hidden="true"><i class="fa-solid fa-chart-pie"></i></div>
            </section>

            <div class="section-heading">
                <div><h2>Ikhtisar</h2><p>Informasi singkat tentang data di dalam sistem.</p></div>
                <span class="date-pill"><i class="fa-regular fa-calendar me-2"></i><?= date('d M Y') ?></span>
            </div>

            <section class="row g-3 stats-grid" aria-label="Statistik">
                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="stat-card stat-blue">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <p>Total Pengguna</p><strong><?= number_format($totalUsers) ?></strong>
                        <span class="stat-caption">Akun yang terdaftar</span>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="stat-card stat-purple">
                        <div class="stat-icon"><i class="fa-solid fa-user-plus"></i></div>
                        <p>Pengguna Baru</p><strong><?= number_format($newUsers) ?></strong>
                        <span class="stat-caption">Terdaftar bulan ini</span>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <article class="stat-card stat-green">
                        <div class="stat-icon"><i class="fa-solid fa-shield-heart"></i></div>
                        <p>Status Sistem</p><strong class="status-value">Aktif</strong>
                        <span class="stat-caption">Anda masuk sebagai admin</span>
                    </article>
                </div>
            </section>

            <section class="content-card quick-actions">
                <div class="content-card-heading">
                    <div><h2>Akses cepat</h2><p>Menu yang mungkin Anda perlukan.</p></div>
                </div>
                <div class="quick-action-list">
                    <a href="users.php" class="quick-action">
                        <span class="quick-action-icon icon-blue"><i class="fa-solid fa-users"></i></span>
                        <span><strong>Data Pengguna</strong><small>Lihat akun yang terdaftar</small></span>
                        <i class="fa-solid fa-chevron-right action-arrow"></i>
                    </a>
                    <a href="profile.php" class="quick-action">
                        <span class="quick-action-icon icon-purple"><i class="fa-regular fa-id-card"></i></span>
                        <span><strong>Profil Admin</strong><small>Lihat informasi akun Anda</small></span>
                        <i class="fa-solid fa-chevron-right action-arrow"></i>
                    </a>
                </div>
            </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
