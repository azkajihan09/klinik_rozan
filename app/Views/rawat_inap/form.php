<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Admisi Rawat Inap</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/rawat-inap') ?>">Rawat Inap</a></li>
                <li class="breadcrumb-item active" aria-current="page">Masuk Kamar</li>
            </ol>
        </div>
        <a href="<?= site_url('module/rawat-inap') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/rawat-inap') ?>">

    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Pasien</h3>
            <span class="badge text-bg-info"><?= count($antrian) ?> pasien hari ini</span>
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
                            <span class="app-avatar bg-primary"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="flex-grow-1">
                                <span class="d-block fw-semibold"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></span>
                                <span class="d-block text-muted small">RM: <?= esc($a['no_rkm_medis']) ?> | <?= $a['jk'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> | Dr: <?= esc($a['kd_dokter']) ?></span>
                            </span>
                            <span class="badge text-bg-secondary"><?= esc($a['status_lanjut']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-outline card-info animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Kamar</h3>
            <span class="badge text-bg-success"><?= count($kamar) ?> kamar tersedia</span>
        </div>
        <div class="card-body">
            <?php if (empty($kamar)): ?>
                <div class="app-empty-state">Semua kamar penuh.</div>
            <?php else: ?>
                <div class="row g-3">
                    <?php foreach ($kamar as $i => $k): ?>
                        <div class="col-lg-4 col-md-6">
                            <label class="border rounded p-3 h-100 d-block app-queue-item">
                                <div class="d-flex align-items-start gap-2 mb-2">
                                    <input type="radio" name="kd_kamar" value="<?= esc($k['kd_kamar']) ?>" class="form-check-input mt-1" required <?= $i === 0 ? 'checked' : '' ?> data-tarif="<?= esc($k['trf_kamar']) ?>">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold"><?= esc($k['kd_kamar']) ?></div>
                                        <div class="text-muted small"><?= esc($k['nm_bangsal'] ?? $k['kd_bangsal']) ?> | <?= esc($k['kelas'] ?? '-') ?></div>
                                    </div>
                                </div>
                                <div class="small">Tarif: <strong>Rp <?= number_format((float)$k['trf_kamar'], 0, ',', '.') ?></strong>/hari</div>
                                <span class="badge text-bg-success mt-2">Tersedia</span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <input type="hidden" name="trf_kamar" id="trf_kamar" value="<?= esc($kamar[0]['trf_kamar'] ?? '0') ?>">
        </div>
    </div>

    <div class="card card-outline card-secondary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Diagnosa dan Waktu Masuk</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-6"><label class="form-label">Diagnosa Awal <span class="text-danger">*</span></label><textarea name="diagnosa_awal" class="form-control" rows="2" placeholder="Diagnosa saat masuk rawat inap..." required></textarea></div>
                <div class="col-lg-6"><label class="form-label">Diagnosa Akhir</label><textarea name="diagnosa_akhir" class="form-control" rows="2" placeholder="Diisi saat pasien pulang..."></textarea></div>
                <div class="col-md-6"><label class="form-label">Tanggal Masuk</label><input type="date" name="tgl_masuk" value="<?= date('Y-m-d') ?>" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Jam Masuk</label><input type="time" name="jam_masuk" value="<?= date('H:i:s') ?>" class="form-control"></div>
            </div>
        </div>
    </div>

    <!-- HIDDEN DEFAULTS -->
    <input type="hidden" name="tgl_keluar" value="">
    <input type="hidden" name="jam_keluar" value="">
    <input type="hidden" name="lama" value="0">
    <input type="hidden" name="ttl_biaya" value="0">
    <input type="hidden" name="stts_pulang" value="-">

    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Konfirmasi Masuk Rawat Inap</h3>
                <p class="text-muted mb-0 small">Pasien akan masuk ke kamar yang dipilih. Tarif kamar dihitung per hari.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Masukkan Pasien</button>
                <a href="<?= site_url('module/rawat-inap') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>

</form>

<script>
    document.querySelectorAll('input[name="kd_kamar"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('trf_kamar').value = this.dataset.tarif;
        });
    });
</script>

<?= $this->endSection() ?>