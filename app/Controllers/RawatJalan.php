<?php
namespace App\Controllers;

class RawatJalan extends Module
{
    /**
     * Override create - form pemeriksaan rawat jalan dengan pilih pasien dari antrian
     */
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Ambil antrian hari ini yang belum diperiksa (status Ralan)
        $antrian = $db->table('reg_periksa r')
            ->select('r.no_rawat, r.no_rkm_medis, r.kd_dokter, r.kd_poli, r.jam_reg, r.stts, p.nm_pasien, p.jk, p.tgl_lahir')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left')
            ->where('r.tgl_registrasi', date('Y-m-d'))
            ->where('r.status_lanjut', 'Ralan')
            ->orderBy('r.jam_reg', 'ASC')
            ->get()
            ->getResultArray();

        return view('rawat_jalan/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'antrian' => $antrian,
        ]);
    }
}
