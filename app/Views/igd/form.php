<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1">Triase dan Pemeriksaan IGD</h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/igd') ?>">IGD / Triase</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Triase</li>
            </ol>
        </div>
        <a href="<?= site_url('module/igd') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= esc(session('error')) ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/igd') ?>">

    <div class="card card-outline card-danger animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Pilih Pasien</h3><span class="badge text-bg-info"><?= count($antrian) ?> pasien terdaftar hari ini</span>
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
                            <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" class="form-check-input mt-0" required <?= $i === 0 ? 'checked' : '' ?> data-rm="<?= esc($a['no_rkm_medis']) ?>">
                            <span class="app-avatar bg-danger"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="flex-grow-1"><span class="d-block fw-semibold"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></span><span class="d-block text-muted small">RM: <?= esc($a['no_rkm_medis']) ?> | <?= $a['jk'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> | <?= esc($a['kd_poli']) ?> | Dr: <?= esc($a['kd_dokter']) ?></span></span>
                            <span class="badge text-bg-secondary"><?= esc($a['status_lanjut']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <input type="hidden" name="no_rkm_medis" id="no_rkm_medis" value="<?= esc($antrian[0]['no_rkm_medis'] ?? '') ?>">
        </div>
    </div>

    <div class="card card-outline card-warning animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Primary Survey (ABC)</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">A - Airway</label><select name="airway" class="form-select">
                        <option value="Bebas">Bebas</option>
                        <option value="Sumbatan Parsial">Sumbatan Parsial</option>
                        <option value="Sumbatan Total">Sumbatan Total</option>
                    </select></div>
                <div class="col-md-4"><label class="form-label">B - Breathing</label><select name="breathing" class="form-select">
                        <option value="Spontan">Spontan</option>
                        <option value="Sesak Ringan">Sesak Ringan</option>
                        <option value="Sesak Berat">Sesak Berat</option>
                        <option value="Apnea">Apnea</option>
                    </select></div>
                <div class="col-md-4"><label class="form-label">C - Circulation</label><select name="circulation" class="form-select">
                        <option value="Baik">Baik</option>
                        <option value="Akral Dingin">Akral Dingin</option>
                        <option value="Syok">Syok</option>
                        <option value="Henti Jantung">Henti Jantung</option>
                    </select></div>
            </div>
        </div>
    </div>

    <!-- STEP 3: TANDA VITAL -->
    <div class="card card-outline card-info animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Tanda Vital</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4 col-xl-2"><label class="form-label">Tekanan Darah</label><input type="text" name="tekanan_darah" class="form-control" placeholder="120/80"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Nadi</label><input type="number" name="nadi" class="form-control" placeholder="80"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Respirasi</label><input type="number" name="respirasi" class="form-control" placeholder="20"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">Suhu (°C)</label><input type="number" step="0.1" name="suhu" class="form-control" placeholder="36.5"></div>
                <div class="col-md-4 col-xl-2"><label class="form-label">SpO2 (%)</label><input type="number" name="spo2" class="form-control" placeholder="98"></div>
            </div>
        </div>
    </div>

    <!-- STEP 4: GCS -->
    <div class="card card-outline card-secondary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Glasgow Coma Scale (GCS)</h3><span class="badge text-bg-info" id="gcs-total">GCS: 15</span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="form-group">
                    <label class="form-label">Eye (E)</label>
                    <select name="gcs_e" class="form-select gcs-input" id="gcs-e">
                        <option value="4">4 - Spontan</option>
                        <option value="3">3 - Terhadap suara</option>
                        <option value="2">2 - Terhadap nyeri</option>
                        <option value="1">1 - Tidak ada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Verbal (V)</label>
                    <select name="gcs_v" class="form-select gcs-input" id="gcs-v">
                        <option value="5">5 - Orientasi baik</option>
                        <option value="4">4 - Bingung</option>
                        <option value="3">3 - Kata tidak tepat</option>
                        <option value="2">2 - Suara tanpa arti</option>
                        <option value="1">1 - Tidak ada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Motorik (M)</label>
                    <select name="gcs_m" class="form-select gcs-input" id="gcs-m">
                        <option value="6">6 - Mengikuti perintah</option>
                        <option value="5">5 - Melokalisir nyeri</option>
                        <option value="4">4 - Fleksi normal</option>
                        <option value="3">3 - Fleksi abnormal</option>
                        <option value="2">2 - Ekstensi</option>
                        <option value="1">1 - Tidak ada</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-4"><label class="form-label">Kesadaran</label><select name="kesadaran" class="form-select" id="kesadaran-field">
                        <option value="Compos Mentis">Compos Mentis (GCS 14-15)</option>
                        <option value="Apatis">Apatis (GCS 12-13)</option>
                        <option value="Somnolence">Somnolence (GCS 10-11)</option>
                        <option value="Sopor">Sopor (GCS 7-9)</option>
                        <option value="Coma">Coma (GCS 3-6)</option>
                    </select></div>
            </div>
        </div>
    </div>

    <!-- STEP 5: KATEGORI TRIASE -->
    <div class="card card-outline card-danger animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Kategori dan Skala Triase</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-6"><label class="form-label">Kategori Triase <span class="text-danger">*</span></label>
                    <div class="d-grid gap-2">
                        <label class="form-check border rounded p-3 bg-danger-subtle"><input type="radio" name="kategori" value="Merah" class="form-check-input" required><span class="ms-2 fw-semibold">Merah</span><span class="ms-2 small text-muted">Gawat Darurat</span></label>
                        <label class="form-check border rounded p-3 bg-warning-subtle"><input type="radio" name="kategori" value="Kuning" class="form-check-input"><span class="ms-2 fw-semibold">Kuning</span><span class="ms-2 small text-muted">Urgent</span></label>
                        <label class="form-check border rounded p-3 bg-success-subtle"><input type="radio" name="kategori" value="Hijau" class="form-check-input"><span class="ms-2 fw-semibold">Hijau</span><span class="ms-2 small text-muted">Tidak Gawat</span></label>
                        <label class="form-check border rounded p-3 bg-dark-subtle"><input type="radio" name="kategori" value="Hitam" class="form-check-input"><span class="ms-2 fw-semibold">Hitam</span><span class="ms-2 small text-muted">Meninggal / DOA</span></label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Skala Triase (1-5)</label><select name="skala_triase" class="form-select">
                                <option value="1">1 - Resusitasi (Segera)</option>
                                <option value="2">2 - Emergensi (&lt; 10 menit)</option>
                                <option value="3" selected>3 - Urgent (&lt; 30 menit)</option>
                                <option value="4">4 - Semi-Urgent (&lt; 60 menit)</option>
                                <option value="5">5 - Non-Urgent (&lt; 120 menit)</option>
                            </select></div>
                        <div class="col-12"><label class="form-label">Keluhan Utama <span class="text-danger">*</span></label><textarea name="keluhan_utama" class="form-control" rows="3" placeholder="Keluhan utama pasien saat datang ke IGD..." required></textarea></div>
                        <div class="col-12"><label class="form-label">Diagnosa Awal</label><textarea name="diagnosa_awal" class="form-control" rows="2" placeholder="Diagnosa awal / kesan..."></textarea></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HIDDEN -->
    <input type="hidden" name="tgl_triase" value="<?= date('Y-m-d H:i:s') ?>">
    <input type="hidden" name="petugas_id" value="<?= esc(session('username') ?? '') ?>">

    <div class="card card-outline card-danger animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Simpan Data Triase IGD</h3>
                <p class="text-muted mb-0 small">Pastikan kategori triase dan tanda vital sudah benar.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-danger">Simpan Triase</button>
                <a href="<?= site_url('module/igd') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>

</form>

<script>
    document.querySelectorAll('input[name="no_rawat"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('no_rkm_medis').value = this.dataset.rm;
        });
    });

    function hitungGCS() {
        const e = parseInt(document.getElementById('gcs-e').value) || 0;
        const v = parseInt(document.getElementById('gcs-v').value) || 0;
        const m = parseInt(document.getElementById('gcs-m').value) || 0;
        const total = e + v + m;
        document.getElementById('gcs-total').textContent = 'GCS: ' + total;

        // Auto-set kesadaran
        const kes = document.getElementById('kesadaran-field');
        if (total >= 14) kes.value = 'Compos Mentis';
        else if (total >= 12) kes.value = 'Apatis';
        else if (total >= 10) kes.value = 'Somnolence';
        else if (total >= 7) kes.value = 'Sopor';
        else kes.value = 'Coma';
    }
    document.querySelectorAll('.gcs-input').forEach(el => el.addEventListener('change', hitungGCS));
</script>

<?= $this->endSection() ?>