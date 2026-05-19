<?php
namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'mlite_users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username','fullname','password','email','role','access'];

    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }
}
