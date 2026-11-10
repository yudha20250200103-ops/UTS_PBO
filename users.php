<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';

$pdo = get_database_connection();
$users = $pdo->query('SELECT id, name, email, created_at FROM users ORDER BY id DESC')->fetchAll();
$pageTitle = 'Data Pengguna';
$activePage = 'users';
require __DIR__ . '/includes/header.php';
?>
            <section class="content-card">
                <div class="content-card-heading">
                    <div><h2>Daftar pengguna</h2><p>Informasi akun yang tersimpan di dalam sistem.</p></div>
                    <span class="table-count"><?= count($users) ?> akun</span>
                </div>
                <div class="table-responsive">
                    <table class="table users-table align-middle mb-0">
                        <thead><tr><th scope="col">Pengguna</th><th scope="col">Email</th><th scope="col">Terdaftar</th><th scope="col">Status</th></tr></thead>
                        <tbody>
                        <?php if (!$users): ?>
                            <tr><td colspan="4" class="empty-state">Belum ada data pengguna.</td></tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <div class="table-user">
                                            <span class="avatar avatar-soft"><?= escape_html(strtoupper(substr($user['name'], 0, 1))) ?></span>
                                            <span><strong><?= escape_html($user['name']) ?></strong><small>ID #<?= (int) $user['id'] ?></small></span>
                                        </div>
                                    </td>
                                    <td><?= escape_html($user['email']) ?></td>
                                    <td><?= escape_html(date('d M Y', strtotime($user['created_at']))) ?></td>
                                    <td><span class="status-badge"><span></span>Aktif</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
