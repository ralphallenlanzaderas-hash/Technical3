<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['full_name', 'email', 'phone', 'address'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'full_name' => 'required|min_length[3]|max_length[255]',
        'email'     => 'required|valid_email|max_length[255]',
        'phone'     => 'required|min_length[7]|max_length[20]',
        'address'   => 'permit_empty|max_length[500]',
    ];

    protected $validationMessages = [
        'full_name' => [
            'required' => 'Please provide the customer\'s full name.',
        ],
        'email' => [
            'required'    => 'An email address is required.',
            'valid_email' => 'Please provide a valid email address.',
        ],
    ];
}