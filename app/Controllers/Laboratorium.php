<?php
namespace App\Controllers;

class Laboratorium extends Module
{
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Generate no order otomatis (PL + tanggal + urut)
        $prefix = 'PL' . date('Ymd');
        $last = $db->table('permintaan_lab')->like('noorder', $prefix, 'after')->orderBy('noorder', 'DESC')->get(1)->getRowArray();
        $urut = $last ? ((int) substr($last['noorder'], -4)) + 1 : 1;
        $noOrder = $prefix . str_pad((string) $urut, 4, '0', STR_PAD_LEFT);

        // Antrian hari ini
        $antrian = $db->table('reg_periksa r')
            ->select('r.no_rawat, r.no_rkm_medis, r.kd_dokter, r.kd_poli, r.jam_reg, p.nm_pasien, p.jk')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left')
            ->where('r.tgl_registrasi', date('Y-m-d'))
            ->orderBy('r.jam_reg', 'ASC')
            ->get()
            ->getResultArray();

        // Dokter aktif
        $dokter = $db->table('dokter')->where('status', '1')->orderBy('nm_dokter')->get()->getResultArray();

        return view('laboratorium/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'noOrder' => $noOrder,
            'antrian' => $antrian,
            'dokter' => $dokter,
        ]);
    }
}
