<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';

$pdo = get_database_connection();
$statement = $pdo->prepare('SELECT id, name, email, created_at FROM users WHERE id = ? LIMIT 1');
$statement->execute([$_SESSION['user']['id']]);
$profile = $statement->fetch();

if (!$profile) {
    $_SESSION = [];
    session_destroy();
    redirect_to('index.php');
}

$pageTitle = 'Profil Admin';
$activePage = 'profile';
require __DIR__ . '/includes/header.php';
?>
            <section class="profile-layout">
                <article class="content-card profile-card">
                    <div class="profile-cover"></div>
                    <div class="profile-avatar"><?= escape_html(strtoupper(substr($profile['name'], 0, 1))) ?></div>
                    <div class="profile-main">
                        <span class="role-badge"><i class="fa-solid fa-shield-halved me-1"></i>Administrator</span>
                        <h2><?= escape_html($profile['name']) ?></h2>
                        <p><?= escape_html($profile['email']) ?></p>
                    </div>
                    <div class="profile-details">
                        <div class="profile-detail"><span>Nama lengkap</span><strong><?= escape_html($profile['name']) ?></strong></div>
                        <div class="profile-detail"><span>Alamat email</span><strong><?= escape_html($profile['email']) ?></strong></div>
                        <div class="profile-detail"><span>Bergabung sejak</span><strong><?= escape_html(date('d F Y', strtotime($profile['created_at']))) ?></strong></div>
                        <div class="profile-detail"><span>Hak akses</span><strong>Administrator</strong></div>
                    </div>
                </article>
                <aside class="profile-note">
                    <span class="note-icon"><i class="fa-solid fa-lock"></i></span>
                    <h3>Akun terlindungi</h3>
                    <p>Informasi profil ini hanya dapat dilihat setelah Anda berhasil masuk ke sistem.</p>
                </aside>
            </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
