<?php


namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\EmployeeModel;


class EmployeeController extends Controller{

	// set index page view
	public function index() {

		return view('user_ajax');

	}

	// handle fetch all eamployees ajax request
	public function fetchAll() {
		  $employeeModel = new EmployeeModel();
		  $emps = $employeeModel->findAll();
		$output = '';
		if (count($emps) > 0){
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Text</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp["id"] . '</td>
                <td><img src="Public/Ajax_Uploads/' . $emp["image"] . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp["firstname"] . ' ' . $emp["lastname"]. '</td>
                <td>' . $emp["email"] . '</td>
                <td>' . $emp["phone"]. '</td>
                <td>' . $emp["text"]. '</td>
                <td>
                  <a href="#"  
					id="' . $emp["id"] . '" firstname="' . $emp["firstname"] . '" lastname="' . $emp["lastname"] . '" email="' . $emp["email"] . '" phone="' . $emp["phone"] . '"
					text="' . $emp["text"] . '" image="' . $emp["image"] . '"
					class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

					 <a href="#" id="' . $emp["id"] . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>

                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

	// handle insert a new employee ajax request
public function store(){

		$request = \Config\Services::request();
		  if ($request->is("post"))
		  	{
		 			$id=$this->request->getVar("id");
          $rules = [
            "image" => [
                "rules" => [
                    "uploaded[image]",
                    "is_image[image]",
                    "mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]",
                    "max_size[image,4096]",
                    "max_dims[image,1024,768]",
                ],
            ],
        ];

            if ($this->validate($rules)){
              $file = $this->request->getFile("image");
                if($file->isValid())
                    {
                      $image_name = $file->getRandomName();
                      $filepath = $file->move("Public/Ajax_Uploads", $image_name);
                    }

                     $data =[
                      "firstname"=>$this->request->getVar('firstname'),
                      "lastname"=>$this->request->getVar('lastname'),
                      "email"=>$this->request->getVar('email'),
                      "phone"=>$this->request->getVar('phone'),
                      "text"=>$this->request->getVar('text'),
                      "image"=>$image_name,
                      ];
                      

                      $employeeModel = new EmployeeModel();
                        $data1 = $employeeModel->insert($data);
                      if(!empty($data1)){
                        $response = array('status' => 200);
                      echo json_encode($response);
                    }




              }
              
              
                 

               



                    

			}

	}

	// handle edit an employee ajax request
	// public function edit($id){
		
	// 	 $employeeModel = new EmployeeModel();
	// 	 $response = $employeeModel->find($id);
	// 	 	echo json_encode($response);
		
	// }

	// handle update an employee ajax request
	public function update(){

	 $request = \Config\Services::request();
	 $id=$this->request->getVar("id");
	  if ($request->is("post"))
	  	{

           $rules = [
            "image" => [
                "rules" => [
                    "uploaded[image]",
                    "is_image[image]",
                    "mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]",
                    "max_size[image,4096]",
                    "max_dims[image,1024,768]",
                ],
            ],
        ];

         if ($this->validate($rules)){

              $file=$this->request->getFile("image");
                  if($file->isValid())
                    {
                      $image_name = $file->getRandomName();
                      $filepath = $file->move("Public/Ajax_Uploads", $image_name);
                    }

                   $data =[
                      "firstname"=>$this->request->getVar('firstname'),
                      "lastname"=>$this->request->getVar('lastname'),
                      "email"=>$this->request->getVar('email'),
                      "phone"=>$this->request->getVar('phone'),
                      "text"=>$this->request->getVar('text'),
                      "image"=>$image_name,
                      ];


                      $employeeModel = new EmployeeModel();
                      $data1 = $employeeModel->update($id, $data);
                    if(!empty($data1))
                      {
                        $message =
                        '<!doctype html><html lang="en-US"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Reset Password Email Template</title><meta name="description" content="Reset Password Email Template."><style type="text/css">a:hover{text-decoration:underline!important}</style></head><body marginheight="0" topmargin="0" marginwidth="0" style="margin:0;background-cyolor:#f2f3f8" leftmargin="0"><table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);font-family:"Open Sans",sans-serif"><tr><td><table style="background-color:#f2f3f8;max-width:670px;margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="height:80px">&nbsp;</td></tr><tr><td style="text-align:center"><a href="https://rakeshmandal.com" title="logo" target="_blank"><img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo"></a></td></tr><tr><td style="height:20px">&nbsp;</td></tr><tr><td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff;border-radius:3px;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06)"><tr><td style="height:40px">&nbsp;</td></tr><tr><td style="padding:0 35px"><h1 style="color:#1e1e2d;font-weight:500;margin:0;font-size:32px;font-family:Rubik,sans-serif">Update Credential Link </h1><span style="display:inline-block;vertical-align:middle;margin:29px 0 26px;border-bottom:1px solid #cecece;width:100px"></span><p style="color:#455056;font-size:15px;line-height:24px;margin:0"></p><a href="' .
                        site_url() .
                       "/update_credential/" .
                         base64_encode($this->request->getVar("email")) .
                        '">Verify</a></td></tr><tr><td style="height:40px">&nbsp;</td></tr></table></td><tr><td style="height:20px">&nbsp;</td></tr><tr><td style="text-align:center"><p style="font-size:14px;color:rgba(69,80,86,.7411764705882353);line-height:18px;margin:0 0 0">&copy;<strong>www.rakeshmandal.com</strong></p></td></tr><tr><td style="height:80px">&nbsp;</td></tr></table></td></tr></table></body></html>';
                    $email = \Config\Services::email();
                     $to = $this->request->getVar("email");
                     $email->setTo($to);
                     $email->setfrom(
                        "testgannuphp123@gmail.com",
                        "Update Credential Link"
                     );
                    
                    $email->setSubject("This is Updation of Email Link");
                    $email->setMessage($message);
                    if($email->send()){

                      $response = array('status' => 200,'msg'=>"Email is Sent Successfully");
                      echo json_encode($response);
                            
                      }
                      else{

                        echo "Email is not Sent"; 

                      }


               } 
          


         }

              	

	  	}

	 
	}

	// handle delete an employee ajax request
public function delete($id=null){	
		 $employeeModel = new EmployeeModel();
		 	$data2 = $employeeModel->delete($id);
		 	 if(!empty($data2 )){

		 	 	$response=true;

		 	 }else{

		 	 	$response=false;

		 	 }
		 	 echo $response;

		
	}

}