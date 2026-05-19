<?php
namespace App\Controllers;

class Pasien extends Module
{
    public function riwayat(string $noRm)
    {
        $this->requireLogin();
        $db = db_connect();
        $pasien = $db->table('pasien')->where('no_rkm_medis', urldecode($noRm))->get()->getRowArray();
        $kunjungan = $db->table('reg_periksa')->where('no_rkm_medis', urldecode($noRm))->orderBy('tgl_registrasi','DESC')->get(50)->getResultArray();
        return view('crud/riwayat_pasien', compact('pasien','kunjungan'));
    }

}
