<?php
namespace App\Controllers;

class RawatInap extends Module
{
    /**
     * Override create - form rawat inap dengan pilih pasien & kamar
     */
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Antrian hari ini (semua, bisa dari IGD atau registrasi Ranap)
        $antrian = $db->table('reg_periksa r')
            ->select('r.no_rawat, r.no_rkm_medis, r.kd_dokter, r.kd_poli, r.jam_reg, r.status_lanjut, p.nm_pasien, p.jk')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left')
            ->where('r.tgl_registrasi', date('Y-m-d'))
            ->orderBy('r.jam_reg', 'ASC')
            ->get()
            ->getResultArray();

        // Kamar yang kosong
        $kamar = $db->table('kamar k')
            ->select('k.kd_kamar, k.kd_bangsal, k.trf_kamar, k.kelas, b.nm_bangsal')
            ->join('bangsal b', 'b.kd_bangsal = k.kd_bangsal', 'left')
            ->where('k.status', 'KOSONG')
            ->orderBy('b.nm_bangsal')
            ->orderBy('k.kd_kamar')
            ->get()
            ->getResultArray();

        return view('rawat_inap/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'antrian' => $antrian,
            'kamar' => $kamar,
        ]);
    }
}
