<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;
use App\Models\UserfileModel;
class ProfileController extends Controller
{
    public function index()
    {
        helper(["form"]);
        $session = session();
        if ($session->get("role") == "user"){
            $email = $session->get("email");
            $customerModel = new CustomerModel();
            $db = \Config\Database::connect();
            $builder = $db->table("customers");
            $builder->where("email", $session->get("email"));
            $query = $builder->get();
            $data1["userlist"] = $query->getResult("array");

            echo view("header", $data1);
            echo view("dashboard", $data1);
            echo view("footer");
        }

        if ($session->get("role") == "admin"){
            $email = $session->get("email");
            $customerModel = new CustomerModel();
            $data["userlist"] = $customerModel->findAll();

            echo view("header");
            echo view("dashboard", $data);
            echo view("footer");
        }
    }
    public function profile()
    {
        $session = session();
        $id = $session->get("id");
        $customerModel = new CustomerModel();
        $data["userlist"] = $customerModel->find($id);
        

        echo view("header");
        echo view("edit", $data);
        echo view("footer");
    }

    public function update()
    {
        $session = session();
        $customerModel = new CustomerModel();
        $id = $this->request->getVar("id");
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

        //This validates the image property.
        if ($this->validate($rules)) {
            $file = $this->request->getFile("image");
            if ($file->isValid()) {
                $image_name = $file->getRandomName();
                $filepath = $file->move("Public/Uploads", $image_name);
            }

            $data = [
                "firstname" => $this->request->getVar("firstname"),
                "lastname" => $this->request->getVar("lastname"),
                "email" => $this->request->getVar("email"),
                "address" => $this->request->getVar("address"),
                "mobile" => $this->request->getVar("mobile"),
                "gender" => $this->request->getVar("gender"),
                "image" => $image_name,
                "date_of_birth" => $this->request->getVar("date_of_birth"),
            ];
            $session->set($data);
            //if all the condition is satisfy  then record updated successfully.
            $data1 = $customerModel->update($id, $data);

            if (!empty($data1)) {
                return redirect()
                    ->to(site_url("kurio/dashboard"))
                    ->with("msg", " Details updated successfully");
            }
        } else {
            $data = [
                "firstname" => $this->request->getVar("firstname"),
                "lastname" => $this->request->getVar("lastname"),
                "email" => $this->request->getVar("email"),
                "address" => $this->request->getVar("address"),
                "mobile" => $this->request->getVar("mobile"),
                "gender" => $this->request->getVar("gender"),
                "date_of_birth" => $this->request->getVar("date_of_birth"),
            ];

            $session->set($data);
            $data2 = $customerModel->update($id, $data);
            if (!empty($data2)) {
                return redirect()
                    ->to(site_url("kurio/dashboard"))
                    ->with("msg", "Details Updated Successfully");
            }
        }
    }
    public function delete()
    {
       
       
        $id = $this->request->getVar("id");
        $customerModel = new CustomerModel();
        $data2 = $customerModel->where("id", $id)->delete($id);
        if ($data2) {
            $res = true;
        } else {
            $res = false;
        }
        echo $res;
    }

    public function remove_file($id = null)
    {
        $userfileModel = new UserFileModel();
        $data["userlist"] = $userfileModel->where("id", $id)->delete($id);
        if (!empty($data)) {
            return redirect()
                ->to(site_url("kurio/file"))
                ->with("msg", "Deleted Successfully");
        }
    }

    public function edit_file($id = null)
    {
        $userfileModel = new UserFileModel();
        $data["userlist"] = $userfileModel->where("id", $id)->first();

        echo view("header");
        echo view("edit_file", $data);
        echo view("footer");
    }
    public function update_file()
    {
        $userfileModel = new UserFileModel();
        $id = $this->request->getVar("id");
        $request = \Config\Services::request();
        if ($request->is("post")) {
            $session = session();
            $validationRule = [
                "image" => [
                    "uploaded[image]",
                    "mime_in[image,image/jpg,image/jpeg,image/gif,image/png]",
                    "max_size[image,4096]",
                    "errors" => [
                        "uploaded[image" => "Please select an image.",
                    ],
                ],
            ];

            if ($this->validate($validationRule)) {
                $file = $this->request->getFile("image");
                if (!empty($file)) {
                    if ($file->isValid()) {
                        $image_name = $file->getRandomName();
                        $filepath = $file->move(
                            "Public/Multiple_Uploads",
                            $image_name
                        );
                    }
                    $data = [
                        "image" => $image_name,
                    ];
                    $session->set($data);
                    //if all the condition is satisfy  then record updated successfully.
                    $data1 = $userfileModel->update($id, $data);
                    if (!empty($data1)) {
                        return redirect()
                            ->to(site_url("kurio/file"))
                            ->with("msg", "Image updated successfully");
                    }
                }
            } else {
                return redirect()
                    ->to(site_url("kurio/edit_file/$id"))
                    ->with("msg", "File is required");
            }
        }
    }

