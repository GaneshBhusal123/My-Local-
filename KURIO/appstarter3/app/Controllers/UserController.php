<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CustomerModel;
  
class UserController extends Controller
{
    public function index()
    {
    
        helper(['form']);
        echo view('user');

    } 
    
    public function loginAuth()
    {
        $session = session();
        $customerModel = new CustomerModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $customerModel ->where('email', $email)->first();

        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                        'id' => $data['id'],
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'email' => $data['email'],
                        'role'  =>'user',
                        'created_at' => $data['created_at'],
                        'isLoggedIn' => TRUE
                    ];

                $session->set($ses_data);
                return redirect()->to('kurio/dashboard');
            
            }else{
                    $session->setFlashdata('msg', 'Password is incorrect.');
                    return redirect()->to('kurio/user');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('kurio/user');
        }
    }
}