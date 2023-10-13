<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class FileModel extends Model{
    protected $table = ' profile';
    protected $allowedFields = [   

        'id',
        'parent_id',
        'address',
        'image',
        'countries',
        'states',
        'cities',
        'pincode',
        'Country_Name',
         'State_Name',
          'City_Name',
          'vals'


    ];
}