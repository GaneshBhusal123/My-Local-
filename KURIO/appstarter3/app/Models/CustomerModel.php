<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class CustomerModel extends Model{
    
    protected $table = 'customers';
    protected $allowedFields = [
        'id',
        'firstname',
        'lastname',
        'email',
        'address',
        'mobile',
        'image',
        'gender',
        'date_of_birth',
        'verify_status',
        'password',
        'confirm_password',
        'created_at'
    ];
}