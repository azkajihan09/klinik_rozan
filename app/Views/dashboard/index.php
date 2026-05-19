<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p class="breadcrumb">Selamat datang, <strong><?= esc(session('fullname') ?? 'Admin') ?></strong> &middot; <?= date('l, d F Y') ?></p>
    </div>
</div>

<!-- STATISTIK -->
<div class="stats-grid">
    <?php
    $icons = [
        'Pasien' => ['teal', '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>'],
        'Registrasi Hari Ini' => ['blue', '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
        'Rawat Jalan Hari Ini' => ['green', '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>'],
        'Rawat Inap Aktif' => ['orange', '<path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/>'],
        'Resep Hari Ini' => ['teal', '<path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/>'],
        'Order Lab Hari Ini' => ['blue', '<path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/>'],
        'Order Radiologi Hari Ini' => ['amber', '<rect x="2" y="2" width="20" height="20" rx="2"/><circle cx="12" cy="12" r="4"/>'],
        'Billing Hari Ini' => ['red', '<rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>'],
    ];
    foreach ($stats as $label => $value):
        $icon = $icons[$label] ?? ['teal', '<circle cx="12" cy="12" r="10"/>'];
    ?>
    <div class="stat-card">
        <div class="stat-icon <?= $icon[0] ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?= $icon[1] ?></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($value) ?></div>
            <div class="stat-label"><?= esc($label) ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- ALUR PELAYANAN -->
<div class="card">
    <div class="card-header">
        <h3>⚡ Alur Pelayanan Klinik</h3>
    </div>
    <div class="flow-grid">
        <a href="<?= site_url('module/pasien') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            <div class="flow-label">1. Pasien</div>
            <div class="flow-desc">Data & pendaftaran</div>
        </a>
        <a href="<?= site_url('module/registrasi') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <div class="flow-label">2. Registrasi</div>
            <div class="flow-desc">Daftar kunjungan</div>
        </a>
        <a href="<?= site_url('module/rawat-jalan') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            <div class="flow-label">3. Pemeriksaan</div>
            <div class="flow-desc">Ralan / IGD / Ranap</div>
        </a>
        <a href="<?= site_url('module/laboratorium') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
            <div class="flow-label">4. Penunjang</div>
            <div class="flow-desc">Lab / Radiologi</div>
        </a>
        <a href="<?= site_url('module/farmasi') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
            <div class="flow-label">5. Farmasi</div>
            <div class="flow-desc">Resep & obat</div>
        </a>
        <a href="<?= site_url('module/billing') ?>" class="flow-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            <div class="flow-label">6. Billing</div>
            <div class="flow-desc">Pembayaran</div>
        </a>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="card">
    <div class="card-header">
        <h3>🚀 Aksi Cepat</h3>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="<?= site_url('module/pasien/new') ?>" class="btn btn-primary">+ Pasien Baru</a>
        <a href="<?= site_url('module/registrasi/new') ?>" class="btn btn-success">+ Registrasi</a>
        <a href="<?= site_url('module/rawat-jalan/new') ?>" class="btn btn-secondary">+ Pemeriksaan</a>
        <a href="<?= site_url('module/farmasi/new') ?>" class="btn btn-secondary">+ Resep Obat</a>
        <a href="<?= site_url('module/laboratorium/new') ?>" class="btn btn-secondary">+ Order Lab</a>
    </div>
</div>

<?= $this->endSection() ?>
