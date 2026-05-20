<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>🚨 Triase & Pemeriksaan IGD</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/igd') ?>">IGD / Triase</a> /
            Input Triase
        </p>
    </div>
    <a href="<?= site_url('module/igd') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/igd') ?>">

<!-- STEP 1: PILIH PASIEN -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            Pilih Pasien
        </h3>
        <span class="badge badge-info"><?= count($antrian) ?> pasien terdaftar hari ini</span>
    </div>

    <?php if(empty($antrian)): ?>
        <div style="text-align:center;padding:32px;color:var(--text-muted,#64748b)">
            <p style="font-size:14px;font-weight:500">Belum ada pasien terdaftar hari ini</p>
            <p style="font-size:12px;margin-top:4px">Daftarkan pasien melalui <a href="<?= site_url('module/registrasi/new') ?>" style="color:var(--primary,#0891b2);font-weight:600">Registrasi</a> terlebih dahulu.</p>
        </div>
    <?php else: ?>
        <div style="display:grid;gap:8px;max-height:250px;overflow-y:auto;padding:4px">
            <?php foreach($antrian as $i => $a): ?>
                <label class="antrian-item" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s">
                    <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" style="width:18px;height:18px;accent-color:#ef4444" required <?= $i === 0 ? 'checked' : '' ?>
                        data-rm="<?= esc($a['no_rkm_medis']) ?>">
                    <div style="width:38px;height:38px;border-radius:10px;background:#fee2e2;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:#991b1b">
                        <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:14px"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></div>
                        <div style="font-size:11px;color:var(--text-muted,#64748b)">
                            RM: <?= esc($a['no_rkm_medis']) ?> &middot;
                            <?= $a['jk'] === 'L' ? 'L' : 'P' ?> &middot;
                            <?= esc($a['kd_poli']) ?> &middot;
                            Dr: <?= esc($a['kd_dokter']) ?>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-size:12px;color:var(--text-muted,#64748b)"><?= esc($a['jam_reg']) ?></div>
                        <span class="badge badge-<?= $a['status_lanjut'] === 'Ranap' ? 'warning' : 'info' ?>"><?= esc($a['status_lanjut']) ?></span>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="hidden" name="no_rkm_medis" id="no_rkm_medis" value="<?= esc($antrian[0]['no_rkm_medis'] ?? '') ?>">
</div>

<!-- STEP 2: TRIASE - PRIMARY SURVEY -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            Primary Survey (ABC)
        </h3>
    </div>
    <div class="form-grid" style="grid-template-columns:1fr 1fr 1fr">
        <div class="form-group">
            <label class="form-label">A - Airway</label>
            <select name="airway" class="form-control">
                <option value="Bebas">Bebas</option>
                <option value="Sumbatan Parsial">Sumbatan Parsial</option>
                <option value="Sumbatan Total">Sumbatan Total</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">B - Breathing</label>
            <select name="breathing" class="form-control">
                <option value="Spontan">Spontan</option>
                <option value="Sesak Ringan">Sesak Ringan</option>
                <option value="Sesak Berat">Sesak Berat</option>
                <option value="Apnea">Apnea</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">C - Circulation</label>
            <select name="circulation" class="form-control">
                <option value="Baik">Baik</option>
                <option value="Akral Dingin">Akral Dingin</option>
                <option value="Syok">Syok</option>
                <option value="Henti Jantung">Henti Jantung</option>
            </select>
        </div>
    </div>
</div>

<!-- STEP 3: TANDA VITAL -->
<div class="card animate-fade-up" style="animation-delay:.15s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 12h18"/></svg>
            Tanda Vital
        </h3>
    </div>
    <div class="form-grid" style="grid-template-columns:repeat(auto-fit,minmax(140px,1fr))">
        <div class="form-group">
            <label class="form-label">Tekanan Darah</label>
            <input type="text" name="tekanan_darah" class="form-control" placeholder="120/80">
        </div>
        <div class="form-group">
            <label class="form-label">Nadi (x/mnt)</label>
            <input type="number" name="nadi" class="form-control" placeholder="80">
        </div>
        <div class="form-group">
            <label class="form-label">Respirasi (x/mnt)</label>
            <input type="number" name="respirasi" class="form-control" placeholder="20">
        </div>
        <div class="form-group">
            <label class="form-label">Suhu (°C)</label>
            <input type="number" step="0.1" name="suhu" class="form-control" placeholder="36.5">
        </div>
        <div class="form-group">
            <label class="form-label">SpO2 (%)</label>
            <input type="number" name="spo2" class="form-control" placeholder="98">
        </div>
    </div>
</div>

<!-- STEP 4: GCS -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            Glasgow Coma Scale (GCS)
        </h3>
        <span class="badge badge-info" id="gcs-total">GCS: 15</span>
    </div>
    <div class="form-grid" style="grid-template-columns:1fr 1fr 1fr">
        <div class="form-group">
            <label class="form-label">Eye (E)</label>
            <select name="gcs_e" class="form-control gcs-input" id="gcs-e">
                <option value="4">4 - Spontan</option>
                <option value="3">3 - Terhadap suara</option>
                <option value="2">2 - Terhadap nyeri</option>
                <option value="1">1 - Tidak ada</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Verbal (V)</label>
            <select name="gcs_v" class="form-control gcs-input" id="gcs-v">
                <option value="5">5 - Orientasi baik</option>
                <option value="4">4 - Bingung</option>
                <option value="3">3 - Kata tidak tepat</option>
                <option value="2">2 - Suara tanpa arti</option>
                <option value="1">1 - Tidak ada</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Motorik (M)</label>
            <select name="gcs_m" class="form-control gcs-input" id="gcs-m">
                <option value="6">6 - Mengikuti perintah</option>
                <option value="5">5 - Melokalisir nyeri</option>
                <option value="4">4 - Fleksi normal</option>
                <option value="3">3 - Fleksi abnormal</option>
                <option value="2">2 - Ekstensi</option>
                <option value="1">1 - Tidak ada</option>
            </select>
        </div>
    </div>
    <div class="form-group" style="margin-top:12px">
        <label class="form-label">Kesadaran</label>
        <select name="kesadaran" class="form-control" id="kesadaran-field" style="max-width:300px">
            <option value="Compos Mentis">Compos Mentis (GCS 14-15)</option>
            <option value="Apatis">Apatis (GCS 12-13)</option>
            <option value="Somnolence">Somnolence (GCS 10-11)</option>
            <option value="Sopor">Sopor (GCS 7-9)</option>
            <option value="Coma">Coma (GCS 3-6)</option>
        </select>
    </div>
</div>

<!-- STEP 5: KATEGORI TRIASE -->
<div class="card animate-fade-up" style="animation-delay:.25s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Kategori & Skala Triase
        </h3>
    </div>
    <div class="form-grid" style="grid-template-columns:1fr 1fr">
        <div class="form-group">
            <label class="form-label">Kategori Triase <span style="color:#ef4444">*</span></label>
            <div style="display:grid;gap:8px">
                <label style="display:flex;align-items:center;gap:10px;padding:10px 14px;border:2px solid #fee2e2;border-radius:8px;cursor:pointer;transition:.2s;background:#fff5f5">
                    <input type="radio" name="kategori" value="Merah" style="accent-color:#ef4444" required>
                    <span style="width:12px;height:12px;border-radius:50%;background:#ef4444"></span>
                    <span style="font-weight:600;font-size:13px">MERAH</span>
                    <span style="font-size:11px;color:var(--text-muted,#64748b)">- Gawat Darurat (Resusitasi)</span>
                </label>
                <label style="display:flex;align-items:center;gap:10px;padding:10px 14px;border:2px solid #fef3c7;border-radius:8px;cursor:pointer;transition:.2s;background:#fffbeb">
                    <input type="radio" name="kategori" value="Kuning" style="accent-color:#f59e0b">
                    <span style="width:12px;height:12px;border-radius:50%;background:#f59e0b"></span>
                    <span style="font-weight:600;font-size:13px">KUNING</span>
                    <span style="font-size:11px;color:var(--text-muted,#64748b)">- Gawat Tidak Darurat (Urgent)</span>
                </label>
                <label style="display:flex;align-items:center;gap:10px;padding:10px 14px;border:2px solid #dcfce7;border-radius:8px;cursor:pointer;transition:.2s;background:#f0fdf4">
                    <input type="radio" name="kategori" value="Hijau" style="accent-color:#16a34a">
                    <span style="width:12px;height:12px;border-radius:50%;background:#16a34a"></span>
                    <span style="font-weight:600;font-size:13px">HIJAU</span>
                    <span style="font-size:11px;color:var(--text-muted,#64748b)">- Tidak Gawat Tidak Darurat</span>
                </label>
                <label style="display:flex;align-items:center;gap:10px;padding:10px 14px;border:2px solid #1e293b;border-radius:8px;cursor:pointer;transition:.2s;background:#f8fafc">
                    <input type="radio" name="kategori" value="Hitam" style="accent-color:#1e293b">
                    <span style="width:12px;height:12px;border-radius:50%;background:#1e293b"></span>
                    <span style="font-weight:600;font-size:13px">HITAM</span>
                    <span style="font-size:11px;color:var(--text-muted,#64748b)">- Meninggal / DOA</span>
                </label>
            </div>
        </div>
        <div>
            <div class="form-group">
                <label class="form-label">Skala Triase (1-5)</label>
                <select name="skala_triase" class="form-control">
                    <option value="1">1 - Resusitasi (Segera)</option>
                    <option value="2">2 - Emergensi (&lt; 10 menit)</option>
                    <option value="3" selected>3 - Urgent (&lt; 30 menit)</option>
                    <option value="4">4 - Semi-Urgent (&lt; 60 menit)</option>
                    <option value="5">5 - Non-Urgent (&lt; 120 menit)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Keluhan Utama <span style="color:#ef4444">*</span></label>
                <textarea name="keluhan_utama" class="form-control" rows="3" placeholder="Keluhan utama pasien saat datang ke IGD..." required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Diagnosa Awal</label>
                <textarea name="diagnosa_awal" class="form-control" rows="2" placeholder="Diagnosa awal / kesan..."></textarea>
            </div>
        </div>
    </div>
</div>

<!-- HIDDEN -->
<input type="hidden" name="tgl_triase" value="<?= date('Y-m-d H:i:s') ?>">
<input type="hidden" name="petugas_id" value="<?= esc(session('username') ?? '') ?>">

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.3s;background:linear-gradient(135deg,#fef2f2,#fff1f2);border-color:#fecaca">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px;color:#991b1b">⚠️ Simpan Data Triase IGD</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Pastikan kategori triase dan tanda vital sudah benar.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
                Simpan Triase
            </button>
            <a href="<?= site_url('module/igd') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<style>
.antrian-item:has(input:checked) {
    border-color: #ef4444;
    background: #fef2f2;
    box-shadow: 0 0 0 3px rgba(239,68,68,.1);
}
.antrian-item:hover { border-color: #fca5a5; background: #fff5f5; }
</style>

<script>
// Auto-fill no_rkm_medis saat pilih pasien
document.querySelectorAll('input[name="no_rawat"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('no_rkm_medis').value = this.dataset.rm;
    });
});

// GCS auto-calculate
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
