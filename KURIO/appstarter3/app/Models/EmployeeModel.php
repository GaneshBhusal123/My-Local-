<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class EmployeeModel extends Model{
    protected $table = 'ajax_file_upload';
    protected $allowedFields = [
        'id',
        'image',
        'firstname',
        'lastname',
        'email',
        'post',
        'phone',
        'text',
        'created_at'
    ];
}