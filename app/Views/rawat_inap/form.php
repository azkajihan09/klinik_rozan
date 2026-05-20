<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>🛏️ Admisi Rawat Inap</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/rawat-inap') ?>">Rawat Inap</a> /
            Masuk Kamar
        </p>
    </div>
    <a href="<?= site_url('module/rawat-inap') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/rawat-inap') ?>">

<!-- STEP 1: PILIH PASIEN -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            Pilih Pasien
        </h3>
        <span class="badge badge-info"><?= count($antrian) ?> pasien hari ini</span>
    </div>

    <?php if(empty($antrian)): ?>
        <div style="text-align:center;padding:32px;color:var(--text-muted,#64748b)">
            <p style="font-size:14px;font-weight:500">Belum ada pasien terdaftar hari ini</p>
            <p style="font-size:12px;margin-top:4px">Daftarkan melalui <a href="<?= site_url('module/registrasi/new') ?>" style="color:var(--primary,#0891b2);font-weight:600">Registrasi</a> terlebih dahulu.</p>
        </div>
    <?php else: ?>
        <div style="display:grid;gap:8px;max-height:220px;overflow-y:auto;padding:4px">
            <?php foreach($antrian as $i => $a): ?>
                <label class="antrian-item" style="display:flex;align-items:center;gap:12px;padding:10px 14px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s">
                    <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" style="width:18px;height:18px;accent-color:#6366f1" required <?= $i === 0 ? 'checked' : '' ?>>
                    <div style="width:34px;height:34px;border-radius:8px;background:#eef2ff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:#4338ca">
                        <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:13px"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></div>
                        <div style="font-size:11px;color:var(--text-muted,#64748b)">
                            RM: <?= esc($a['no_rkm_medis']) ?> &middot; <?= $a['jk'] === 'L' ? 'L' : 'P' ?> &middot; Dr: <?= esc($a['kd_dokter']) ?>
                        </div>
                    </div>
                    <span class="badge badge-<?= $a['status_lanjut'] === 'Ranap' ? 'purple' : 'info' ?>"><?= esc($a['status_lanjut']) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- STEP 2: PILIH KAMAR -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
            Pilih Kamar
        </h3>
        <span class="badge badge-success"><?= count($kamar) ?> kamar tersedia</span>
    </div>

    <?php if(empty($kamar)): ?>
        <div style="text-align:center;padding:24px;color:var(--text-muted,#64748b)">
            <p style="font-size:14px;font-weight:500">Semua kamar penuh</p>
        </div>
    <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px;max-height:280px;overflow-y:auto;padding:4px">
            <?php foreach($kamar as $i => $k): ?>
                <label class="kamar-item" style="display:flex;flex-direction:column;padding:14px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
                        <input type="radio" name="kd_kamar" value="<?= esc($k['kd_kamar']) ?>" style="width:16px;height:16px;accent-color:#6366f1" required <?= $i === 0 ? 'checked' : '' ?>
                            data-tarif="<?= esc($k['trf_kamar']) ?>">
                        <span style="font-weight:700;font-size:14px;color:#4338ca"><?= esc($k['kd_kamar']) ?></span>
                    </div>
                    <div style="font-size:12px;color:var(--text-muted,#64748b);line-height:1.6">
                        <div>🏥 <?= esc($k['nm_bangsal'] ?? $k['kd_bangsal']) ?></div>
                        <div>🏷️ <?= esc($k['kelas'] ?? '-') ?></div>
                        <div style="font-weight:600;color:var(--text,#1e293b)">💰 Rp <?= number_format((float)$k['trf_kamar'], 0, ',', '.') ?>/hari</div>
                    </div>
                    <span class="badge badge-success" style="margin-top:8px;align-self:flex-start">Tersedia</span>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="hidden" name="trf_kamar" id="trf_kamar" value="<?= esc($kamar[0]['trf_kamar'] ?? '0') ?>">
</div>

<!-- STEP 3: DIAGNOSA & WAKTU -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Diagnosa & Waktu Masuk
        </h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Diagnosa Awal <span style="color:#ef4444">*</span></label>
            <textarea name="diagnosa_awal" class="form-control" rows="2" placeholder="Diagnosa saat masuk rawat inap..." required></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Diagnosa Akhir</label>
            <textarea name="diagnosa_akhir" class="form-control" rows="2" placeholder="Diisi saat pasien pulang..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Masuk</label>
            <input type="time" name="jam_masuk" value="<?= date('H:i:s') ?>" class="form-control">
        </div>
    </div>
</div>

<!-- HIDDEN DEFAULTS -->
<input type="hidden" name="tgl_keluar" value="">
<input type="hidden" name="jam_keluar" value="">
<input type="hidden" name="lama" value="0">
<input type="hidden" name="ttl_biaya" value="0">
<input type="hidden" name="stts_pulang" value="-">

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.3s;background:linear-gradient(135deg,#eef2ff,#e0e7ff);border-color:#c7d2fe">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px;color:#3730a3">🛏️ Konfirmasi Masuk Rawat Inap</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Pasien akan masuk ke kamar yang dipilih. Tarif kamar akan dihitung per hari.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,#6366f1,#818cf8)">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
                Masukkan Pasien
            </button>
            <a href="<?= site_url('module/rawat-inap') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<style>
.antrian-item:has(input:checked) {
    border-color: #6366f1; background: #eef2ff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.antrian-item:hover { border-color: #a5b4fc; background: #f5f3ff; }
.kamar-item:has(input:checked) {
    border-color: #6366f1; background: #eef2ff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.kamar-item:hover { border-color: #a5b4fc; background: #f5f3ff; }
</style>

<script>
// Update tarif kamar saat pilih kamar
document.querySelectorAll('input[name="kd_kamar"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('trf_kamar').value = this.dataset.tarif;
    });
});
</script>

<?= $this->endSection() ?>
