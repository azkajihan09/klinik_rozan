<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0">
        <h1 class="mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Ringkasan operasional klinik untuk hari ini.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm">
            <span class="info-box-icon text-bg-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                </svg>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pasien</span>
                <span class="info-box-number"><?= number_format($stats['Pasien'] ?? 0) ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm">
            <span class="info-box-icon text-bg-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Kunjungan Hari Ini</span>
                <span class="info-box-number"><?= number_format($stats['Registrasi Hari Ini'] ?? 0) ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm">
            <span class="info-box-icon text-bg-warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Dokter Aktif</span>
                <span class="info-box-number"><?= number_format($stats['Dokter Aktif'] ?? 0) ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="info-box shadow-sm">
            <span class="info-box-icon text-bg-danger">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                </svg>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Antrian Berjalan</span>
                <span class="info-box-number"><?= number_format($stats['Rawat Jalan Hari Ini'] ?? 0) ?></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-outline card-primary animate-fade-up">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang di SIMRS Klinik Rozan</h3>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Sistem informasi manajemen rumah sakit terintegrasi untuk pelayanan kesehatan yang lebih cepat, rapi, dan akurat.</p>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="small-box text-bg-primary mb-0">
                            <div class="inner">
                                <h3><?= number_format($stats['Billing Hari Ini'] ?? 0) ?></h3>
                                <p>Transaksi Hari Ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box text-bg-success mb-0">
                            <div class="inner">
                                <h3><?= number_format($stats['Rawat Inap Aktif'] ?? 0) ?></h3>
                                <p>Rawat Inap Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box text-bg-warning mb-0">
                            <div class="inner">
                                <h3><?= number_format($stats['Resep Hari Ini'] ?? 0) ?></h3>
                                <p>Resep Hari Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card animate-fade-up">
            <div class="card-header">
                <h3 class="card-title">Antrian Pasien Hari Ini</h3>
                <a href="<?= site_url('module/registrasi') ?>" class="btn btn-outline-secondary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($antrian)): ?>
                                <?php foreach ($antrian as $i => $a): ?>
                                    <tr>
                                        <td><strong><?= str_pad((string)($i + 1), 3, '0', STR_PAD_LEFT) ?></strong></td>
                                        <td><?= esc($a['no_rkm_medis']) ?></td>
                                        <td><?= esc($a['kd_poli']) ?></td>
                                        <td><?= esc($a['kd_dokter']) ?></td>
                                        <td>
                                            <?php if ($a['stts'] === 'Sudah'): ?>
                                                <span class="badge text-bg-success">Selesai</span>
                                            <?php elseif ($a['stts'] === 'Berkas Diterima'): ?>
                                                <span class="badge text-bg-info">Proses</span>
                                            <?php else: ?>
                                                <span class="badge text-bg-warning">Menunggu</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada antrian hari ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-outline card-info animate-fade-up">
            <div class="card-header">
                <h3 class="card-title">Pelayanan Cepat</h3>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush app-list-stack">
                    <a href="<?= site_url('module/pasien/new') ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                        <span class="app-icon-chip bg-primary-subtle text-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <line x1="20" y1="8" x2="20" y2="14" />
                                <line x1="23" y1="11" x2="17" y2="11" />
                            </svg>
                        </span>
                        <span class="flex-grow-1">
                            <span class="d-block fw-semibold">Pendaftaran Pasien</span>
                            <span class="d-block text-muted small">Daftar pasien baru</span>
                        </span>
                    </a>
                    <a href="<?= site_url('module/registrasi/new') ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                        <span class="app-icon-chip bg-info-subtle text-info">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </span>
                        <span class="flex-grow-1">
                            <span class="d-block fw-semibold">Registrasi</span>
                            <span class="d-block text-muted small">Daftar kunjungan pasien</span>
                        </span>
                    </a>
                    <a href="<?= site_url('module/rekam-medis') ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                        <span class="app-icon-chip bg-success-subtle text-success">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </span>
                        <span class="flex-grow-1">
                            <span class="d-block fw-semibold">Rekam Medis</span>
                            <span class="d-block text-muted small">Akses berkas digital</span>
                        </span>
                    </a>
                    <a href="<?= site_url('module/billing') ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                        <span class="app-icon-chip bg-warning-subtle text-warning">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" />
                                <line x1="1" y1="10" x2="23" y2="10" />
                            </svg>
                        </span>
                        <span class="flex-grow-1">
                            <span class="d-block fw-semibold">Pembayaran</span>
                            <span class="d-block text-muted small">Billing dan kasir</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card animate-fade-up">
            <div class="card-header">
                <h3 class="card-title">Dokter Aktif</h3>
                <a href="<?= site_url('module/dokter') ?>" class="btn btn-outline-secondary btn-sm">Semua</a>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($dokter_list)): ?>
                    <?php $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info', 'bg-secondary']; ?>
                    <div class="list-group list-group-flush app-list-stack">
                        <?php foreach ($dokter_list as $i => $d): ?>
                            <div class="list-group-item d-flex align-items-center gap-3">
                                <span class="app-avatar <?= esc($colors[$i % count($colors)]) ?>">
                                    <?= strtoupper(substr($d['nm_dokter'] ?? 'D', 0, 1)) ?>
                                </span>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold"><?= esc($d['nm_dokter']) ?></div>
                                    <div class="text-muted small"><?= esc($d['kd_sps'] ?? 'Umum') ?></div>
                                </div>
                                <span class="badge text-bg-success">Aktif</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="app-empty-state">Belum ada data dokter.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-6">
        <div class="small-box text-bg-pink animate-fade-up">
            <div class="inner">
                <h3><?= number_format($stats['Resep Hari Ini'] ?? 0) ?></h3>
                <p>Resep Hari Ini</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="small-box text-bg-info animate-fade-up">
            <div class="inner">
                <h3><?= number_format($stats['Order Lab Hari Ini'] ?? 0) ?></h3>
                <p>Order Laboratorium</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="small-box text-bg-warning animate-fade-up">
            <div class="inner">
                <h3><?= number_format($stats['Order Radiologi Hari Ini'] ?? 0) ?></h3>
                <p>Order Radiologi</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>