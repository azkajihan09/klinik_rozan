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
            'Rawat Jalan Hari Ini' => $db->table('reg_periksa')->where('tgl_registrasi', $today)->where('status_lanjut','Ralan')->countAllResults(),
            'Rawat Inap Aktif' => $db->table('kamar_inap')->where('tgl_keluar', null)->countAllResults(),
            'Resep Hari Ini' => $db->table('resep_obat')->where('tgl_peresepan', $today)->countAllResults(),
            'Order Lab Hari Ini' => $db->table('permintaan_lab')->where('tgl_permintaan', $today)->countAllResults(),
            'Order Radiologi Hari Ini' => $db->table('permintaan_radiologi')->where('tgl_permintaan', $today)->countAllResults(),
            'Billing Hari Ini' => $db->table('mlite_billing')->where('tgl_billing', $today)->countAllResults(),
        ];
        return view('dashboard/index', [
            'stats' => $stats,
            'modules' => config(SimrsModules::class)->modules,
        ]);
    }
}
