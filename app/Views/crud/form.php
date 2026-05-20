<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
// Mapping nama field ke label yang lebih manusiawi
$fieldLabels = [
    'no_rkm_medis' => 'No. Rekam Medis',
    'nm_pasien' => 'Nama Pasien',
    'no_ktp' => 'No. KTP / NIK',
    'jk' => 'Jenis Kelamin',
    'tmp_lahir' => 'Tempat Lahir',
    'tgl_lahir' => 'Tanggal Lahir',
    'nm_ibu' => 'Nama Ibu',
    'alamat' => 'Alamat Lengkap',
    'gol_darah' => 'Golongan Darah',
    'pekerjaan' => 'Pekerjaan',
    'stts_nikah' => 'Status Nikah',
    'agama' => 'Agama',
    'tgl_daftar' => 'Tanggal Daftar',
    'no_tlp' => 'No. Telepon / HP',
    'umur' => 'Umur',
    'pnd' => 'Pendidikan',
    'keluarga' => 'Hubungan Keluarga',
    'namakeluarga' => 'Nama Keluarga',
    'kd_pj' => 'Kode Penjamin',
    'no_peserta' => 'No. Peserta (BPJS)',
    'email' => 'Email',
    'kd_kel' => 'Kelurahan',
    'kd_kec' => 'Kecamatan',
    'kd_kab' => 'Kabupaten',
    'kd_prop' => 'Provinsi',
    'suku_bangsa' => 'Suku Bangsa',
    'bahasa_pasien' => 'Bahasa',
    'cacat_fisik' => 'Cacat Fisik',
    'nip' => 'NIP Petugas',
    'perusahaan_pasien' => 'Perusahaan',
    'pekerjaanpj' => 'Pekerjaan Penanggung Jawab',
    'alamatpj' => 'Alamat Penanggung Jawab',
    'kelurahanpj' => 'Kelurahan PJ',
    'kecamatanpj' => 'Kecamatan PJ',
    'kabupatenpj' => 'Kabupaten PJ',
    'propinsipj' => 'Provinsi PJ',
    // Registrasi
    'no_reg' => 'No. Registrasi',
    'no_rawat' => 'No. Rawat',
    'tgl_registrasi' => 'Tanggal Registrasi',
    'jam_reg' => 'Jam Registrasi',
    'kd_dokter' => 'Kode Dokter',
    'no_rkm_medis' => 'No. Rekam Medis',
    'kd_poli' => 'Kode Poli',
    'p_jawab' => 'Penanggung Jawab',
    'almt_pj' => 'Alamat Penanggung Jawab',
    'hubunganpj' => 'Hubungan PJ',
    'biaya_reg' => 'Biaya Registrasi',
    'stts' => 'Status Antrian',
    'stts_daftar' => 'Status Daftar',
    'status_lanjut' => 'Jenis Layanan',
    'umurdaftar' => 'Umur Saat Daftar',
    'sttsumur' => 'Satuan Umur',
    'status_bayar' => 'Status Bayar',
    'status_poli' => 'Status Poli',
    // Rawat Jalan
    'tgl_perawatan' => 'Tanggal Perawatan',
    'jam_rawat' => 'Jam Rawat',
    'suhu_tubuh' => 'Suhu Tubuh (°C)',
    'tensi' => 'Tekanan Darah',
    'nadi' => 'Nadi (x/mnt)',
    'respirasi' => 'Respirasi (x/mnt)',
    'tinggi' => 'Tinggi Badan (cm)',
    'berat' => 'Berat Badan (kg)',
    'spo2' => 'SpO2 (%)',
    'gcs' => 'GCS',
    'kesadaran' => 'Kesadaran',
    'keluhan' => 'Keluhan Utama',
    'pemeriksaan' => 'Pemeriksaan Fisik',
    'alergi' => 'Alergi',
    'rtl' => 'Rencana Tindak Lanjut',
    'penilaian' => 'Penilaian / Diagnosa',
    'instruksi' => 'Instruksi',
    'evaluasi' => 'Evaluasi',
    'lingkar_perut' => 'Lingkar Perut',
    // IGD
    'id_triase' => 'ID Triase',
    'tgl_triase' => 'Tanggal Triase',
    'petugas_id' => 'ID Petugas',
    'airway' => 'Airway',
    'breathing' => 'Breathing',
    'circulation' => 'Circulation',
    'tekanan_darah' => 'Tekanan Darah',
    'suhu' => 'Suhu (°C)',
    'gcs_e' => 'GCS Eye',
    'gcs_v' => 'GCS Verbal',
    'gcs_m' => 'GCS Motorik',
    'kategori' => 'Kategori Triase',
    'skala_triase' => 'Skala Triase',
    'keluhan_utama' => 'Keluhan Utama',
    'diagnosa_awal' => 'Diagnosa Awal',
    'diagnosa_akhir' => 'Diagnosa Akhir',
    // Rawat Inap
    'kd_kamar' => 'Kode Kamar',
    'trf_kamar' => 'Tarif Kamar',
    'tgl_masuk' => 'Tanggal Masuk',
    'jam_masuk' => 'Jam Masuk',
    'tgl_keluar' => 'Tanggal Keluar',
    'jam_keluar' => 'Jam Keluar',
    'lama' => 'Lama Inap (hari)',
    'ttl_biaya' => 'Total Biaya',
    'stts_pulang' => 'Status Pulang',
    // Lab & Radiologi
    'noorder' => 'No. Order',
    'tgl_permintaan' => 'Tanggal Permintaan',
    'jam_permintaan' => 'Jam Permintaan',
    'tgl_sampel' => 'Tanggal Sampel',
    'jam_sampel' => 'Jam Sampel',
    'tgl_hasil' => 'Tanggal Hasil',
    'jam_hasil' => 'Jam Hasil',
    'dokter_perujuk' => 'Dokter Perujuk',
    'status' => 'Status',
    'informasi_tambahan' => 'Informasi Tambahan',
    'diagnosa_klinis' => 'Diagnosa Klinis',
    'hasil' => 'Hasil Pemeriksaan',
    'tgl_periksa' => 'Tanggal Periksa',
    'jam' => 'Jam',
    // Operasi
    'kode_paket' => 'Kode Paket Operasi',
    'tanggal' => 'Tanggal Operasi',
    'jam_mulai' => 'Jam Mulai',
    'jam_selesai' => 'Jam Selesai',
    'kd_ruang_ok' => 'Ruang OK',
    // Farmasi
    'no_resep' => 'No. Resep',
    'tgl_peresepan' => 'Tanggal Resep',
    'jam_peresepan' => 'Jam Resep',
    'tgl_penyerahan' => 'Tanggal Penyerahan',
    'jam_penyerahan' => 'Jam Penyerahan',
    // Obat
    'kode_brng' => 'Kode Barang',
    'nama_brng' => 'Nama Barang / Obat',
    'kode_satbesar' => 'Satuan Besar',
    'kode_sat' => 'Satuan Kecil',
    'letak_barang' => 'Lokasi / Rak',
    'dasar' => 'Harga Dasar',
    'h_beli' => 'Harga Beli',
    'ralan' => 'Harga Rawat Jalan',
    'kelas1' => 'Harga Kelas 1',
    'kelas2' => 'Harga Kelas 2',
    'kelas3' => 'Harga Kelas 3',
    'stokminimal' => 'Stok Minimal',
    'kdjns' => 'Jenis Barang',
    'expire' => 'Tanggal Kadaluarsa',
    'kode_industri' => 'Kode Industri',
    'kode_kategori' => 'Kode Kategori',
    'kode_golongan' => 'Kode Golongan',
    // Inventory
    'kd_bangsal' => 'Kode Bangsal',
    'stok' => 'Jumlah Stok',
    'no_batch' => 'No. Batch',
    'no_faktur' => 'No. Faktur',
    // Billing
    'id_billing' => 'ID Billing',
    'kd_billing' => 'Kode Billing',
    'jumlah_total' => 'Jumlah Total',
    'potongan' => 'Potongan / Diskon',
    'jumlah_harus_bayar' => 'Jumlah Harus Bayar',
    'jumlah_bayar' => 'Jumlah Dibayar',
    'tgl_billing' => 'Tanggal Billing',
    'jam_billing' => 'Jam Billing',
    'id_user' => 'ID User / Kasir',
    'keterangan' => 'Keterangan',
    // BPJS
    'no_sep' => 'No. SEP',
    'tglsep' => 'Tanggal SEP',
    'tglrujukan' => 'Tanggal Rujukan',
    'no_rujukan' => 'No. Rujukan',
    'jnspelayanan' => 'Jenis Pelayanan',
    'catatan' => 'Catatan',
    'diagawal' => 'Kode Diagnosa Awal',
    'nmdiagnosaawal' => 'Nama Diagnosa Awal',
    'kdpolitujuan' => 'Kode Poli Tujuan',
    'nmpolitujuan' => 'Nama Poli Tujuan',
    'klsrawat' => 'Kelas Rawat',
    'nama_pasien' => 'Nama Pasien',
    'tanggal_lahir' => 'Tanggal Lahir',
    'peserta' => 'Jenis Peserta',
    'jkel' => 'Jenis Kelamin',
    'no_kartu' => 'No. Kartu BPJS',
    'notelep' => 'No. Telepon',
    'nomr' => 'No. Rekam Medis',
    // Rekam Medis
    'kode' => 'Kode Berkas',
    'lokasi_file' => 'Lokasi File',
    // Dokter
    'nm_dokter' => 'Nama Dokter',
    'almt_tgl' => 'Alamat',
    'no_telp' => 'No. Telepon',
    'kd_sps' => 'Kode Spesialis',
    'alumni' => 'Alumni',
    'no_ijn_praktek' => 'No. Izin Praktik',
    'gol_drh' => 'Golongan Darah',
    // Poli
    'nm_poli' => 'Nama Poli',
    'registrasi' => 'Biaya Registrasi Baru',
    'registrasilama' => 'Biaya Registrasi Lama',
    // Bangsal & Kamar
    'nm_bangsal' => 'Nama Bangsal',
    'kelas' => 'Kelas',
    'statusdata' => 'Status Data',
    // Penjamin
    'png_jawab' => 'Penanggung Jawab',
    'nama_perusahaan' => 'Nama Perusahaan',
    'alamat_asuransi' => 'Alamat Asuransi',
    'attn' => 'Attention / PIC',
    // Users
    'username' => 'Username',
    'fullname' => 'Nama Lengkap',
    'description' => 'Deskripsi',
    'password' => 'Password',
    'role' => 'Role / Hak Akses',
    'cap' => 'Capabilities',
    'access' => 'Akses Menu',
];

