<?php
namespace App\Models;

use CodeIgniter\Model;

class GenericModel extends Model
{
    protected $table;
    protected $primaryKey;
    protected $returnType = 'array';
    protected $useAutoIncrement = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    public function configure(string $table, string $primaryKey, array $allowedFields): self
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;
        $this->useAutoIncrement = in_array($primaryKey, ['id','id_billing','id_triase']);
        return $this;
    }

    public function searchPaginated(array $searchFields, ?string $keyword, int $perPage = 15): array
    {
        if ($keyword) {
            $this->groupStart();
            foreach ($searchFields as $i => $field) {
                $i === 0 ? $this->like($field, $keyword) : $this->orLike($field, $keyword);
            }
            $this->groupEnd();
        }
        return [
            'rows' => $this->orderBy($this->primaryKey, 'DESC')->paginate($perPage),
            'pager' => $this->pager,
        ];
    }
}
