<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Dashboard';
$activePage = isset($activePage) ? $activePage : 'dashboard';
$adminName = $_SESSION['user']['name'];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f7fb">
    <title><?= escape_html($pageTitle) ?> | AdminFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    <?php require __DIR__ . '/sidebar.php'; ?>
    <div class="main-panel">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Buka navigasi">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <p class="topbar-eyebrow mb-0">AREA ADMIN</p>
                    <h1 class="topbar-title mb-0"><?= escape_html($pageTitle) ?></h1>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="admin-chip">
                    <span class="avatar"><?= escape_html(strtoupper(substr($adminName, 0, 1))) ?></span>
                    <span class="admin-chip-name"><?= escape_html($adminName) ?></span>
                </div>
                <form action="logout.php" method="post" class="m-0">
                    <input type="hidden" name="csrf_token" value="<?= escape_html(get_csrf_token()) ?>">
                    <button class="btn btn-logout" type="submit">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i><span>Keluar</span>
                    </button>
                </form>
            </div>
        </header>
        <main class="page-content">
