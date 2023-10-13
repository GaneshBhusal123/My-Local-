<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;
class UpdatePassword extends Controller
{
    public function index($email)
    {
        helper(["form"]);
        $session = session();
        $request = \Config\Services::request();
        $customerModel = new CustomerModel();
        //$a = base64_decode($email);
        $uri = $this->request->uri->getSegment(2);

        helper(["form"]);
        $data = [
            "email" => $uri,
        ];
        $session->set($data);
        echo view("update_page", $data);
    }
    public function change_password()
    {
        $session = session();
        $session = session();
        $email = $this->request->getVar("email");

        //$uri=$this->request->uri->getSegment(2);
        $rules = [
            "password" => "required|min_length[4]|max_length[50]",
            "confirm_password" => "matches[password]",
        ];
        $Password = $this->request->getVar("password");
        $Confirm_password = $this->request->getVar("confirm_password");
        if (!empty($Password) && !empty($Confirm_password)) {
            if ($this->validate($rules)) {
                if ($Password == $Confirm_password) {
                    $customerModel = new CustomerModel();
                    $data = [
                        "password" => password_hash(
                            $this->request->getVar("password"),
                            PASSWORD_DEFAULT
                        ),
                    ];

                    $db = \Config\Database::connect();
                    $builder = $db->table("customers");
                    $builder->set("password", $data);
                    $builder->where("email", base64_decode($email));
                    $builder->update();
                    $query = $builder->get();
                    $data1["userlist"] = $query->getResult("array");

                    if ($data1) {
                        $session->setFlashdata(
                            "msg",
                            "Password Updated Successfully "
                        );
                        return redirect()->to("kurio/user");
                    }
                }
            }
        } else {
            return redirect()
                ->to(site_url("/update_page/abc"))
                ->with("msg", " All field is mandatory");
        }
    }
}
