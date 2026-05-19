<?php
namespace App\Controllers;

class Billing extends Module
{
    public function hitung(string $noRawat)
    {
        $this->requireLogin();
        $db = db_connect();
        $noRawat = urldecode($noRawat);
        $data = [
            'registrasi' => (float) ($db->table('reg_periksa')->select('biaya_reg')->where('no_rawat',$noRawat)->get()->getRow('biaya_reg') ?? 0),
            'billing' => $db->table('mlite_billing')->where('no_rawat',$noRawat)->get()->getResultArray(),
            'resep' => $db->table('resep_obat')->where('no_rawat',$noRawat)->countAllResults(),
            'lab' => $db->table('permintaan_lab')->where('no_rawat',$noRawat)->countAllResults(),
            'radiologi' => $db->table('permintaan_radiologi')->where('no_rawat',$noRawat)->countAllResults(),
        ];
        return view('crud/hitung_billing', ['noRawat'=>$noRawat, 'data'=>$data]);
    }

}
