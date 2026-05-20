<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>🩺 Pemeriksaan Rawat Jalan</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/rawat-jalan') ?>">Rawat Jalan</a> /
            Input Pemeriksaan
        </p>
    </div>
    <a href="<?= site_url('module/rawat-jalan') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/rawat-jalan') ?>" id="form-ralan">

<!-- STEP 1: PILIH PASIEN DARI ANTRIAN -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            Pilih Pasien dari Antrian Hari Ini
        </h3>
        <span class="badge badge-info"><?= count($antrian) ?> pasien</span>
    </div>

    <?php if(empty($antrian)): ?>
        <div style="text-align:center;padding:32px;color:var(--text-muted,#64748b)">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" style="margin:0 auto 12px;display:block"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            <p style="font-size:14px;font-weight:500">Belum ada antrian hari ini</p>
            <p style="font-size:12px;margin-top:4px">Daftarkan pasien melalui <a href="<?= site_url('module/registrasi/new') ?>" style="color:var(--primary,#0891b2);font-weight:600">Registrasi</a> terlebih dahulu.</p>
        </div>
    <?php else: ?>
        <div style="display:grid;gap:8px;max-height:300px;overflow-y:auto;padding:4px">
            <?php foreach($antrian as $i => $a): ?>
                <label class="antrian-item" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s">
                    <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" style="width:18px;height:18px;accent-color:#0891b2" required <?= $i === 0 ? 'checked' : '' ?>>
                    <div style="width:38px;height:38px;border-radius:10px;background:<?= $a['stts'] === 'Sudah' ? '#dcfce7' : ($a['stts'] === 'Berkas Diterima' ? '#dbeafe' : '#fef3c7') ?>;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:<?= $a['stts'] === 'Sudah' ? '#166534' : ($a['stts'] === 'Berkas Diterima' ? '#1e40af' : '#92400e') ?>">
                        <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:14px"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></div>
                        <div style="font-size:11px;color:var(--text-muted,#64748b)">
                            RM: <?= esc($a['no_rkm_medis']) ?> &middot;
                            <?= $a['jk'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> &middot;
                            Poli: <?= esc($a['kd_poli']) ?> &middot;
                            Dr: <?= esc($a['kd_dokter']) ?>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-size:12px;font-weight:600;color:var(--text-muted,#64748b)"><?= esc($a['jam_reg']) ?></div>
                        <?php if($a['stts'] === 'Sudah'): ?>
                            <span class="badge badge-success">Selesai</span>
                        <?php elseif($a['stts'] === 'Berkas Diterima'): ?>
                            <span class="badge badge-info">Proses</span>
                        <?php else: ?>
                            <span class="badge badge-warning">Menunggu</span>
                        <?php endif; ?>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- STEP 2: VITAL SIGNS -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            Tanda Vital
        </h3>
        <span style="font-size:11px;color:var(--text-muted,#64748b)">Diisi oleh perawat/dokter</span>
    </div>
    <div class="form-grid" style="grid-template-columns:repeat(auto-fit,minmax(150px,1fr))">
        <div class="form-group">
            <label class="form-label">Tekanan Darah</label>
            <input type="text" name="tensi" class="form-control" placeholder="120/80">
        </div>
        <div class="form-group">
            <label class="form-label">Suhu (°C)</label>
            <input type="number" step="0.1" name="suhu_tubuh" class="form-control" placeholder="36.5">
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
            <label class="form-label">SpO2 (%)</label>
            <input type="number" name="spo2" class="form-control" placeholder="98">
        </div>
        <div class="form-group">
            <label class="form-label">Tinggi (cm)</label>
            <input type="number" name="tinggi" class="form-control" placeholder="165">
        </div>
        <div class="form-group">
            <label class="form-label">Berat (kg)</label>
            <input type="number" name="berat" class="form-control" placeholder="60">
        </div>
        <div class="form-group">
            <label class="form-label">GCS</label>
            <input type="number" name="gcs" class="form-control" placeholder="15" value="15">
        </div>
        <div class="form-group">
            <label class="form-label">Kesadaran</label>
            <select name="kesadaran" class="form-control">
                <option value="Compos Mentis" selected>Compos Mentis</option>
                <option value="Somnolence">Somnolence</option>
                <option value="Sopor">Sopor</option>
                <option value="Coma">Coma</option>
                <option value="Apatis">Apatis</option>
            </select>
        </div>
    </div>
</div>

<!-- STEP 3: SOAP -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Pemeriksaan (SOAP)
        </h3>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
        <div class="form-group">
            <label class="form-label">S - Keluhan Utama (Subjective) <span style="color:#ef4444">*</span></label>
            <textarea name="keluhan" class="form-control" rows="3" placeholder="Keluhan yang dirasakan pasien..." required></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">O - Pemeriksaan Fisik (Objective)</label>
            <textarea name="pemeriksaan" class="form-control" rows="3" placeholder="Hasil pemeriksaan fisik..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">A - Penilaian / Diagnosa (Assessment) <span style="color:#ef4444">*</span></label>
            <textarea name="penilaian" class="form-control" rows="3" placeholder="Diagnosa kerja..." required></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">P - Rencana Tindak Lanjut (Plan)</label>
            <textarea name="rtl" class="form-control" rows="3" placeholder="Terapi, rujukan, kontrol ulang..."></textarea>
        </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-top:16px">
        <div class="form-group">
            <label class="form-label">Alergi</label>
            <input type="text" name="alergi" class="form-control" placeholder="Obat/makanan yang alergi">
        </div>
        <div class="form-group">
            <label class="form-label">Instruksi</label>
            <textarea name="instruksi" class="form-control" rows="2" placeholder="Instruksi untuk pasien..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Evaluasi</label>
            <textarea name="evaluasi" class="form-control" rows="2" placeholder="Evaluasi..."></textarea>
        </div>
    </div>
</div>

<!-- STEP 4: WAKTU & PETUGAS -->
<div class="card animate-fade-up" style="animation-delay:.3s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Waktu & Petugas
        </h3>
    </div>
    <div class="form-grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr))">
        <div class="form-group">
            <label class="form-label">Tanggal Perawatan</label>
            <input type="date" name="tgl_perawatan" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Rawat</label>
            <input type="time" name="jam_rawat" value="<?= date('H:i:s') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">NIP Petugas / Dokter</label>
            <input type="text" name="nip" class="form-control" placeholder="NIP pemeriksa" value="<?= esc(session('username') ?? '') ?>">
        </div>
    </div>
</div>

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.4s;background:linear-gradient(135deg,#ecfeff,#f0f9ff);border-color:#a5f3fc">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px">Simpan Hasil Pemeriksaan</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Data pemeriksaan akan tersimpan ke rekam medis pasien.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Pemeriksaan
            </button>
            <a href="<?= site_url('module/rawat-jalan') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<style>
.antrian-item:has(input:checked) {
    border-color: #0891b2;
    background: #ecfeff;
    box-shadow: 0 0 0 3px rgba(8,145,178,.1);
}
.antrian-item:hover {
    border-color: #67e8f9;
    background: #f0fdfa;
}
@media (max-width: 768px) {
    .card .form-grid[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr;
    }
}
</style>

<?= $this->endSection() ?>
