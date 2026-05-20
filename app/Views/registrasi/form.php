<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1">Registrasi Pasien Baru</h1>
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('module/registrasi') ?>">Registrasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </div>
            <a href="<?= site_url('module/registrasi') ?>" class="btn btn-outline-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form method="post" action="<?= site_url('module/registrasi') ?>">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">1. Pilih Pasien</h3>
            <a href="<?= site_url('module/pasien/new') ?>" class="btn btn-primary btn-sm" target="_blank">Pasien Baru</a>
        </div>
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-lg-9">
                    <label class="form-label">Cari Pasien</label>
                    <div class="app-search-wrap">
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                            </span>
                            <input type="text" id="cari-pasien" class="form-control" placeholder="Ketik nama, no. RM, atau no. HP pasien" autocomplete="off">
                        </div>
                        <div class="form-text">Minimal 2 huruf untuk mulai mencari.</div>
                        <div id="hasil-cari" class="app-search-results list-group shadow-sm"></div>
                    </div>
                </div>
                <div class="col-lg-3 d-grid">
                    <a href="<?= site_url('module/pasien/new') ?>" class="btn btn-outline-primary" target="_blank">Tambah Pasien Baru</a>
                </div>
            </div>

            <div id="info-pasien" class="alert alert-light border mt-3 mb-0 d-none" role="status">
                <div class="d-flex flex-wrap align-items-center gap-3 w-100">
                    <div id="pasien-avatar" class="app-avatar bg-primary"></div>
                    <div class="flex-grow-1">
                        <div id="pasien-nama" class="fw-semibold"></div>
                        <div id="pasien-detail" class="text-muted small"></div>
                    </div>
                    <span class="badge text-bg-success">Terpilih</span>
                </div>
            </div>
        </div>
        <input type="hidden" name="no_rkm_medis" id="no_rkm_medis" value="" required>
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">2. Data Registrasi</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">No. Registrasi</label>
                    <input type="text" name="no_reg" value="<?= esc($noReg) ?>" class="form-control" readonly>
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">No. Rawat</label>
                    <input type="text" name="no_rawat" value="<?= esc($noRawat) ?>" class="form-control" readonly>
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Tanggal Registrasi</label>
                    <input type="date" name="tgl_registrasi" value="<?= date('Y-m-d') ?>" class="form-control">
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Jam Registrasi</label>
                    <input type="time" name="jam_reg" value="<?= date('H:i:s') ?>" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">3. Tujuan Pelayanan</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Poliklinik Tujuan</label>
                    <select name="kd_poli" class="form-select" required>
                        <option value="">-- Pilih Poli --</option>
                        <?php foreach ($poli as $p): ?>
                            <option value="<?= esc($p['kd_poli']) ?>"><?= esc($p['nm_poli']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dokter</label>
                    <select name="kd_dokter" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php foreach ($dokter as $d): ?>
                            <option value="<?= esc($d['kd_dokter']) ?>"><?= esc($d['nm_dokter']) ?> (<?= esc($d['kd_sps'] ?? 'Umum') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Layanan</label>
                    <select name="status_lanjut" class="form-select" required>
                        <option value="Ralan">Rawat Jalan</option>
                        <option value="Ranap">Rawat Inap</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penjamin / Cara Bayar</label>
                    <select name="kd_pj" class="form-select" required>
                        <option value="">-- Pilih Penjamin --</option>
                        <?php foreach ($penjamin as $pj): ?>
                            <option value="<?= esc($pj['kd_pj']) ?>"><?= esc($pj['png_jawab']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">4. Penanggung Jawab</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Penanggung Jawab</label>
                    <input type="text" name="p_jawab" class="form-control" placeholder="Nama penanggung jawab">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Penanggung Jawab</label>
                    <input type="text" name="almt_pj" class="form-control" placeholder="Alamat">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hubungan dengan Pasien</label>
                    <select name="hubunganpj" class="form-select">
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
                <div class="col-md-6">
                    <label class="form-label">Biaya Registrasi</label>
                    <input type="number" name="biaya_reg" value="0" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="stts" value="Belum">
    <input type="hidden" name="stts_daftar" value="Baru">
    <input type="hidden" name="umurdaftar" value="0">
    <input type="hidden" name="sttsumur" value="Th">
    <input type="hidden" name="status_bayar" value="Belum Bayar">
    <input type="hidden" name="status_poli" value="Belum">

    <div class="card card-outline card-success">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Simpan Registrasi</h3>
                <p class="text-muted mb-0 small">Pastikan pasien, poli, dokter, dan penjamin sudah dipilih dengan benar sebelum menyimpan.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Simpan Registrasi
                </button>
                <a href="<?= site_url('module/registrasi') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
    const cariInput = document.getElementById('cari-pasien');
    const hasilDiv = document.getElementById('hasil-cari');
    const infoDiv = document.getElementById('info-pasien');
    let timeout = null;

    function hideResults() {
        hasilDiv.classList.remove('is-visible');
    }

    cariInput.addEventListener('input', function() {
        clearTimeout(timeout);
        const q = this.value.trim();
        if (q.length < 2) {
            hideResults();
            return;
        }

        timeout = setTimeout(() => {
            fetch('<?= site_url('registrasi/cari-pasien') ?>?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(data => {
                    if (data.length === 0) {
                        hasilDiv.innerHTML = '<div class="list-group-item text-muted small">Tidak ditemukan. <a href="<?= site_url('module/pasien/new') ?>" target="_blank">Daftar pasien baru?</a></div>';
                    } else {
                        hasilDiv.innerHTML = data.map(p => `
                        <button type="button" class="list-group-item list-group-item-action app-search-option d-flex align-items-center gap-3"
                            data-rm="${p.no_rkm_medis}" data-nama="${p.nm_pasien}" data-jk="${p.jk || '-'}" data-alamat="${p.alamat || '-'}" data-tlp="${p.no_tlp || '-'}" data-tgl="${p.tgl_lahir || '-'}">
                            <span class="app-avatar bg-primary">${(p.nm_pasien || 'P').charAt(0).toUpperCase()}</span>
                            <span class="flex-grow-1 text-start">
                                <span class="d-block fw-semibold">${p.nm_pasien}</span>
                                <span class="d-block text-muted small">RM: ${p.no_rkm_medis} | ${p.jk === 'L' ? 'Laki-laki' : 'Perempuan'} | ${p.no_tlp || '-'}</span>
                            </span>
                        </button>
                    `).join('');
                    }
                    hasilDiv.classList.add('is-visible');

                    hasilDiv.querySelectorAll('.app-search-option').forEach(el => {
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

                            infoDiv.classList.remove('d-none');
                            hideResults();
                            cariInput.value = nama;
                        });
                    });
                });
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!cariInput.contains(e.target) && !hasilDiv.contains(e.target)) {
            hideResults();
        }
    });
</script>

<?= $this->endSection() ?>