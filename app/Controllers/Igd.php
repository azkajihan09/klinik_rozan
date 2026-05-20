<?php
namespace App\Controllers;

class Igd extends Module
{
    /**
     * Override create - form IGD/Triase dengan pilih pasien dari antrian
     */
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Ambil antrian hari ini (semua jenis layanan)
        $antrian = $db->table('reg_periksa r')
            ->select('r.no_rawat, r.no_rkm_medis, r.kd_dokter, r.kd_poli, r.jam_reg, r.stts, r.status_lanjut, p.nm_pasien, p.jk, p.tgl_lahir')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left')
            ->where('r.tgl_registrasi', date('Y-m-d'))
            ->orderBy('r.jam_reg', 'ASC')
            ->get()
            ->getResultArray();

        return view('igd/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'antrian' => $antrian,
        ]);
    }
}
