<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'full_name', 'email', 'created_at'];

    /**
     * Fetch the single demo user record.
     *
     * @return array|null
     */
    public function getDemoUser(): ?array
    {
        return $this->first();
    }
}