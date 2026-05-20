<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'SIMRS Klinik Rozan') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
</head>
<body class="layout-fixed sidebar-expand-lg">
<div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">&#9776;</a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <span class="nav-link fw-bold">SIMRS Klinik Rozan</span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('logout') ?>"><?= esc(session('fullname') ?? 'Admin') ?> | Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <aside class="app-sidebar bg-dark" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="<?= site_url('dashboard') ?>" class="brand-link">
                <span class="brand-text fw-bold">Klinik Rozan</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                    <li class="nav-item"><a href="<?= site_url('dashboard') ?>" class="nav-link <?= uri_string()==='dashboard'||uri_string()===''?'active':'' ?>"><p>Dashboard</p></a></li>
                    <li class="nav-header">PELAYANAN</li>
                    <li class="nav-item"><a href="<?= site_url('module/pasien') ?>" class="nav-link <?= str_contains(uri_string(),'pasien')?'active':'' ?>"><p>Data Pasien</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/registrasi') ?>" class="nav-link <?= str_contains(uri_string(),'registrasi')?'active':'' ?>"><p>Pendaftaran</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/rawat-jalan') ?>" class="nav-link <?= str_contains(uri_string(),'rawat-jalan')?'active':'' ?>"><p>Rawat Jalan</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/igd') ?>" class="nav-link <?= str_contains(uri_string(),'igd')?'active':'' ?>"><p>IGD / Triase</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/rawat-inap') ?>" class="nav-link <?= str_contains(uri_string(),'rawat-inap')?'active':'' ?>"><p>Rawat Inap</p></a></li>
                    <li class="nav-header">PENUNJANG</li>
                    <li class="nav-item"><a href="<?= site_url('module/laboratorium') ?>" class="nav-link <?= str_contains(uri_string(),'laboratorium')?'active':'' ?>"><p>Laboratorium</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/radiologi') ?>" class="nav-link <?= str_contains(uri_string(),'radiologi')?'active':'' ?>"><p>Radiologi</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/farmasi') ?>" class="nav-link <?= str_contains(uri_string(),'farmasi')?'active':'' ?>"><p>Farmasi</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/operasi') ?>" class="nav-link <?= str_contains(uri_string(),'operasi')?'active':'' ?>"><p>Operasi</p></a></li>
                    <li class="nav-header">KEUANGAN</li>
                    <li class="nav-item"><a href="<?= site_url('module/billing') ?>" class="nav-link <?= str_contains(uri_string(),'billing')?'active':'' ?>"><p>Pembayaran</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/bpjs') ?>" class="nav-link <?= str_contains(uri_string(),'bpjs')?'active':'' ?>"><p>BPJS</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/rekam-medis') ?>" class="nav-link <?= str_contains(uri_string(),'rekam-medis')?'active':'' ?>"><p>Rekam Medis</p></a></li>
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item"><a href="<?= site_url('module/dokter') ?>" class="nav-link <?= str_contains(uri_string(),'module/dokter')?'active':'' ?>"><p>Dokter</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/poli') ?>" class="nav-link <?= str_contains(uri_string(),'module/poli')?'active':'' ?>"><p>Poliklinik</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/inventory') ?>" class="nav-link <?= str_contains(uri_string(),'inventory')?'active':'' ?>"><p>Inventory</p></a></li>
                    <li class="nav-item"><a href="<?= site_url('module/users') ?>" class="nav-link <?= str_contains(uri_string(),'users')?'active':'' ?>"><p>Pengaturan</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid py-3">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
</body>
</html>
