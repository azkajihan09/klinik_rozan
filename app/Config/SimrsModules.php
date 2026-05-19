<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class SimrsModules extends BaseConfig
{
    public array $modules = [
        'pasien' => [
            'title' => 'Data Pasien',
            'table' => 'pasien',
            'pk' => 'no_rkm_medis',
            'search' => ['no_rkm_medis', 'nm_pasien', 'no_ktp', 'no_tlp'],
            'list' => ['no_rkm_medis', 'nm_pasien', 'jk', 'tgl_lahir', 'alamat', 'no_tlp', 'kd_pj'],
            'form' => ['no_rkm_medis', 'nm_pasien', 'no_ktp', 'jk', 'tmp_lahir', 'tgl_lahir', 'alamat', 'no_tlp', 'nm_ibu', 'umur', 'kd_pj', 'no_peserta', 'email'],
            'fields' => ['no_rkm_medis', 'nm_pasien', 'no_ktp', 'jk', 'tmp_lahir', 'tgl_lahir', 'nm_ibu', 'alamat', 'gol_darah', 'pekerjaan', 'stts_nikah', 'agama', 'tgl_daftar', 'no_tlp', 'umur', 'pnd', 'keluarga', 'namakeluarga', 'kd_pj', 'no_peserta', 'kd_kel', 'kd_kec', 'kd_kab', 'pekerjaanpj', 'alamatpj', 'kelurahanpj', 'kecamatanpj', 'kabupatenpj', 'perusahaan_pasien', 'suku_bangsa', 'bahasa_pasien', 'cacat_fisik', 'email', 'nip', 'kd_prop', 'propinsipj']
        ],
        'registrasi' => [
            'title' => 'Registrasi Pasien',
            'table' => 'reg_periksa',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'no_rkm_medis', 'kd_dokter', 'kd_poli'],
            'list' => ['no_rawat', 'tgl_registrasi', 'jam_reg', 'no_rkm_medis', 'kd_dokter', 'kd_poli', 'status_lanjut', 'status_bayar', 'stts'],
            'form' => ['no_reg', 'no_rawat', 'tgl_registrasi', 'jam_reg', 'kd_dokter', 'no_rkm_medis', 'kd_poli', 'p_jawab', 'almt_pj', 'hubunganpj', 'biaya_reg', 'stts', 'stts_daftar', 'status_lanjut', 'kd_pj', 'umurdaftar', 'sttsumur', 'status_bayar', 'status_poli'],
            'fields' => ['no_reg', 'no_rawat', 'tgl_registrasi', 'jam_reg', 'kd_dokter', 'no_rkm_medis', 'kd_poli', 'p_jawab', 'almt_pj', 'hubunganpj', 'biaya_reg', 'stts', 'stts_daftar', 'status_lanjut', 'kd_pj', 'umurdaftar', 'sttsumur', 'status_bayar', 'status_poli']
        ],
        'rawat-jalan' => [
            'title' => 'Pemeriksaan Rawat Jalan',
            'table' => 'pemeriksaan_ralan',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'keluhan', 'pemeriksaan', 'penilaian'],
            'list' => ['no_rawat', 'tgl_perawatan', 'jam_rawat', 'tensi', 'suhu_tubuh', 'keluhan', 'penilaian', 'nip'],
            'form' => ['no_rawat', 'tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'tinggi', 'berat', 'spo2', 'gcs', 'kesadaran', 'keluhan', 'pemeriksaan', 'alergi', 'rtl', 'penilaian', 'instruksi', 'evaluasi', 'nip'],
            'fields' => ['no_rawat', 'tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'tinggi', 'berat', 'spo2', 'gcs', 'kesadaran', 'keluhan', 'pemeriksaan', 'alergi', 'lingkar_perut', 'rtl', 'penilaian', 'instruksi', 'evaluasi', 'nip']
        ],
        'rawat-inap' => [
            'title' => 'Rawat Inap',
            'table' => 'kamar_inap',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'kd_kamar', 'diagnosa_awal', 'diagnosa_akhir'],
            'list' => ['no_rawat', 'kd_kamar', 'tgl_masuk', 'jam_masuk', 'tgl_keluar', 'jam_keluar', 'lama', 'ttl_biaya', 'stts_pulang'],
            'form' => ['no_rawat', 'kd_kamar', 'trf_kamar', 'diagnosa_awal', 'diagnosa_akhir', 'tgl_masuk', 'jam_masuk', 'tgl_keluar', 'jam_keluar', 'lama', 'ttl_biaya', 'stts_pulang'],
            'fields' => ['no_rawat', 'kd_kamar', 'trf_kamar', 'diagnosa_awal', 'diagnosa_akhir', 'tgl_masuk', 'jam_masuk', 'tgl_keluar', 'jam_keluar', 'lama', 'ttl_biaya', 'stts_pulang']
        ],
        'igd' => [
            'title' => 'IGD / Triase',
            'table' => 'mlite_triase_igd',
            'pk' => 'id_triase',
            'search' => ['no_rawat', 'no_rkm_medis', 'kategori', 'keluhan_utama'],
            'list' => ['id_triase', 'no_rawat', 'no_rkm_medis', 'tgl_triase', 'kesadaran', 'kategori', 'skala_triase', 'keluhan_utama'],
            'form' => ['no_rawat', 'no_rkm_medis', 'tgl_triase', 'petugas_id', 'kesadaran', 'airway', 'breathing', 'circulation', 'tekanan_darah', 'nadi', 'respirasi', 'suhu', 'spo2', 'gcs_e', 'gcs_v', 'gcs_m', 'kategori', 'skala_triase', 'keluhan_utama', 'diagnosa_awal'],
            'fields' => ['id_triase', 'no_rawat', 'no_rkm_medis', 'tgl_triase', 'petugas_id', 'kesadaran', 'airway', 'breathing', 'circulation', 'tekanan_darah', 'nadi', 'respirasi', 'suhu', 'spo2', 'gcs_e', 'gcs_v', 'gcs_m', 'kategori', 'skala_triase', 'keluhan_utama', 'diagnosa_awal', 'created_at', 'updated_at']
        ],
        'laboratorium' => [
            'title' => 'Permintaan Laboratorium',
            'table' => 'permintaan_lab',
            'pk' => 'noorder',
            'search' => ['noorder', 'no_rawat', 'dokter_perujuk', 'diagnosa_klinis'],
            'list' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'dokter_perujuk', 'status', 'diagnosa_klinis'],
            'form' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'tgl_sampel', 'jam_sampel', 'tgl_hasil', 'jam_hasil', 'dokter_perujuk', 'status', 'informasi_tambahan', 'diagnosa_klinis'],
            'fields' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'tgl_sampel', 'jam_sampel', 'tgl_hasil', 'jam_hasil', 'dokter_perujuk', 'status', 'informasi_tambahan', 'diagnosa_klinis']
        ],
        'radiologi' => [
            'title' => 'Permintaan Radiologi',
            'table' => 'permintaan_radiologi',
            'pk' => 'noorder',
            'search' => ['noorder', 'no_rawat', 'dokter_perujuk', 'diagnosa_klinis'],
            'list' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'dokter_perujuk', 'status', 'diagnosa_klinis'],
            'form' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'tgl_sampel', 'jam_sampel', 'tgl_hasil', 'jam_hasil', 'dokter_perujuk', 'status', 'informasi_tambahan', 'diagnosa_klinis'],
            'fields' => ['noorder', 'no_rawat', 'tgl_permintaan', 'jam_permintaan', 'tgl_sampel', 'jam_sampel', 'tgl_hasil', 'jam_hasil', 'dokter_perujuk', 'status', 'informasi_tambahan', 'diagnosa_klinis']
        ],
        'hasil-radiologi' => [
            'title' => 'Hasil Radiologi',
            'table' => 'hasil_radiologi',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'hasil'],
            'list' => ['no_rawat', 'tgl_periksa', 'jam', 'hasil'],
            'form' => ['no_rawat', 'tgl_periksa', 'jam', 'hasil'],
            'fields' => ['no_rawat', 'tgl_periksa', 'jam', 'hasil']
        ],
        'operasi' => [
            'title' => 'Booking Operasi',
            'table' => 'booking_operasi',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'kode_paket', 'kd_dokter', 'status'],
            'list' => ['no_rawat', 'kode_paket', 'tanggal', 'jam_mulai', 'jam_selesai', 'status', 'kd_dokter', 'kd_ruang_ok'],
            'form' => ['no_rawat', 'kode_paket', 'tanggal', 'jam_mulai', 'jam_selesai', 'status', 'kd_dokter', 'kd_ruang_ok'],
            'fields' => ['no_rawat', 'kode_paket', 'tanggal', 'jam_mulai', 'jam_selesai', 'status', 'kd_dokter', 'kd_ruang_ok']
        ],
        'farmasi' => [
            'title' => 'Resep Obat',
            'table' => 'resep_obat',
            'pk' => 'no_resep',
            'search' => ['no_resep', 'no_rawat', 'kd_dokter', 'status'],
            'list' => ['no_resep', 'no_rawat', 'kd_dokter', 'tgl_peresepan', 'jam_peresepan', 'status', 'tgl_penyerahan', 'jam_penyerahan'],
            'form' => ['no_resep', 'tgl_perawatan', 'jam', 'no_rawat', 'kd_dokter', 'tgl_peresepan', 'jam_peresepan', 'status', 'tgl_penyerahan', 'jam_penyerahan'],
            'fields' => ['no_resep', 'tgl_perawatan', 'jam', 'no_rawat', 'kd_dokter', 'tgl_peresepan', 'jam_peresepan', 'status', 'tgl_penyerahan', 'jam_penyerahan']
        ],
        'obat' => [
            'title' => 'Master Obat',
            'table' => 'databarang',
            'pk' => 'kode_brng',
            'search' => ['kode_brng', 'nama_brng', 'letak_barang'],
            'list' => ['kode_brng', 'nama_brng', 'kode_sat', 'letak_barang', 'h_beli', 'ralan', 'stokminimal', 'expire', 'status'],
            'form' => ['kode_brng', 'nama_brng', 'kode_satbesar', 'kode_sat', 'letak_barang', 'dasar', 'h_beli', 'ralan', 'kelas1', 'kelas2', 'kelas3', 'stokminimal', 'kdjns', 'expire', 'status', 'kode_industri', 'kode_kategori', 'kode_golongan'],
            'fields' => ['kode_brng', 'nama_brng', 'kode_satbesar', 'kode_sat', 'letak_barang', 'dasar', 'h_beli', 'ralan', 'kelas1', 'kelas2', 'kelas3', 'utama', 'vip', 'vvip', 'beliluar', 'jualbebas', 'karyawan', 'stokminimal', 'kdjns', 'isi', 'kapasitas', 'expire', 'status', 'kode_industri', 'kode_kategori', 'kode_golongan']
        ],
        'inventory' => [
            'title' => 'Stok Gudang',
            'table' => 'gudangbarang',
            'pk' => 'kode_brng',
            'search' => ['kode_brng', 'kd_bangsal', 'no_batch', 'no_faktur'],
            'list' => ['kode_brng', 'kd_bangsal', 'stok', 'no_batch', 'no_faktur'],
            'form' => ['kode_brng', 'kd_bangsal', 'stok', 'no_batch', 'no_faktur'],
            'fields' => ['kode_brng', 'kd_bangsal', 'stok', 'no_batch', 'no_faktur']
        ],
        'billing' => [
            'title' => 'Billing / Kasir',
            'table' => 'mlite_billing',
            'pk' => 'id_billing',
            'search' => ['kd_billing', 'no_rawat', 'keterangan'],
            'list' => ['id_billing', 'kd_billing', 'no_rawat', 'jumlah_total', 'potongan', 'jumlah_harus_bayar', 'jumlah_bayar', 'tgl_billing', 'jam_billing'],
            'form' => ['kd_billing', 'no_rawat', 'jumlah_total', 'potongan', 'jumlah_harus_bayar', 'jumlah_bayar', 'tgl_billing', 'jam_billing', 'id_user', 'keterangan'],
            'fields' => ['id_billing', 'kd_billing', 'no_rawat', 'jumlah_total', 'potongan', 'jumlah_harus_bayar', 'jumlah_bayar', 'tgl_billing', 'jam_billing', 'id_user', 'keterangan']
        ],
        'bpjs' => [
            'title' => 'BPJS / SEP',
            'table' => 'bridging_sep',
            'pk' => 'no_sep',
            'search' => ['no_sep', 'no_rawat', 'nomr', 'nama_pasien', 'no_kartu'],
            'list' => ['no_sep', 'no_rawat', 'tglsep', 'nomr', 'nama_pasien', 'no_kartu', 'jnspelayanan', 'nmpolitujuan'],
            'form' => ['no_sep', 'no_rawat', 'tglsep', 'tglrujukan', 'no_rujukan', 'kdppkrujukan', 'nmppkrujukan', 'jnspelayanan', 'catatan', 'diagawal', 'nmdiagnosaawal', 'kdpolitujuan', 'nmpolitujuan', 'klsrawat', 'nomr', 'nama_pasien', 'tanggal_lahir', 'peserta', 'jkel', 'no_kartu', 'notelep'],
            'fields' => ['no_sep', 'no_rawat', 'tglsep', 'tglrujukan', 'no_rujukan', 'kdppkrujukan', 'nmppkrujukan', 'kdppkpelayanan', 'nmppkpelayanan', 'jnspelayanan', 'catatan', 'diagawal', 'nmdiagnosaawal', 'kdpolitujuan', 'nmpolitujuan', 'klsrawat', 'klsnaik', 'pembiayaan', 'pjnaikkelas', 'lakalantas', 'user', 'nomr', 'nama_pasien', 'tanggal_lahir', 'peserta', 'jkel', 'no_kartu', 'tglpulang', 'asal_rujukan', 'eksekutif', 'cob', 'notelep', 'katarak', 'tglkkl', 'keterangankkl', 'suplesi', 'no_sep_suplesi', 'kdprop', 'nmprop', 'kdkab', 'nmkab', 'kdkec', 'nmkec', 'noskdp', 'kddpjp', 'nmdpdjp', 'tujuankunjungan', 'flagprosedur', 'penunjang', 'asesmenpelayanan', 'kddpjplayanan', 'nmdpjplayanan']
        ],
        'rekam-medis' => [
            'title' => 'Berkas Digital Perawatan',
            'table' => 'berkas_digital_perawatan',
            'pk' => 'no_rawat',
            'search' => ['no_rawat', 'kode', 'lokasi_file'],
            'list' => ['no_rawat', 'kode', 'lokasi_file'],
            'form' => ['no_rawat', 'kode', 'lokasi_file'],
            'fields' => ['no_rawat', 'kode', 'lokasi_file']
        ],
        'dokter' => [
            'title' => 'Master Dokter',
            'table' => 'dokter',
            'pk' => 'kd_dokter',
            'search' => ['kd_dokter', 'nm_dokter', 'no_telp'],
            'list' => ['kd_dokter', 'nm_dokter', 'jk', 'kd_sps', 'no_telp', 'status'],
            'form' => ['kd_dokter', 'nm_dokter', 'jk', 'tmp_lahir', 'tgl_lahir', 'gol_drh', 'agama', 'almt_tgl', 'no_telp', 'stts_nikah', 'kd_sps', 'alumni', 'no_ijn_praktek', 'status'],
            'fields' => ['kd_dokter', 'nm_dokter', 'jk', 'tmp_lahir', 'tgl_lahir', 'gol_drh', 'agama', 'almt_tgl', 'no_telp', 'stts_nikah', 'kd_sps', 'alumni', 'no_ijn_praktek', 'status']
        ],
        'poli' => [
            'title' => 'Master Poliklinik',
            'table' => 'poliklinik',
            'pk' => 'kd_poli',
            'search' => ['kd_poli', 'nm_poli'],
            'list' => ['kd_poli', 'nm_poli', 'registrasi', 'registrasilama', 'status'],
            'form' => ['kd_poli', 'nm_poli', 'registrasi', 'registrasilama', 'status'],
            'fields' => ['kd_poli', 'nm_poli', 'registrasi', 'registrasilama', 'status']
        ],
        'bangsal' => [
            'title' => 'Master Bangsal',
            'table' => 'bangsal',
            'pk' => 'kd_bangsal',
            'search' => ['kd_bangsal', 'nm_bangsal'],
            'list' => ['kd_bangsal', 'nm_bangsal', 'status'],
            'form' => ['kd_bangsal', 'nm_bangsal', 'status'],
            'fields' => ['kd_bangsal', 'nm_bangsal', 'status']
        ],
        'kamar' => [
            'title' => 'Master Kamar',
            'table' => 'kamar',
            'pk' => 'kd_kamar',
            'search' => ['kd_kamar', 'kd_bangsal'],
            'list' => ['kd_kamar', 'kd_bangsal', 'trf_kamar', 'status', 'kelas'],
            'form' => ['kd_kamar', 'kd_bangsal', 'trf_kamar', 'status', 'kelas'],
            'fields' => ['kd_kamar', 'kd_bangsal', 'trf_kamar', 'status', 'kelas', 'statusdata']
        ],
        'penjamin' => [
            'title' => 'Master Penjamin',
            'table' => 'penjab',
            'pk' => 'kd_pj',
            'search' => ['kd_pj', 'png_jawab'],
            'list' => ['kd_pj', 'png_jawab', 'nama_perusahaan', 'status'],
            'form' => ['kd_pj', 'png_jawab', 'nama_perusahaan', 'alamat_asuransi', 'no_telp', 'attn', 'status'],
            'fields' => ['kd_pj', 'png_jawab', 'nama_perusahaan', 'alamat_asuransi', 'no_telp', 'attn', 'status']
        ],
        'users' => [
            'title' => 'User & Role',
            'table' => 'mlite_users',
            'pk' => 'id',
            'search' => ['username', 'fullname', 'email', 'role'],
            'list' => ['id', 'username', 'fullname', 'email', 'role'],
            'form' => ['username', 'fullname', 'description', 'password', 'email', 'role', 'cap', 'access'],
            'fields' => ['id', 'username', 'fullname', 'description', 'password', 'password_changed_at', 'otp_code', 'otp_expires', 'avatar', 'email', 'role', 'cap', 'access']
        ]
    ];
}
