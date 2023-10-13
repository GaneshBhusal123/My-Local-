<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BookModel;
class Book extends Controller {

    public function index()
    {        
        helper(['form', 'url']);
        $this->BookModel = new BookModel();
        $data['books'] = $this->BookModel->get_all_books();
        return view('book_view', $data);

    }

    public function book_add()
    { 


        helper(['form', 'url']); 
        $this->BookModel = new BookModel();

        $val = $this->validate([
            'book_isbn' => 'required',
            'book_title' => 'required',
            'book_author'  => 'required',
            'book_category' => 'required',
            'book_description' => 'required',
            'book_type' => 'required'
            
        ]);

        if (!empty($val))
        {
            
           $data = array(
            'book_isbn' => $this->request->getPost('book_isbn'),
            'book_title' => $this->request->getPost('book_title'),
            'book_author' => $this->request->getPost('book_author'),
            'book_category' => $this->request->getPost('book_category'),
             'book_description' => $this->request->getPost('book_description'),
             'book_type' => $this->request->getPost('book_type'),
            );
           
            $insert = $this->BookModel->book_add($data);
            echo json_encode(array("status" => TRUE));
        }
        else{

            echo view('book_view',[
                   'validation' => $this->validator
             ]);    
            }
    }

    public function ajax_edit($id)
     {   

        $this->BookModel = new BookModel();
        $data = $this->BookModel->get_by_id($id);
        echo json_encode($data);
    }

    public function book_update()
     {   
       
        helper(['form', 'url']);
        $this->BookModel = new BookModel();
        $val = $this->validate([
            'book_isbn' => 'required',
            'book_title' => 'required',
            'book_author'  => 'required',
            'book_category' => 'required',
            'book_description' => 'required',
            'book_type' => 'required',
            
        ]);

        if(!empty($val))
        {
                  
        $data = array(
            'book_isbn' => $this->request->getPost('book_isbn'),
            'book_title' => $this->request->getPost('book_title'),
            'book_author' => $this->request->getPost('book_author'),
            'book_category' => $this->request->getPost('book_category'),
            'book_description' => $this->request->getPost('book_description'),
            'book_type' => $this->request->getPost('book_type'),
           
             );

            $this->BookModel->book_update(array('book_id' =>$this->request->getPost('book_id')), $data);
            echo json_encode(array("status" => TRUE));   
        }
        else{
            echo view('book_view',[
                   'validation' => $this->validator
             ]);

            }  
        }

    public function book_delete($id){
             helper(['form', 'url']);
            $this->BookModel = new BookModel();
            $this->BookModel->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }

   
}

