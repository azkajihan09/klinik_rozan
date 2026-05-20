<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Pemeriksaan Rawat Jalan</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/rawat-jalan') ?>">Rawat Jalan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Pemeriksaan</li>
            </ol>
        </div>
        <a href="<?= site_url('module/rawat-jalan') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Kembali
        </a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/rawat-jalan') ?>" id="form-ralan">
    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Pasien dari Antrian Hari Ini</h3>
            <span class="badge text-bg-info"><?= count($antrian) ?> pasien</span>
        </div>
        <div class="card-body p-0">
            <?php if (empty($antrian)): ?>
                <div class="app-empty-state">
                    <p class="mb-2">Belum ada antrian hari ini.</p>
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
                                <span class="d-block text-muted small">RM: <?= esc($a['no_rkm_medis']) ?> | <?= $a['jk'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> | Poli: <?= esc($a['kd_poli']) ?> | Dr: <?= esc($a['kd_dokter']) ?></span>
                            </span>
                            <?php if ($a['stts'] === 'Sudah'): ?>
                                <span class="badge text-bg-success">Selesai</span>
                            <?php elseif ($a['stts'] === 'Berkas Diterima'): ?>
                                <span class="badge text-bg-info">Proses</span>
                            <?php else: ?>
                                <span class="badge text-bg-warning">Menunggu</span>
                            <?php endif; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card card-outline card-success animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Tanda Vital</h3>
            <span class="text-muted small">Diisi oleh perawat atau dokter</span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4 col-xl-2"><label class="form-label">Tekanan Darah</label><input type="text" name="tensi" class="form-control" placeholder="120/80"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Suhu (°C)</label><input type="number" step="0.1" name="suhu_tubuh" class="form-control" placeholder="36.5"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Nadi</label><input type="number" name="nadi" class="form-control" placeholder="80"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Respirasi</label><input type="number" name="respirasi" class="form-control" placeholder="20"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">SpO2 (%)</label><input type="number" name="spo2" class="form-control" placeholder="98"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Tinggi (cm)</label><input type="number" name="tinggi" class="form-control" placeholder="165"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Berat (kg)</label><input type="number" name="berat" class="form-control" placeholder="60"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">GCS</label><input type="number" name="gcs" class="form-control" value="15"></div>
                <div class="col-md-4 col-xl-4"><label class="form-label">Kesadaran</label><select name="kesadaran" class="form-select">
                        <option value="Compos Mentis" selected>Compos Mentis</option>
                        <option value="Somnolence">Somnolence</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Coma">Coma</option>
                        <option value="Apatis">Apatis</option>
                    </select></div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pemeriksaan (SOAP)</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-6"><label class="form-label">S - Keluhan Utama <span class="text-danger">*</span></label><textarea name="keluhan" class="form-control" rows="3" placeholder="Keluhan yang dirasakan pasien..." required></textarea></div>
                <div class="col-lg-6"><label class="form-label">O - Pemeriksaan Fisik</label><textarea name="pemeriksaan" class="form-control" rows="3" placeholder="Hasil pemeriksaan fisik..."></textarea></div>
                <div class="col-lg-6"><label class="form-label">A - Penilaian / Diagnosa <span class="text-danger">*</span></label><textarea name="penilaian" class="form-control" rows="3" placeholder="Diagnosa kerja..." required></textarea></div>
                <div class="col-lg-6"><label class="form-label">P - Rencana Tindak Lanjut</label><textarea name="rtl" class="form-control" rows="3" placeholder="Terapi, rujukan, kontrol ulang..."></textarea></div>
                <div class="col-lg-4"><label class="form-label">Alergi</label><input type="text" name="alergi" class="form-control" placeholder="Obat/makanan yang alergi"></div>
                <div class="col-lg-4"><label class="form-label">Instruksi</label><textarea name="instruksi" class="form-control" rows="2" placeholder="Instruksi untuk pasien..."></textarea></div>
                <div class="col-lg-4"><label class="form-label">Evaluasi</label><textarea name="evaluasi" class="form-control" rows="2" placeholder="Evaluasi..."></textarea></div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-secondary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Waktu dan Petugas</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">Tanggal Perawatan</label><input type="date" name="tgl_perawatan" value="<?= date('Y-m-d') ?>" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Jam Rawat</label><input type="time" name="jam_rawat" value="<?= date('H:i:s') ?>" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">NIP Petugas / Dokter</label><input type="text" name="nip" class="form-control" placeholder="NIP pemeriksa" value="<?= esc(session('username') ?? '') ?>"></div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Simpan Hasil Pemeriksaan</h3>
                <p class="text-muted mb-0 small">Data pemeriksaan akan tersimpan ke rekam medis pasien.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                <a href="<?= site_url('module/rawat-jalan') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>