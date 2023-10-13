<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;
class UploadMultipleFiles extends Controller
{
    public function index() {
        echo view('header');
        echo  view('file');
         echo  view('footer');
    }
    function uploadFiles($id){
             


             
    }
}