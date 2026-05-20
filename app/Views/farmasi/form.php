<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Resep Obat Baru</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/farmasi') ?>">Farmasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Resep Baru</li>
            </ol>
        </div>
        <a href="<?= site_url('module/farmasi') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= esc(session('error')) ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/farmasi') ?>">

    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Pasien</h3>
        </div>
        <div class="card-body p-0">
            <?php if (empty($antrian)): ?>
                <div class="app-empty-state">Belum ada pasien terdaftar hari ini.</div>
            <?php else: ?>
                <div class="list-group list-group-flush app-list-stack">
                    <?php foreach ($antrian as $i => $a): ?>
                        <label class="list-group-item app-queue-item d-flex align-items-center gap-3">
                            <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" class="form-check-input mt-0" required <?= $i === 0 ? 'checked' : '' ?>>
                            <span class="app-avatar bg-success"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="flex-grow-1"><span class="d-block fw-semibold"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></span><span class="d-block text-muted small">RM: <?= esc($a['no_rkm_medis']) ?> | Poli: <?= esc($a['kd_poli']) ?></span></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-outline card-success animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Data Resep</h3><span class="badge text-bg-success">No: <?= esc($noResep) ?></span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6 col-xl-3"><label class="form-label">No. Resep</label><input type="text" name="no_resep" value="<?= esc($noResep) ?>" class="form-control" readonly>
                    <div class="form-text">Otomatis</div>
                </div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Tanggal Resep</label><input type="date" name="tgl_peresepan" value="<?= date('Y-m-d') ?>" class="form-control"></div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Jam Resep</label><input type="time" name="jam_peresepan" value="<?= date('H:i:s') ?>" class="form-control"></div>
                <div class="col-md-6 col-xl-3"><label class="form-label">Dokter Penulis Resep <span class="text-danger">*</span></label><select name="kd_dokter" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option><?php foreach ($dokter as $d): ?><option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?></option><?php endforeach; ?>
                    </select></div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-secondary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Status Penyerahan</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">Status Resep</label><select name="status" class="form-select">
                        <option value="Belum" selected>Belum Disiapkan</option>
                        <option value="Sudah">Sudah Diserahkan</option>
                    </select></div>
                <div class="col-md-4"><label class="form-label">Tanggal Penyerahan</label><input type="date" name="tgl_penyerahan" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Jam Penyerahan</label><input type="time" name="jam_penyerahan" class="form-control"></div>
            </div>
        </div>
    </div>

    <!-- HIDDEN -->
    <input type="hidden" name="tgl_perawatan" value="<?= date('Y-m-d') ?>">
    <input type="hidden" name="jam" value="<?= date('H:i:s') ?>">

    <div class="card card-outline card-success animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Simpan Resep Obat</h3>
                <p class="text-muted mb-0 small">Resep akan dikirim ke unit farmasi untuk disiapkan.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-success">Simpan Resep</button>
                <a href="<?= site_url('module/farmasi') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>

</form>

<?= $this->endSection() ?>