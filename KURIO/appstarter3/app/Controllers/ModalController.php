<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;

class ModalController extends Controller
{
    public function modal()
    {
        helper(["form"]);
        $data = [];
        echo view("header");
        echo view("model", $data);
        echo view("footer");
    }
}