// Fungsi untuk mendapatkan label
function getLabel(string $field, array $labels): string
{
    return $labels[$field] ?? ucwords(str_replace('_', ' ', $field));
}
?>

<div class="content-header px-0 pt-0 pb-2">
    <div class="container-fluid px-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="mb-1"><?= $mode === 'create' ? 'Tambah' : 'Edit' ?> <?= esc($cfg['title']) ?></h1>
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('module/' . $moduleKey) ?>"><?= esc($cfg['title']) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $mode === 'create' ? 'Tambah' : 'Edit' ?></li>
            </ol>
        </div>
        <a href="<?= site_url('module/' . $moduleKey) ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>

<?php if (session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= esc(session('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $mode === 'create' ? 'Form Tambah Data' : 'Form Edit Data' ?></h3>
    </div>
    <form method="post" action="<?= $mode === 'create' ? site_url('module/' . $moduleKey) : site_url('module/' . $moduleKey . '/update/' . rawurlencode((string)($row[$cfg['pk']] ?? ''))) ?>">
        <div class="card-body">
            <div class="row g-3">
                <?php foreach ($cfg['form'] as $field): ?>
                    <?php $value = $row[$field] ?? '';
                    $label = getLabel($field, $fieldLabels); ?>
                    <div class="col-md-6 col-xl-4">
                        <label class="form-label"><?= esc($label) ?></label>
                        <?php if (str_contains($field, 'alamat') || str_contains($field, 'hasil') || str_contains($field, 'keluhan') || str_contains($field, 'pemeriksaan') || str_contains($field, 'penilaian') || str_contains($field, 'instruksi') || str_contains($field, 'evaluasi') || str_contains($field, 'access') || str_contains($field, 'catatan') || str_contains($field, 'informasi') || str_contains($field, 'description')): ?>
                            <textarea name="<?= esc($field) ?>" class="form-control" rows="3" placeholder="<?= esc($label) ?>"><?= esc($value) ?></textarea>
                        <?php elseif (str_contains($field, 'tgl') || $field === 'tanggal_lahir' || $field === 'tanggal' || $field === 'expire' || $field === 'tglsep' || $field === 'tglrujukan'): ?>
                            <input type="date" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                        <?php elseif (str_contains($field, 'jam')): ?>
                            <input type="time" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control">
                        <?php elseif (str_contains($field, 'password')): ?>
                            <input type="password" name="<?= esc($field) ?>" value="" class="form-control" placeholder="Kosongkan jika tidak diubah">
                        <?php elseif (str_contains($field, 'email')): ?>
                            <input type="email" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control" placeholder="contoh@email.com">
                        <?php elseif ($field === 'jk' || $field === 'jkel'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" <?= $value === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= $value === 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        <?php elseif ($field === 'status_lanjut'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Jenis Layanan --</option>
                                <option value="Ralan" <?= $value === 'Ralan' ? 'selected' : '' ?>>Rawat Jalan</option>
                                <option value="Ranap" <?= $value === 'Ranap' ? 'selected' : '' ?>>Rawat Inap</option>
                            </select>
                        <?php elseif ($field === 'status' && ($moduleKey === 'dokter' || $moduleKey === 'poli' || $moduleKey === 'bangsal' || $moduleKey === 'obat')): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="1" <?= $value === '1' || $value === 1 ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $value === '0' || $value === 0 ? 'selected' : '' ?>>Non-Aktif</option>
                            </select>
                        <?php elseif ($field === 'agama'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Agama --</option>
                                <?php foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainnya'] as $ag): ?>
                                    <option value="<?= $ag ?>" <?= $value === $ag ? 'selected' : '' ?>><?= $ag ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($field === 'stts_nikah'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <?php foreach (['BELUM MENIKAH', 'MENIKAH', 'JANDA', 'DUDA'] as $sn): ?>
                                    <option value="<?= $sn ?>" <?= $value === $sn ? 'selected' : '' ?>><?= $sn ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($field === 'gol_darah' || $field === 'gol_drh'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih --</option>
                                <?php foreach (['-', 'A', 'B', 'AB', 'O'] as $gd): ?>
                                    <option value="<?= $gd ?>" <?= $value === $gd ? 'selected' : '' ?>><?= $gd ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($field === 'kesadaran'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih --</option>
                                <?php foreach (['Compos Mentis', 'Somnolence', 'Sopor', 'Coma', 'Apatis'] as $k): ?>
                                    <option value="<?= $k ?>" <?= $value === $k ? 'selected' : '' ?>><?= $k ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($field === 'role'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Pilih Role --</option>
                                <?php foreach (['admin', 'dokter', 'perawat', 'farmasi', 'kasir', 'pendaftaran', 'laboratorium', 'radiologi'] as $r): ?>
                                    <option value="<?= $r ?>" <?= $value === $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($field === 'sttsumur'): ?>
                            <select name="<?= esc($field) ?>" class="form-select">
                                <option value="">-- Satuan --</option>
                                <option value="Th" <?= $value === 'Th' ? 'selected' : '' ?>>Tahun</option>
                                <option value="Bl" <?= $value === 'Bl' ? 'selected' : '' ?>>Bulan</option>
                                <option value="Hr" <?= $value === 'Hr' ? 'selected' : '' ?>>Hari</option>
                            </select>
                        <?php elseif (str_contains($field, 'biaya') || str_contains($field, 'jumlah') || str_contains($field, 'tarif') || str_contains($field, 'stok') || str_contains($field, 'umur') || in_array($field, ['nadi', 'respirasi', 'spo2', 'lama', 'ttl_biaya', 'h_beli', 'ralan', 'potongan', 'trf_kamar', 'registrasi', 'registrasilama', 'kelas1', 'kelas2', 'kelas3', 'dasar', 'tinggi', 'berat', 'suhu_tubuh', 'suhu', 'gcs', 'gcs_e', 'gcs_v', 'gcs_m', 'stokminimal', 'no_reg'])): ?>
                            <input type="number" step="any" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control" placeholder="0">
                        <?php elseif ($field === 'no_tlp' || $field === 'no_telp' || $field === 'notelep'): ?>
                            <input type="tel" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control" placeholder="08xxxxxxxxxx">
                        <?php else: ?>
                            <input type="text" name="<?= esc($field) ?>" value="<?= esc($value) ?>" class="form-control" placeholder="<?= esc($label) ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="card-footer d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('module/' . $moduleKey) ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>