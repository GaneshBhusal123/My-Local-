<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserfileModel extends Model{
    protected $table = 'multiple_files';
    protected $allowedFields = [
        
       	'id',
        'image',
        'parent_id',
        'title',
        'description',
       
    ];
   

}