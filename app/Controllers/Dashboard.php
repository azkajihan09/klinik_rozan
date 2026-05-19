<?php
namespace App\Controllers;

use Config\SimrsModules;

class Dashboard extends BaseController
{
    public function index()
    {
        $this->requireLogin();
        $db = db_connect();
        $today = date('Y-m-d');

        $stats = [
            'Pasien' => $db->table('pasien')->countAllResults(),
            'Registrasi Hari Ini' => $db->table('reg_periksa')->where('tgl_registrasi', $today)->countAllResults(),
            'Rawat Jalan Hari Ini' => $db->table('reg_periksa')->where('tgl_registrasi', $today)->where('status_lanjut', 'Ralan')->countAllResults(),
            'Rawat Inap Aktif' => $db->table('kamar_inap')->where('tgl_keluar', null)->countAllResults(),
            'Resep Hari Ini' => $db->table('resep_obat')->where('tgl_peresepan', $today)->countAllResults(),
            'Order Lab Hari Ini' => $db->table('permintaan_lab')->where('tgl_permintaan', $today)->countAllResults(),
            'Order Radiologi Hari Ini' => $db->table('permintaan_radiologi')->where('tgl_permintaan', $today)->countAllResults(),
            'Billing Hari Ini' => $db->table('mlite_billing')->where('tgl_billing', $today)->countAllResults(),
            'Dokter Aktif' => $db->table('dokter')->where('status', '1')->countAllResults(),
        ];

        // Antrian hari ini (max 10)
        $antrian = $db->table('reg_periksa')
            ->where('tgl_registrasi', $today)
            ->orderBy('jam_reg', 'ASC')
            ->get(10)
            ->getResultArray();

        // Dokter aktif (max 6)
        $dokter_list = $db->table('dokter')
            ->where('status', '1')
            ->orderBy('nm_dokter', 'ASC')
            ->get(6)
            ->getResultArray();

        return view('dashboard/index', [
            'stats' => $stats,
            'antrian' => $antrian,
            'dokter_list' => $dokter_list,
            'modules' => config(SimrsModules::class)->modules,
        ]);
    }
}
