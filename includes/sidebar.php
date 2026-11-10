<aside class="sidebar" id="sidebar">
    <a class="brand" href="dashboard.php">
        <span class="brand-mark"><i class="fa-solid fa-layer-group"></i></span>
        <span class="brand-copy"><strong>AdminFlow</strong><small>Panel Manajemen</small></span>
    </a>
    <div class="sidebar-section-label">MENU UTAMA</div>
    <nav class="sidebar-nav" aria-label="Navigasi utama">
        <a class="sidebar-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="dashboard.php">
            <i class="fa-solid fa-grid-2"></i><span>Dashboard</span>
        </a>
        <a class="sidebar-link <?= $activePage === 'users' ? 'active' : '' ?>" href="users.php">
            <i class="fa-solid fa-users"></i><span>Data Pengguna</span>
        </a>
        <a class="sidebar-link <?= $activePage === 'profile' ? 'active' : '' ?>" href="profile.php">
            <i class="fa-regular fa-id-card"></i><span>Profil</span>
        </a>
    </nav>
    <div class="sidebar-bottom">
        <div class="sidebar-help-icon"><i class="fa-regular fa-circle-question"></i></div>
        <p class="mb-1">Butuh bantuan?</p>
        <small>Hubungi administrator sistem Anda.</small>
    </div>
</aside>
