<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Ajax extends Controller
{
    public function index()
    {
         
       return view("ajax_crud");
  
    }

    public function fileUpload(){
    
            $data = array();
         // Read new token and assign to $data['token']
            $data['token'] = csrf_hash();
         ## Validation
            $validation = \Config\Services::validation();
            $input = $validation->setRules([
              'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,docx,pdf],'
         ]);
         if ($validation->withRequest($this->request)->run() == FALSE){
              $data['success'] = 0;
              $data['error'] = $validation->getError('file');// Error response
         }else{
                if($file = $this->request->getFile('file')){
                    if ($file->isValid() && ! $file->hasMoved()){
                         // Get file name and extension
                         $name = $file->getName();
                         $ext = $file->getClientExtension();
                         // Get random file name
                         $newName = $file->getRandomName();

                         // Store file in public/uploads/ folder
                         $file->move('Public/Uploads', $newName);

                         // File path to display preview
                         $filepath = site_url()."Public/Uploads/".$newName;
                         // Response
                         $data['success'] = 1;
                         $data['message'] = 'Uploaded Successfully!';
                         $data['filepath'] = $filepath;
                         $data['extension'] = $ext;

                    }else{
                         // Response
                         $data['success'] = 2;
                         $data['message'] = 'File not uploaded.'; 
                    }
              }else{
                    // Response
                    $data['success'] = 2;
                    $data['message'] = 'File not uploaded.';
              }
         }
         return $this->response->setJSON($data);

    }
   

}
