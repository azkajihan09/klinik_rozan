<?php
namespace App\Controllers;

class Pasien extends Module
{
    /**
     * Override create - form pasien khusus dengan No RM otomatis
     */
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Generate No. Rekam Medis otomatis (format: 000001, 000002, dst)
        $last = $db->table('pasien')->orderBy('no_rkm_medis', 'DESC')->get(1)->getRowArray();
        $lastNum = $last ? (int) $last['no_rkm_medis'] : 0;
        $noRM = str_pad((string) ($lastNum + 1), 6, '0', STR_PAD_LEFT);

        // Data referensi
        $penjamin = $db->table('penjab')->orderBy('png_jawab')->get()->getResultArray();

        return view('pasien/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'noRM' => $noRM,
            'penjamin' => $penjamin,
        ]);
    }

    /**
     * Riwayat kunjungan pasien
     */
    public function riwayat(string $noRm)
    {
        $this->requireLogin();
        $db = db_connect();
        $pasien = $db->table('pasien')->where('no_rkm_medis', urldecode($noRm))->get()->getRowArray();
        $kunjungan = $db->table('reg_periksa')->where('no_rkm_medis', urldecode($noRm))->orderBy('tgl_registrasi', 'DESC')->get(50)->getResultArray();
        return view('crud/riwayat_pasien', compact('pasien', 'kunjungan'));
    }
}
