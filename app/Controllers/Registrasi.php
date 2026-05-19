<?php
namespace App\Controllers;

class Registrasi extends Module
{
    public function createNoRawat()
    {
        $prefix = date('Y/m/d');
        $db = db_connect();
        $last = $db->table('reg_periksa')->like('no_rawat', $prefix, 'after')->orderBy('no_rawat','DESC')->get(1)->getRowArray();
        $urut = $last ? ((int) substr($last['no_rawat'], -6)) + 1 : 1;
        return $this->response->setJSON(['no_rawat' => $prefix . '/' . str_pad((string) $urut, 6, '0', STR_PAD_LEFT)]);
    }

}
