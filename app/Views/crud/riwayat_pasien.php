<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Riwayat Pasien</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/pasien') ?>">Pasien</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
            </ol>
        </div>
        <a href="<?= site_url('module/pasien') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (!$pasien): ?>
    <div class="card">
        <div class="app-empty-state">Pasien tidak ditemukan.</div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body d-flex align-items-center gap-3 flex-wrap">
            <span class="app-avatar app-avatar-lg bg-success"><?= strtoupper(substr($pasien['nm_pasien'] ?? 'P', 0, 1)) ?></span>
            <div>
                <h2 class="h4 mb-1"><?= esc($pasien['nm_pasien']) ?></h2>
                <div class="text-muted small">
                    <span class="badge text-bg-info"><?= esc($pasien['no_rkm_medis']) ?></span>
                    | <?= esc($pasien['jk'] === 'L' ? 'Laki-laki' : 'Perempuan') ?>
                    | <?= esc($pasien['alamat'] ?? '-') ?>
                    | <?= esc($pasien['no_tlp'] ?? '-') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header app-card-header">
            <h3 class="card-title">Riwayat Kunjungan</h3>
            <span class="badge text-bg-info"><?= count($kunjungan) ?> kunjungan</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No Rawat</th>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kunjungan)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat kunjungan.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($kunjungan as $r): ?>
                            <tr>
                                <td><code><?= esc($r['no_rawat']) ?></code></td>
                                <td><?= esc($r['tgl_registrasi']) ?> <span class="text-muted small"><?= esc($r['jam_reg']) ?></span></td>
                                <td><?= esc($r['kd_dokter']) ?></td>
                                <td><?= esc($r['kd_poli']) ?></td>
                                <td>
                                    <?php if ($r['status_lanjut'] === 'Ralan'): ?>
                                        <span class="badge text-bg-success">Rawat Jalan</span>
                                    <?php elseif ($r['status_lanjut'] === 'Ranap'): ?>
                                        <span class="badge text-bg-warning">Rawat Inap</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-info"><?= esc($r['status_lanjut']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($r['status_bayar'] === 'Sudah Bayar'): ?>
                                        <span class="badge text-bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-warning"><?= esc($r['status_bayar']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('billing/hitung/' . rawurlencode($r['no_rawat'])) ?>" class="btn btn-outline-secondary btn-sm">Billing</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>