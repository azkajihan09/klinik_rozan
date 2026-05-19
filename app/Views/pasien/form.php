<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>👤 Pendaftaran Pasien Baru</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/pasien') ?>">Data Pasien</a> /
            Tambah Baru
        </p>
    </div>
    <a href="<?= site_url('module/pasien') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/pasien') ?>" id="form-pasien">

<!-- IDENTITAS UTAMA -->
<div class="card animate-fade-up">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Identitas Pasien
        </h3>
        <span class="badge badge-info">No. RM: <?= esc($noRM) ?></span>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">No. Rekam Medis</label>
            <input type="text" name="no_rkm_medis" value="<?= esc($noRM) ?>" class="form-control" style="background:#f1f5f9;font-weight:700;font-size:16px;color:var(--primary,#0891b2)" readonly>
            <small style="color:var(--text-muted,#64748b);font-size:11px;margin-top:4px;display:block">✓ Otomatis di-generate oleh sistem</small>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Lengkap Pasien <span style="color:#ef4444">*</span></label>
            <input type="text" name="nm_pasien" class="form-control" placeholder="Masukkan nama lengkap" required autofocus>
        </div>
        <div class="form-group">
            <label class="form-label">No. KTP / NIK</label>
            <input type="text" name="no_ktp" class="form-control" placeholder="16 digit NIK" maxlength="16">
        </div>
        <div class="form-group">
            <label class="form-label">Jenis Kelamin <span style="color:#ef4444">*</span></label>
            <select name="jk" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tmp_lahir" class="form-control" placeholder="Kota/Kabupaten">
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Lahir <span style="color:#ef4444">*</span></label>
            <input type="date" name="tgl_lahir" class="form-control" required onchange="hitungUmur(this.value)">
        </div>
        <div class="form-group">
            <label class="form-label">Umur</label>
            <div style="display:flex;gap:8px;align-items:center">
                <input type="number" name="umur" id="umur-field" class="form-control" style="max-width:80px" value="0" readonly>
                <span style="font-size:13px;color:var(--text-muted,#64748b)">tahun</span>
            </div>
            <small style="color:var(--text-muted,#64748b);font-size:11px;margin-top:4px;display:block">✓ Otomatis dari tanggal lahir</small>
        </div>
        <div class="form-group">
            <label class="form-label">Nama Ibu Kandung</label>
            <input type="text" name="nm_ibu" class="form-control" placeholder="Nama ibu kandung">
        </div>
    </div>
</div>

<!-- KONTAK & ALAMAT -->
<div class="card animate-fade-up" style="animation-delay:.1s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Kontak & Alamat
        </h3>
    </div>
    <div class="form-grid">
        <div class="form-group" style="grid-column: span 2">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan, RT/RW, Desa/Kelurahan"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">No. Telepon / HP <span style="color:#ef4444">*</span></label>
            <input type="tel" name="no_tlp" class="form-control" placeholder="08xxxxxxxxxx" required>
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@contoh.com">
        </div>
    </div>
</div>

<!-- PENJAMIN / ASURANSI -->
<div class="card animate-fade-up" style="animation-delay:.2s">
    <div class="card-header">
        <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Penjamin / Asuransi
        </h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Cara Bayar / Penjamin <span style="color:#ef4444">*</span></label>
            <select name="kd_pj" class="form-control" required id="select-penjamin">
                <option value="">-- Pilih Penjamin --</option>
                <?php foreach($penjamin as $pj): ?>
                    <option value="<?= esc($pj['kd_pj']) ?>"><?= esc($pj['png_jawab']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group" id="group-bpjs" style="display:none">
            <label class="form-label">No. Peserta BPJS</label>
            <input type="text" name="no_peserta" class="form-control" placeholder="13 digit no peserta" maxlength="13">
        </div>
    </div>
</div>

<!-- SUBMIT -->
<div class="card animate-fade-up" style="animation-delay:.3s;background:linear-gradient(135deg,#ecfeff,#f0f9ff);border-color:#a5f3fc">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <p style="font-weight:600;font-size:14px;color:var(--text,#1e293b)">Siap mendaftarkan pasien?</p>
            <p style="font-size:12px;color:var(--text-muted,#64748b)">Pastikan data yang diisi sudah benar. No. RM <strong><?= esc($noRM) ?></strong> akan digunakan.</p>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Daftarkan Pasien
            </button>
            <a href="<?= site_url('module/pasien') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>

</form>

<script>
// Hitung umur otomatis dari tanggal lahir
function hitungUmur(tglLahir) {
    if (!tglLahir) return;
    const today = new Date();
    const birth = new Date(tglLahir);
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
    document.getElementById('umur-field').value = age >= 0 ? age : 0;
}

// Tampilkan field BPJS jika penjamin BPJS dipilih
document.getElementById('select-penjamin').addEventListener('change', function() {
    const text = this.options[this.selectedIndex].text.toLowerCase();
    const bpjsGroup = document.getElementById('group-bpjs');
    if (text.includes('bpjs') || text.includes('jkn')) {
        bpjsGroup.style.display = 'block';
    } else {
        bpjsGroup.style.display = 'none';
    }
});
</script>

<?= $this->endSection() ?>
