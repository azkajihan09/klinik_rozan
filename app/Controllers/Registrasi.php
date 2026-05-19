<?php
namespace App\Controllers;

class Registrasi extends Module
{
    /**
     * Override create untuk form registrasi khusus
     */
    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $db = db_connect();

        // Generate no_rawat otomatis
        $prefix = date('Y/m/d');
        $last = $db->table('reg_periksa')->like('no_rawat', $prefix, 'after')->orderBy('no_rawat', 'DESC')->get(1)->getRowArray();
        $urut = $last ? ((int) substr($last['no_rawat'], -6)) + 1 : 1;
        $noRawat = $prefix . '/' . str_pad((string) $urut, 6, '0', STR_PAD_LEFT);

        // Generate no_reg
        $lastReg = $db->table('reg_periksa')->where('tgl_registrasi', date('Y-m-d'))->orderBy('no_reg', 'DESC')->get(1)->getRowArray();
        $noReg = $lastReg ? ((int) $lastReg['no_reg']) + 1 : 1;

        // Data referensi
        $dokter = $db->table('dokter')->where('status', '1')->orderBy('nm_dokter')->get()->getResultArray();
        $poli = $db->table('poliklinik')->where('status', '1')->orderBy('nm_poli')->get()->getResultArray();
        $penjamin = $db->table('penjab')->orderBy('png_jawab')->get()->getResultArray();

        return view('registrasi/form', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'row' => [],
            'mode' => 'create',
            'noRawat' => $noRawat,
            'noReg' => $noReg,
            'dokter' => $dokter,
            'poli' => $poli,
            'penjamin' => $penjamin,
        ]);
    }

    /**
     * API: Cari pasien berdasarkan keyword
     */
    public function cariPasien()
    {
        $this->requireLogin();
        $q = $this->request->getGet('q');
        if (!$q || strlen($q) < 2) {
            return $this->response->setJSON([]);
        }
        $db = db_connect();
        $results = $db->table('pasien')
            ->groupStart()
                ->like('no_rkm_medis', $q)
                ->orLike('nm_pasien', $q)
                ->orLike('no_tlp', $q)
            ->groupEnd()
            ->orderBy('nm_pasien')
            ->get(10)
            ->getResultArray();

        return $this->response->setJSON($results);
    }

    /**
     * API: Generate no_rawat
     */
    public function createNoRawat()
    {
        $prefix = date('Y/m/d');
        $db = db_connect();
        $last = $db->table('reg_periksa')->like('no_rawat', $prefix, 'after')->orderBy('no_rawat', 'DESC')->get(1)->getRowArray();
        $urut = $last ? ((int) substr($last['no_rawat'], -6)) + 1 : 1;
        return $this->response->setJSON(['no_rawat' => $prefix . '/' . str_pad((string) $urut, 6, '0', STR_PAD_LEFT)]);
    }
}
