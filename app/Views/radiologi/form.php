<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Order Pemeriksaan Radiologi</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/radiologi') ?>">Radiologi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Baru</li>
            </ol>
        </div>
        <a href="<?= site_url('module/radiologi') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= esc(session('error')) ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/radiologi') ?>">

    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Pasien</h3><span class="badge text-bg-info"><?= count($antrian) ?> pasien hari ini</span>
        </div>
        <div class="card-body p-0">
            <?php if (empty($antrian)): ?>
                <div class="app-empty-state">
                    <p class="mb-2">Belum ada pasien terdaftar hari ini.</p>
                    <a href="<?= site_url('module/registrasi/new') ?>" class="btn btn-primary btn-sm">Registrasi Pasien</a>
                </div>
            <?php else: ?>
                <div class="list-group list-group-flush app-list-stack">
                    <?php foreach ($antrian as $i => $a): ?>
                        <label class="list-group-item app-queue-item d-flex align-items-center gap-3">
                            <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" class="form-check-input mt-0" required <?= $i === 0 ? 'checked' : '' ?>>
                            <span class="app-avatar bg-warning"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="flex-grow-1"><span class="d-block fw-semibold"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></span><span class="d-block text-muted small">RM: <?= esc($a['no_rkm_medis']) ?> | <?= $a['jk'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> | Poli: <?= esc($a['kd_poli']) ?></span></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-outline card-warning animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Data Permintaan Radiologi</h3><span class="badge text-bg-warning">No: <?= esc($noOrder) ?></span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6 col-xl-3"><label class="form-label">No. Order</label><input type="text" name="noorder" value="<?= esc($noOrder) ?>" class="form-control" readonly>
                    <div class="form-text">Otomatis</div>
                </div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Tanggal Permintaan</label><input type="date" name="tgl_permintaan" value="<?= date('Y-m-d') ?>" class="form-control"></div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Jam Permintaan</label><input type="time" name="jam_permintaan" value="<?= date('H:i:s') ?>" class="form-control"></div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Asal Permintaan <span class="text-danger">*</span></label><select name="status" class="form-select" required>
                        <option value="ralan">Rawat Jalan</option>
                        <option value="ranap">Rawat Inap</option>
                    </select></div>
                <div class="col-md-6"><label class="form-label">Dokter Perujuk <span class="text-danger">*</span></label><select name="dokter_perujuk" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option><?php foreach ($dokter as $d): ?><option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?></option><?php endforeach; ?>
                    </select></div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Diagnosa dan Informasi Klinis</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-6"><label class="form-label">Diagnosa Klinis <span class="text-danger">*</span></label><textarea name="diagnosa_klinis" class="form-control" rows="3" placeholder="Diagnosa klinis / indikasi pemeriksaan radiologi..." required></textarea></div>
                <div class="col-lg-6"><label class="form-label">Informasi Tambahan</label><textarea name="informasi_tambahan" class="form-control" rows="3" placeholder="Jenis pemeriksaan, catatan khusus, dll..."></textarea></div>
            </div>
        </div>
    </div>

    <!-- HIDDEN (field yang belum diisi saat order baru) -->
    <input type="hidden" name="tgl_sampel" value="0000-00-00">
    <input type="hidden" name="jam_sampel" value="00:00:00">
    <input type="hidden" name="tgl_hasil" value="0000-00-00">
    <input type="hidden" name="jam_hasil" value="00:00:00">

    <div class="card card-outline card-warning animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Kirim Permintaan Radiologi</h3>
                <p class="text-muted mb-0 small">Order akan dikirim ke unit radiologi untuk dijadwalkan.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Kirim Order Radiologi</button>
                <a href="<?= site_url('module/radiologi') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>

</form>

<?= $this->endSection() ?>