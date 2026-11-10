<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

if (!empty($_SESSION['user']['id'])) {
    redirect_to('dashboard.php');
}

$errorMessage = '';
$identity = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identity = trim(isset($_POST['identity']) ? (string) $_POST['identity'] : '');
    $password = isset($_POST['password']) ? (string) $_POST['password'] : '';

    if (!is_valid_csrf_token(isset($_POST['csrf_token']) ? $_POST['csrf_token'] : null)) {
        $errorMessage = 'Sesi formulir tidak valid. Muat ulang halaman, lalu coba lagi.';
    } elseif ($identity === '' || $password === '') {
        $errorMessage = 'Email/nama admin dan password wajib diisi.';
    } else {
        require_once __DIR__ . '/config/database.php';

        try {
            $pdo = get_database_connection();
            $statement = $pdo->prepare(
                'SELECT id, name, email, password
                 FROM users
                 WHERE email = ? OR name = ?
                 ORDER BY (email = ?) DESC
                 LIMIT 1'
            );
            $statement->execute([$identity, $identity, $identity]);
            $user = $statement->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                unset($_SESSION['_csrf_token']);
                $_SESSION['user'] = [
                    'id' => (int) $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ];

                redirect_to('dashboard.php');
            }

            $errorMessage = 'Email/nama admin atau password salah.';
        } catch (PDOException $exception) {
            error_log('Login database error: ' . $exception->getMessage());
            $errorMessage = 'Tidak dapat terhubung ke database. Periksa konfigurasi dan pastikan MySQL aktif.';
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#172554">
    <title>Masuk | AdminFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <main class="login-layout">
        <section class="login-intro">
            <a class="login-brand" href="index.php">
                <span class="brand-mark"><i class="fa-solid fa-layer-group"></i></span>
                <span>AdminFlow</span>
            </a>
            <div class="intro-content">
                <span class="intro-tag"><i class="fa-solid fa-sparkles me-2"></i>RUANG KERJA ADMIN</span>
                <h1>Kelola semuanya,<br><span>lebih mudah.</span></h1>
                <p>Masuk ke panel admin Anda untuk mengelola data pengguna dan melihat ringkasan aktivitas dalam satu tempat.</p>
            </div>
            <div class="intro-footer"><i class="fa-solid fa-shield-halved me-2"></i>Akses aman untuk administrator</div>
        </section>

        <section class="login-form-side">
            <div class="login-card">
                <div class="login-card-icon"><i class="fa-solid fa-arrow-right-to-bracket"></i></div>
                <p class="form-eyebrow">SELAMAT DATANG KEMBALI</p>
                <h2>Masuk ke akun</h2>
                <p class="form-description">Masukkan kredensial admin Anda untuk melanjutkan.</p>

                <?php if ($errorMessage !== ''): ?>
                    <div class="alert alert-danger login-alert" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-2"></i><?= escape_html($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="index.php" class="login-form">
                    <input type="hidden" name="csrf_token" value="<?= escape_html(get_csrf_token()) ?>">
                    <div class="mb-3">
                        <label for="identity" class="form-label">Email atau nama admin</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-user"></i>
                            <input class="form-control" id="identity" name="identity" type="text"
                                   value="<?= escape_html($identity) ?>" placeholder="admin@gmail.com"
                                   autocomplete="username" maxlength="100" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-with-icon password-field">
                            <i class="fa-solid fa-lock"></i>
                            <input class="form-control" id="password" name="password" type="password"
                                   placeholder="Masukkan password" autocomplete="current-password" required>
                            <button class="password-toggle" id="togglePassword" type="button"
                                    aria-label="Tampilkan password" aria-pressed="false">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-login w-100" type="submit">
                        Masuk ke Dashboard <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </form>
                <div class="login-hint">
                    <i class="fa-solid fa-circle-info me-2"></i>Akun uji coba: <strong>admin@gmail.com</strong>
                </div>
                <p class="login-copyright mb-0">&copy; <?= date('Y') ?> AdminFlow. Admin panel sederhana.</p>
            </div>
        </section>
    </main>
    <script src="assets/js/script.js"></script>
</body>
</html>
