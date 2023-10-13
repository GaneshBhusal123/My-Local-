<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CustomerModel;
  
class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    } 
  
    public function loginAuth()
    {
        
        helper(['form']);    
            $session = session();
            
            $customerModel = new CustomerModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            if(!empty($email) && !empty( $password))
            {
                    $data = $customerModel->where('email', $email)->Where('verify_status',1)->first();
            if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'firstname' => $data['firstname'],
                     'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'role'=>'admin',
                    'isLoggedIn' => TRUE
                ]; 
                $session->set($ses_data);
              
                return redirect()->to('kurio/dashboard');
               
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('kurio/signin');
                }
        }else{    
                $session->setFlashdata('msg', 'Email does not exist.');
                 return redirect()->to('kurio/signin');
            }
               
            }else{
            $session->setFlashdata('msg', 'All Field Is Mandatory.');
            return redirect()->to('kurio/signin');

            }
      
    }
}