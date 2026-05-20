<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>🧪 Order Pemeriksaan Laboratorium</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/laboratorium') ?>">Laboratorium</a> /
            Order Baru
        </p>
    </div>
    <a href="<?= site_url('module/laboratorium') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/laboratorium') ?>">

<!-- PILIH PASIEN -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            Pilih Pasien
        </h3>
        <span class="badge badge-info"><?= count($antrian) ?> pasien hari ini</span>
    </div>
    <?php if(empty($antrian)): ?>
        <div style="text-align:center;padding:24px;color:var(--text-muted,#64748b)">
            <p>Belum ada pasien terdaftar hari ini.</p>
            <a href="<?= site_url('module/registrasi/new') ?>" class="btn btn-sm btn-primary" style="margin-top:8px">+ Registrasi Pasien</a>
        </div>
    <?php else: ?>
        <div style="display:grid;gap:6px;max-height:200px;overflow-y:auto;padding:4px">
            <?php foreach($antrian as $i => $a): ?>
                <label style="display:flex;align-items:center;gap:12px;padding:10px 14px;border:2px solid var(--border,#e2e8f0);border-radius:10px;cursor:pointer;transition:all .2s" class="pasien-radio">
                    <input type="radio" name="no_rawat" value="<?= esc($a['no_rawat']) ?>" style="width:16px;height:16px;accent-color:#2563eb" required <?= $i === 0 ? 'checked' : '' ?>>
                    <div style="width:32px;height:32px;border-radius:8px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;color:#1e40af">
                        <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:13px"><?= esc($a['nm_pasien'] ?? $a['no_rkm_medis']) ?></div>
                        <div style="font-size:11px;color:var(--text-muted,#64748b)">RM: <?= esc($a['no_rkm_medis']) ?> &middot; <?= $a['jk'] === 'L' ? 'L' : 'P' ?> &middot; Poli: <?= esc($a['kd_poli']) ?></div>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- DATA ORDER -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3h6v2H9zM10 5v6.5L6 20h12l-4-8.5V5"/></svg>
            Data Permintaan Lab
        </h3>
        <span class="badge badge-info">No: <?= esc($noOrder) ?></span>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">No. Order</label>
            <input type="text" name="noorder" value="<?= esc($noOrder) ?>" class="form-control" style="background:#f1f5f9;font-weight:700;color:#2563eb" readonly>
            <small style="color:var(--text-muted,#64748b);font-size:11px;margin-top:4px;display:block">✓ Otomatis</small>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Permintaan</label>
            <input type="date" name="tgl_permintaan" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Permintaan</label>
            <input type="time" name="jam_permintaan" value="<?= date('H:i:s') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Dokter Perujuk <span style="color:#ef4444">*</span></label>
            <select name="dokter_perujuk" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                <?php foreach($dokter as $d): ?>
                    <option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Asal Permintaan <span style="color:#ef4444">*</span></label>
            <select name="status" class="form-control" required>
                <option value="ralan">Rawat Jalan</option>
                <option value="ranap">Rawat Inap</option>
            </select>
        </div>
    </div>
</div>

<!-- DIAGNOSA & INFO -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Diagnosa & Informasi Klinis
        </h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Diagnosa Klinis <span style="color:#ef4444">*</span></label>
            <textarea name="diagnosa_klinis" class="form-control" rows="3" placeholder="Diagnosa klinis / indikasi pemeriksaan lab..." required maxlength="80"></textarea>
            <small style="color:var(--text-muted,#64748b);font-size:11px">Maks 80 karakter</small>
        </div>
        <div class="form-group">
            <label class="form-label">Informasi Tambahan</label>
            <textarea name="informasi_tambahan" class="form-control" rows="3" placeholder="Catatan: puasa, riwayat obat, dll..." maxlength="60"></textarea>
            <small style="color:var(--text-muted,#64748b);font-size:11px">Maks 60 karakter</small>
        </div>
    </div>
</div>

<!-- HIDDEN (field yang belum diisi saat order baru) -->
<input type="hidden" name="tgl_sampel" value="0000-00-00">
<input type="hidden" name="jam_sampel" value="00:00:00">
<input type="hidden" name="tgl_hasil" value="0000-00-00">
<input type="hidden" name="jam_hasil" value="00:00:00">

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.3s;background:linear-gradient(135deg,#eff6ff,#dbeafe);border-color:#93c5fd">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px;color:#1e40af">🧪 Kirim Permintaan Lab</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Order akan dikirim ke unit laboratorium untuk diproses.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,#2563eb,#3b82f6)">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Kirim Order Lab
            </button>
            <a href="<?= site_url('module/laboratorium') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<style>
.pasien-radio:has(input:checked) {
    border-color: #2563eb; background: #eff6ff;
    box-shadow: 0 0 0 3px rgba(37,99,235,.1);
}
.pasien-radio:hover { border-color: #93c5fd; background: #f0f9ff; }
</style>

<?= $this->endSection() ?>
