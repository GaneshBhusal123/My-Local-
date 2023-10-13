<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;
class UpdateCredential extends Controller
{
    public function index($email)
    {
        helper(["form"]);
        $request = \Config\Services::request();
        $customerModel = new CustomerModel();
        $a = base64_decode($email);
        //$uri=$this->request->uri->getSegment(2);
        helper(["form"]);
        $data = [
            "email" => $a,
        ];
        echo view("credential", $data);
    }
    public function save_credential()  
    {
            $session = session();
            $email=$this->request->getVar('email');
                $rules= [
            "password" => "required|min_length[4]|max_length[50]",
            "confirm_password" => "matches[password]",
                ];
                 $Password = $this->request->getVar("password");
                    $Confirm_password = $this->request->getVar("confirm_password");
               if(!empty($Password) && !empty($Confirm_password ))
                {

                    if($this->validate($rules))
            {
                   
                if ($Password  == $Confirm_password){
                $customerModel = new CustomerModel();
                $data = [
                     'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ];

                $db = \Config\Database::connect();
                $builder = $db->table("customers");
                $builder->set("password", $data);
                $builder->where("email", $email);
                $builder->update();
                $query = $builder->get();
                $data2 = $query->getResult("array");
                if(($data2))
                    {
                      $session->setFlashdata(
                        "msg",
                        " Password Updated  Successfully");
                        return redirect()->to('kurio/user'); 
                    }
                }
            }     
                } 
                else{
                    return redirect()->to(site_url("/update_credential/abc"))->with('msg',' All field is mandatory');
                }    

        
        }                 


}
