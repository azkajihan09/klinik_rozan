<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h1 class="mb-1">Pendaftaran Pasien Baru</h1>
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('module/pasien') ?>">Data Pasien</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </div>
            <a href="<?= site_url('module/pasien') ?>" class="btn btn-outline-secondary">
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

<form method="post" action="<?= site_url('module/pasien') ?>" id="form-pasien">
    <div class="card card-outline card-primary animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Identitas Pasien</h3>
            <span class="badge text-bg-info">No. RM: <?= esc($noRM) ?></span>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">No. Rekam Medis</label>
                    <input type="text" name="no_rkm_medis" value="<?= esc($noRM) ?>" class="form-control" readonly>
                    <div class="form-text">Otomatis dibuat oleh sistem.</div>
                </div>
                <div class="col-md-6 col-xl-5">
                    <label class="form-label">Nama Lengkap Pasien <span class="text-danger">*</span></label>
                    <input type="text" name="nm_pasien" class="form-control" placeholder="Masukkan nama lengkap" required autofocus>
                </div>
                <div class="col-md-6 col-xl-4">
                    <label class="form-label">No. KTP / NIK</label>
                    <input type="text" name="no_ktp" class="form-control" placeholder="16 digit NIK" maxlength="16">
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jk" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" class="form-control" placeholder="Kota/Kabupaten">
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control" required onchange="hitungUmur(this.value)">
                </div>
                <div class="col-md-6 col-xl-3">
                    <label class="form-label">Umur</label>
                    <div class="input-group">
                        <input type="number" name="umur" id="umur-field" class="form-control" value="0" readonly>
                        <span class="input-group-text">tahun</span>
                    </div>
                    <div class="form-text">Dihitung otomatis dari tanggal lahir.</div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <label class="form-label">Nama Ibu Kandung</label>
                    <input type="text" name="nm_ibu" class="form-control" placeholder="Nama ibu kandung">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Kontak dan Alamat</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Jalan, RT/RW, Desa/Kelurahan"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Telepon / HP <span class="text-danger">*</span></label>
                    <input type="tel" name="no_tlp" class="form-control" placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-warning animate-fade-up">
        <div class="card-header">
            <h3 class="card-title">Penjamin / Asuransi</h3>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Cara Bayar / Penjamin <span class="text-danger">*</span></label>
                    <select name="kd_pj" class="form-select" required id="select-penjamin">
                        <option value="">-- Pilih Penjamin --</option>
                        <?php foreach ($penjamin as $pj): ?>
                            <option value="<?= esc($pj['kd_pj']) ?>"><?= esc($pj['png_jawab']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 d-none" id="group-bpjs">
                    <label class="form-label">No. Peserta BPJS</label>
                    <input type="text" name="no_peserta" class="form-control" placeholder="13 digit no peserta" maxlength="13">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-success animate-fade-up">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h3 class="card-title mb-1">Simpan Data Pasien</h3>
                <p class="text-muted mb-0 small">Pastikan data identitas, kontak, dan penjamin sudah benar sebelum disimpan.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    Daftarkan Pasien
                </button>
                <a href="<?= site_url('module/pasien') ?>" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

<script>
    function hitungUmur(tglLahir) {
        if (!tglLahir) {
            return;
        }

        const today = new Date();
        const birth = new Date(tglLahir);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        document.getElementById('umur-field').value = age >= 0 ? age : 0;
    }

    document.getElementById('select-penjamin').addEventListener('change', function() {
        const text = this.options[this.selectedIndex].text.toLowerCase();
        const bpjsGroup = document.getElementById('group-bpjs');

        if (text.includes('bpjs') || text.includes('jkn')) {
            bpjsGroup.classList.remove('d-none');
        } else {
            bpjsGroup.classList.add('d-none');
        }
    });
</script>

<?= $this->endSection() ?>