    public function file()
    {

        $session = session();
        $id = $session->get("id");
        $userfileModel = new UserfileModel();
        $data["userslist"] = $userfileModel->orderBy("id", $id)->findAll();

        echo view("header");
        echo view("file", $data);
        echo view("footer");
    }

    public function uploadfile()
    {
        $request = \Config\Services::request();
        if ($request->is("post")) {
            $session = session();
            $validationRule = [
                "image" => [
                    "uploaded[image]",
                    "mime_in[image,image/jpg,image/jpeg,image/gif,image/png]",
                    "max_size[image,4096]",
                    "errors" => [
                        "uploaded[image" => "Please select an image.",
                    ],
                ],
            ];
            $id = $session->get("id");
            if ($this->validate($validationRule)){
                 $files["image"] = $this->request->getFileMultiple("image");
                    if(!empty($files)){
                        foreach ($files["image"] as $file) {
                            $image_name = $file->getRandomName();
                            $filepath = $file->move(
                            "Public/Multiple_Uploads",
                            $image_name
                            );
                            $data = [
                            "image" => $image_name,
                            "parent_id" => $id,
                            "title" => $this->request->getVar("title"),
                            "description" => $this->request->getVar(
                                "description"
                            ),
                        ];

                        $userfileModel = new UserfileModel();
                        $data1 = $userfileModel->insert($data);
                    }

                        return redirect()
                        ->to(site_url("kurio/file"))
                        ->with("msg", "Uploaded");
                }
            } else {
                    return redirect()
                    ->to(site_url("kurio/file"))
                    ->with("msg", "File is Required or Invalid");
            }
        }
    }

    public function update_modal()
    {
        $id = $this->request->getVar("id");

        $session = session();
        $userFileModel = new UserFileModel();

        $request = \Config\Services::request();

        if ($request->is("post")) {
            $session = session();
            $validationRule = [
                "image" => [
                    "uploaded[image]",
                    "mime_in[image,image/jpg,image/jpeg,image/gif,image/png]",
                    "max_size[image,4096]",
                    "errors" => [
                        "uploaded[image" => "Please select an image.",
                    ],
                ],
            ];

            if ($this->validate($validationRule)) {
                $file = $this->request->getFile("image");
                if (!empty($file)) {
                    if ($file->isValid()) {
                        $image_name = $file->getRandomName();

                        $filepath = $file->move(
                            "Public/Multiple_Uploads",
                            $image_name
                        );
                    }
                    $data = [
                        "image" => $image_name,
                        "title" => $this->request->getVar("title"),
                        "description" => $this->request->getVar("description"),
                    ];

                    $data2 = $userFileModel->update($id, $data);
                    if (!empty($data2)) {
                        return redirect()
                            ->to(site_url("kurio/file"))
                            ->with("msg", "Data updated successfully");
                    }
                }
            } else {
                $data = [
                    "title" => $this->request->getVar("title"),
                    "description" => $this->request->getVar("description"),
                ];
                $data3 = $userFileModel->update($id, $data);
                if (!empty($data3)) {
                    return redirect()
                        ->to(site_url("kurio/file"))
                        ->with("msg", "Data updated successfully");
                }
            }
        }
    }

    public function logout()
    {
        $session = session();
        if ($session->get("role") == "user") {
            return redirect()
                ->to(site_url("kurio/user"))
                ->with("msg", "Logout Successfully");
        } else {
            return redirect()
                ->to(site_url("kurio/signin"))
                ->with("msg", "Logout Successfully");
        }
        $session->destroy();
    }


   

}
