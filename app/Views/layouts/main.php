<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'SIMRS Klinik Rozan') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>

<!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-left">
        <button class="btn-toggle-sidebar" onclick="document.querySelector('.sidebar').classList.toggle('open')">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
        </button>
        <div class="topbar-brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
            </div>
            <span>Klinik Rozan</span>
        </div>
    </div>
    <div class="topbar-center">
        <div class="topbar-search">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Cari pasien, dokter, atau menu...">
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-notif">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
            <span class="notif-badge">3</span>
        </div>
        <a href="<?= site_url('logout') ?>" class="topbar-user">
            <div class="avatar"><?= strtoupper(substr(session('fullname') ?? 'A', 0, 1)) ?></div>
            <div class="user-info">
                <div class="user-name"><?= esc(session('fullname') ?? 'Admin') ?></div>
                <div class="user-role"><?= esc(session('role') ?? 'Administrator') ?></div>
            </div>
        </a>
    </div>
</header>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-section">
        <a href="<?= site_url('dashboard') ?>" class="sidebar-link <?= uri_string() === 'dashboard' || uri_string() === '' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Pelayanan</div>
        <a href="<?= site_url('module/pasien') ?>" class="sidebar-link <?= str_contains(uri_string(), 'pasien') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Data Pasien
        </a>
        <a href="<?= site_url('module/registrasi') ?>" class="sidebar-link <?= str_contains(uri_string(), 'registrasi') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Pendaftaran
        </a>
        <a href="<?= site_url('module/rawat-jalan') ?>" class="sidebar-link <?= str_contains(uri_string(), 'rawat-jalan') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            Rawat Jalan
        </a>
        <a href="<?= site_url('module/igd') ?>" class="sidebar-link <?= str_contains(uri_string(), 'igd') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 00-2.91-.09z"/><path d="M12 15l-3-3a22 22 0 012-3.95A12.88 12.88 0 0122 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 01-4 2z"/></svg>
            IGD / Triase
        </a>
        <a href="<?= site_url('module/rawat-inap') ?>" class="sidebar-link <?= str_contains(uri_string(), 'rawat-inap') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
            Rawat Inap
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Penunjang</div>
        <a href="<?= site_url('module/laboratorium') ?>" class="sidebar-link <?= str_contains(uri_string(), 'laboratorium') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
            Laboratorium
        </a>
        <a href="<?= site_url('module/radiologi') ?>" class="sidebar-link <?= str_contains(uri_string(), 'radiologi') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2"/><circle cx="12" cy="12" r="4"/><path d="M12 2v4M12 18v4M2 12h4M18 12h4"/></svg>
            Radiologi
        </a>
        <a href="<?= site_url('module/farmasi') ?>" class="sidebar-link <?= str_contains(uri_string(), 'farmasi') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
            Farmasi
        </a>
        <a href="<?= site_url('module/operasi') ?>" class="sidebar-link <?= str_contains(uri_string(), 'operasi') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
            Operasi
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Keuangan</div>
        <a href="<?= site_url('module/billing') ?>" class="sidebar-link <?= str_contains(uri_string(), 'billing') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Pembayaran
        </a>
        <a href="<?= site_url('module/bpjs') ?>" class="sidebar-link <?= str_contains(uri_string(), 'bpjs') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            BPJS / SEP
        </a>
        <a href="<?= site_url('module/rekam-medis') ?>" class="sidebar-link <?= str_contains(uri_string(), 'rekam-medis') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            Rekam Medis
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Master & Admin</div>
        <a href="<?= site_url('module/dokter') ?>" class="sidebar-link <?= str_contains(uri_string(), 'module/dokter') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Jadwal Dokter
        </a>
        <a href="<?= site_url('module/poli') ?>" class="sidebar-link <?= str_contains(uri_string(), 'module/poli') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Poliklinik
        </a>
        <a href="<?= site_url('module/inventory') ?>" class="sidebar-link <?= str_contains(uri_string(), 'inventory') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            Inventory
        </a>
        <a href="<?= site_url('module/users') ?>" class="sidebar-link <?= str_contains(uri_string(), 'users') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15 1.65 1.65 0 003.17 14H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68 1.65 1.65 0 0010 3.17V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            Pengaturan
        </a>
    </div>
</aside>

<!-- MAIN -->
<main class="main-content">
    <?= $this->renderSection('content') ?>
</main>

<script>
document.addEventListener('click', function(e) {
    const sidebar = document.querySelector('.sidebar');
    const toggle = document.querySelector('.btn-toggle-sidebar');
    if (window.innerWidth <= 1024 && sidebar && toggle && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
        sidebar.classList.remove('open');
    }
});
</script>
</body>
</html>
