<?php
namespace App\Controllers;

use App\Models\GenericModel;
use Config\SimrsModules;

class Module extends BaseController
{
    protected array $modules;

    public function __construct()
    {
        $this->modules = config(SimrsModules::class)->modules;
    }

    protected function cfg(string $key): array
    {
        if (! isset($this->modules[$key])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Module tidak ditemukan: ' . esc($key));
        }
        return $this->modules[$key];
    }

    protected function model(array $cfg): GenericModel
    {
        return (new GenericModel())->configure($cfg['table'], $cfg['pk'], $cfg['fields'] ?? $cfg['form']);
    }

    public function index(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $keyword = $this->request->getGet('q');
        $model = $this->model($cfg);
        $data = $model->searchPaginated($cfg['search'], $keyword, 15);
        return view('crud/index', [
            'moduleKey' => $key,
            'cfg' => $cfg,
            'rows' => $data['rows'],
            'pager' => $data['pager'],
            'keyword' => $keyword,
        ]);
    }

    public function create(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        return view('crud/form', ['moduleKey' => $key, 'cfg' => $cfg, 'row' => [], 'mode' => 'create']);
    }

    public function store(string $key)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $payload = $this->payload($cfg);
        if (! empty($payload['password'])) {
            $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
        }
        try {
            $db = db_connect();
            $db->query('SET FOREIGN_KEY_CHECKS=0');
            $this->model($cfg)->insert($payload);
            $db->query('SET FOREIGN_KEY_CHECKS=1');
            return redirect()->to('/module/' . $key)->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(string $key, string $id)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $row = $this->model($cfg)->where($cfg['pk'], urldecode($id))->first();
        if (! $row) return redirect()->to('/module/' . $key)->with('error', 'Data tidak ditemukan.');
        return view('crud/form', ['moduleKey' => $key, 'cfg' => $cfg, 'row' => $row, 'mode' => 'edit']);
    }

    public function update(string $key, string $id)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        $payload = $this->payload($cfg);
        if (isset($payload['password']) && $payload['password'] === '') unset($payload['password']);
        if (! empty($payload['password'])) $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
        try {
            $db = db_connect();
            $db->query('SET FOREIGN_KEY_CHECKS=0');
            $this->model($cfg)->where($cfg['pk'], urldecode($id))->set($payload)->update();
            $db->query('SET FOREIGN_KEY_CHECKS=1');
            return redirect()->to('/module/' . $key)->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function delete(string $key, string $id)
    {
        $this->requireLogin();
        $cfg = $this->cfg($key);
        try {
            $this->model($cfg)->where($cfg['pk'], urldecode($id))->delete();
            return redirect()->to('/module/' . $key)->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    protected function payload(array $cfg): array
    {
        $payload = [];
        // Fields yang merupakan foreign key (harus NULL jika kosong)
        $fkFields = ['kd_pj','kd_kec','kd_kab','kd_kel','kd_prop','suku_bangsa','bahasa_pasien','cacat_fisik','perusahaan_pasien'];

        foreach ($cfg['form'] as $field) {
            $value = $this->request->getPost($field);
            if ($value !== null) {
                if ($value === '' && in_array($field, $fkFields)) {
                    $payload[$field] = null;
                } elseif ($value === '' && (str_contains($field, 'tgl') || str_contains($field, 'tanggal'))) {
                    // Tanggal kosong -> default '0000-00-00'
                    $payload[$field] = '0000-00-00';
                } elseif ($value === '' && str_contains($field, 'jam')) {
                    // Jam kosong -> default '00:00:00'
                    $payload[$field] = '00:00:00';
                } else {
                    $payload[$field] = $value;
                }
            }
        }
        return $payload;
    }
}
