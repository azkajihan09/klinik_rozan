<?php
namespace App\Controllers;

class Farmasi extends Module
{
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Generate no resep otomatis
        $prefix = date('Ymd');
        $last = $db->table('resep_obat')->like('no_resep', $prefix, 'after')->orderBy('no_resep', 'DESC')->get(1)->getRowArray();
        $urut = $last ? ((int) substr($last['no_resep'], -4)) + 1 : 1;
        $noResep = $prefix . str_pad((string) $urut, 4, '0', STR_PAD_LEFT);

        $antrian = $db->table('reg_periksa r')
            ->select('r.no_rawat, r.no_rkm_medis, r.kd_dokter, r.kd_poli, p.nm_pasien, p.jk')
            ->join('pasien p', 'p.no_rkm_medis = r.no_rkm_medis', 'left')
            ->where('r.tgl_registrasi', date('Y-m-d'))
            ->orderBy('r.jam_reg', 'ASC')
            ->get()->getResultArray();

        $dokter = $db->table('dokter')->where('status', '1')->orderBy('nm_dokter')->get()->getResultArray();

        return view('farmasi/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'noResep' => $noResep,
            'antrian' => $antrian,
            'dokter' => $dokter,
        ]);
    }
}
