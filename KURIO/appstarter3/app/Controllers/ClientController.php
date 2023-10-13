<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CustomerModel;
  
class ClientController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('header');
        echo view('client', $data);
        echo view('footer');
    }
 }  