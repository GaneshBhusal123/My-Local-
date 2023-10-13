<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;
class StudentController extends Controller
{
    public function index()
    {
        
        echo view('header');
        echo view('school');
        echo view('footer');


    }
}    