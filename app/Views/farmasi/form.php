<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>💊 Resep Obat Baru</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/farmasi') ?>">Farmasi</a> /
            Resep Baru
        </p>
    </div>
    <a href="<?= site_url('module/farmasi') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/farmasi') ?>">

<!-- PILIH PASIEN -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            Pilih Pasien
        </h3>
    </div>
    <?php if(empty($antrian)): ?>
        <div style="text-align:center;padding:24px;color:var(--text-muted,#64748b)">
            <p>Belum ada pasien terdaftar hari ini.</p>
        </div>
    <?php else: ?>
        <div style="display:grid;gap:6px;max-height:200px;overflow-y:auto;padding:4px">
            <?php foreach($antrian as $i => $a): ?>
                <label style="display:flex;align-items:center;gap:12px;padding:10px 14px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s" class="pasien-radio">
                    <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" style="width:16px;height:16px;accent-color:#10b981" required <?= $i === 0 ? 'checked' : '' ?>>
                    <div style="width:32px;height:32px;border-radius:8px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;color:#166534">
                        <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:13px"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></div>
                        <div style="font-size:11px;color:var(--text-muted,#64748b)">RM: <?= esc($a['no_rkm_medis']) ?> &middot; Poli: <?= esc($a['kd_poli']) ?></div>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- DATA RESEP -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5L15.5 7.5"/><path d="M14 4l4.5 4.5a5 5 0 010 7.07L14 20.07a5 5 0 01-7.07 0L2.43 15.57a5 5 0 010-7.07L7 4"/></svg>
            Data Resep
        </h3>
        <span class="badge badge-success">No: <?= esc($noResep) ?></span>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">No. Resep</label>
            <input type="text" name="no_resep" value="<?= esc($noResep) ?>" class="form-control" style="background:#f1f5f9;font-weight:700;color:#059669" readonly>
            <small style="color:var(--text-muted,#64748b);font-size:11px;margin-top:4px;display:block">✓ Otomatis</small>
        </div>
        <div class="form-group">
            <label class="form-label">Dokter Penulis Resep <span style="color:#ef4444">*</span></label>
            <select name="kd_dokter" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                <?php foreach($dokter as $d): ?>
                    <option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Resep</label>
            <input type="date" name="tgl_peresepan" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Resep</label>
            <input type="time" name="jam_peresepan" value="<?= date('H:i:s') ?>" class="form-control">
        </div>
    </div>
</div>

<!-- STATUS -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>📦 Status Penyerahan</h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Status Resep</label>
            <select name="status" class="form-control">
                <option value="Belum" selected>Belum Disiapkan</option>
                <option value="Sudah">Sudah Diserahkan</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Penyerahan</label>
            <input type="date" name="tgl_penyerahan" class="form-control" placeholder="Diisi saat obat diserahkan">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Penyerahan</label>
            <input type="time" name="jam_penyerahan" class="form-control">
        </div>
    </div>
</div>

<!-- HIDDEN -->
<input type="hidden" name="tgl_perawatan" value="<?= date('Y-m-d') ?>">
<input type="hidden" name="jam" value="<?= date('H:i:s') ?>">

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.3s;background:linear-gradient(135deg,#ecfdf5,#d1fae5);border-color:#6ee7b7">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px;color:#065f46">💊 Simpan Resep Obat</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Resep akan dikirim ke unit farmasi untuk disiapkan.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Simpan Resep
            </button>
            <a href="<?= site_url('module/farmasi') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<style>
.pasien-radio:has(input:checked) {
    border-color: #10b981; background: #ecfdf5;
    box-shadow: 0 0 0 3px rgba(16,185,129,.1);
}
.pasien-radio:hover { border-color: #6ee7b7; background: #f0fdf4; }
</style>

<?= $this->endSection() ?>
