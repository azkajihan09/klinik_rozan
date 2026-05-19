<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>📋 Registrasi Pasien Baru</h1>
        <p class="breadcrumb">
            <a href="<?= site_url('dashboard') ?>">Dashboard</a> /
            <a href="<?= site_url('module/registrasi') ?>">Registrasi</a> /
            Tambah
        </p>
    </div>
    <a href="<?= site_url('module/registrasi') ?>" class="btn btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>
</div>

<?php if(session('error')): ?>
    <div class="alert alert-error"><?= esc(session('error')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/registrasi') ?>">

<!-- STEP 1: CARI PASIEN -->
<div class="card">
    <div class="card-header">
        <h3>👤 1. Pilih Pasien</h3>
        <a href="<?= site_url('module/pasien/new') ?>" class="btn btn-sm btn-primary" target="_blank">+ Pasien Baru</a>
    </div>
    <div class="form-group">
        <label class="form-label">Cari Pasien (ketik nama, no RM, atau no HP)</label>
        <input type="text" id="cari-pasien" class="form-control" placeholder="Ketik minimal 2 huruf untuk mencari..." autocomplete="off">
        <div id="hasil-cari" style="border:1px solid var(--border);border-radius:8px;max-height:200px;overflow-y:auto;display:none;margin-top:4px"></div>
    </div>
    <div id="info-pasien" style="display:none;margin-top:12px;padding:16px;background:var(--primary-light,#ecfeff);border-radius:10px;border:1px solid #a5f3fc">
        <div style="display:flex;align-items:center;gap:12px">
            <div id="pasien-avatar" style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#0891b2,#06b6d4);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:16px"></div>
            <div>
                <div id="pasien-nama" style="font-weight:700;font-size:15px"></div>
                <div id="pasien-detail" style="font-size:12px;color:var(--text-muted)"></div>
            </div>
            <span class="badge badge-success" style="margin-left:auto">✓ Terpilih</span>
        </div>
    </div>
    <input type="hidden" name="no_rkm_medis" id="no_rkm_medis" value="" required>
</div>

<!-- STEP 2: DATA REGISTRASI -->
<div class="card">
    <div class="card-header">
        <h3>📝 2. Data Registrasi</h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">No. Registrasi</label>
            <input type="text" name="no_reg" value="<?= esc($noReg) ?>" class="form-control" style="background:#f1f5f9" readonly>
        </div>
        <div class="form-group">
            <label class="form-label">No. Rawat</label>
            <input type="text" name="no_rawat" value="<?= esc($noRawat) ?>" class="form-control" style="background:#f1f5f9" readonly>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Registrasi</label>
            <input type="date" name="tgl_registrasi" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Jam Registrasi</label>
            <input type="time" name="jam_reg" value="<?= date('H:i:s') ?>" class="form-control">
        </div>
    </div>
</div>

<!-- STEP 3: POLI & DOKTER -->
<div class="card">
    <div class="card-header">
        <h3>🏥 3. Tujuan Pelayanan</h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Poliklinik Tujuan</label>
            <select name="kd_poli" class="form-control" required>
                <option value="">-- Pilih Poli --</option>
                <?php foreach($poli as $p): ?>
                    <option value="<?= esc($p['kd_poli']) ?>"><?= esc($p['nm_poli']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Dokter</label>
            <select name="kd_dokter" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                <?php foreach($dokter as $d): ?>
                    <option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?> (<?= esc($d['kd_sps'] ?? 'Umum') ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Jenis Layanan</label>
            <select name="status_lanjut" class="form-control" required>
                <option value="Ralan">Rawat Jalan</option>
                <option value="Ranap">Rawat Inap</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Penjamin / Cara Bayar</label>
            <select name="kd_pj" class="form-control" required>
                <option value="">-- Pilih Penjamin --</option>
                <?php foreach($penjamin as $pj): ?>
                    <option value="<?= esc($pj['kd_pj']) ?>"><?= esc($pj['png_jawab']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<!-- STEP 4: PENANGGUNG JAWAB -->
<div class="card">
    <div class="card-header">
        <h3>👨‍👩‍👧 4. Penanggung Jawab</h3>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Nama Penanggung Jawab</label>
            <input type="text" name="p_jawab" class="form-control" placeholder="Nama penanggung jawab">
        </div>
        <div class="form-group">
            <label class="form-label">Alamat Penanggung Jawab</label>
            <input type="text" name="almt_pj" class="form-control" placeholder="Alamat">
        </div>
        <div class="form-group">
            <label class="form-label">Hubungan dengan Pasien</label>
            <select name="hubunganpj" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="AYAH">Ayah</option>
                <option value="IBU">Ibu</option>
                <option value="SUAMI">Suami</option>
                <option value="ISTRI">Istri</option>
                <option value="ANAK">Anak</option>
                <option value="SAUDARA">Saudara</option>
                <option value="LAINNYA">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Biaya Registrasi</label>
            <input type="number" name="biaya_reg" value="0" class="form-control">
        </div>
    </div>
</div>

<!-- HIDDEN DEFAULTS -->
<input type="hidden" name="stts" value="Belum">
<input type="hidden" name="stts_daftar" value="Baru">
<input type="hidden" name="umurdaftar" value="0">
<input type="hidden" name="sttsumur" value="Th">
<input type="hidden" name="status_bayar" value="Belum Bayar">
<input type="hidden" name="status_poli" value="Belum">

<!-- SUBMIT -->
<div style="display:flex;gap:10px;margin-top:8px">
    <button type="submit" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Registrasi
    </button>
    <a href="<?= site_url('module/registrasi') ?>" class="btn btn-secondary">Batal</a>
</div>

</form>

<script>
// Pencarian pasien
const cariInput = document.getElementById('cari-pasien');
const hasilDiv = document.getElementById('hasil-cari');
const infoDiv = document.getElementById('info-pasien');
let timeout = null;

cariInput.addEventListener('input', function() {
    clearTimeout(timeout);
    const q = this.value.trim();
    if (q.length < 2) { hasilDiv.style.display = 'none'; return; }

    timeout = setTimeout(() => {
        fetch('<?= site_url('registrasi/cari-pasien') ?>?q=' + encodeURIComponent(q))
            .then(r => r.json())
            .then(data => {
                if (data.length === 0) {
                    hasilDiv.innerHTML = '<div style="padding:12px;color:var(--text-muted);font-size:13px">Tidak ditemukan. <a href="<?= site_url('module/pasien/new') ?>" target="_blank" style="color:var(--primary,#0891b2)">Daftar pasien baru?</a></div>';
                } else {
                    hasilDiv.innerHTML = data.map(p => `
                        <div class="pasien-option" style="padding:10px 14px;cursor:pointer;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:10px;transition:.15s"
                             onmouseover="this.style.background='#ecfeff'"
                             onmouseout="this.style.background='white'"
                             data-rm="${p.no_rkm_medis}" data-nama="${p.nm_pasien}" data-jk="${p.jk || '-'}" data-alamat="${p.alamat || '-'}" data-tlp="${p.no_tlp || '-'}" data-tgl="${p.tgl_lahir || '-'}">
                            <div style="width:32px;height:32px;border-radius:8px;background:#0891b2;color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px">${(p.nm_pasien||'P').charAt(0).toUpperCase()}</div>
                            <div style="flex:1">
                                <div style="font-weight:600;font-size:13px">${p.nm_pasien}</div>
                                <div style="font-size:11px;color:#64748b">RM: ${p.no_rkm_medis} | ${p.jk === 'L' ? 'Laki-laki' : 'Perempuan'} | ${p.no_tlp || '-'}</div>
                            </div>
                        </div>
                    `).join('');
                }
                hasilDiv.style.display = 'block';

                // Click handler
                hasilDiv.querySelectorAll('.pasien-option').forEach(el => {
                    el.addEventListener('click', function() {
                        const rm = this.dataset.rm;
                        const nama = this.dataset.nama;
                        const jk = this.dataset.jk === 'L' ? 'Laki-laki' : 'Perempuan';
                        const alamat = this.dataset.alamat;
                        const tlp = this.dataset.tlp;
                        const tgl = this.dataset.tgl;

                        document.getElementById('no_rkm_medis').value = rm;
                        document.getElementById('pasien-avatar').textContent = nama.charAt(0).toUpperCase();
                        document.getElementById('pasien-nama').textContent = nama;
                        document.getElementById('pasien-detail').textContent = `RM: ${rm} | ${jk} | Lahir: ${tgl} | HP: ${tlp} | ${alamat}`;

                        infoDiv.style.display = 'block';
                        hasilDiv.style.display = 'none';
                        cariInput.value = nama;
                    });
                });
            });
    }, 300);
});

// Hide results when clicking outside
document.addEventListener('click', function(e) {
    if (!cariInput.contains(e.target) && !hasilDiv.contains(e.target)) {
        hasilDiv.style.display = 'none';
    }
});
</script>

<?= $this->endSection() ?>
