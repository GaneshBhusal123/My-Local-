<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class MainModel extends Model{
	public function __construct()
	 {
        parent::__construct();
        $db = \Config\Database::connect();
    }
 
    public function selectData($table,$where=array())
        {

            $db = \Config\Database::connect();
            $builder = $db->table($table);
            $builder->select('*');
            $builder->where($where);
            $query = $builder->get();
            return $query->getResult();

        }

       
}