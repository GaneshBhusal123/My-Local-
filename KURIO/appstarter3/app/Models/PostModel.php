<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class PostModel extends Model{
    protected $table = 'posts';
    protected $allowedFields = [
        
       	'id',
        'name',
        'designation',
        'image',
        'created_at',
       
    ];
   

}