<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel;

class SignupController extends Controller
{
    public function index()
    {
        helper(["form"]);
        $data = [];
        echo view("signup", $data);
    }

    public function store()
    {
        helper(["form"]);
        $rules = [
            "firstname" => "required|min_length[2]|max_length[50]",
            "lastname" => "required|min_length[2]|max_length[50]",
            "email" => "required|min_length[4]|max_length[100]|valid_email",
            "password" => "required|min_length[4]|max_length[50]",
            "confirm_password" => "matches[password]",
        ];

        if ($this->validate($rules)) {
            $request = \Config\Services::request();
            $session = session();
            $customerModel = new CustomerModel();
            $email = $this->request->getVar("email");

            $data3 = $customerModel->where("email", $email)->first();

            $data = [
                "firstname" => $this->request->getVar("firstname"),
                "lastname" => $this->request->getVar("lastname"),
                "email" => $this->request->getVar("email"),
                "password" => password_hash(
                    $this->request->getVar("password"),
                    PASSWORD_DEFAULT
                ),
            ];

            $data2 = $customerModel->save($data);
            //print_r($data2);exit;
            if (!empty($data2)) {
              

                $message =
                    '<!doctype html><html lang="en-US"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><title>Reset Password Email Template</title><meta name="description" content="Reset Password Email Template."><style type="text/css">a:hover{text-decoration:underline!important}</style></head><body marginheight="0" topmargin="0" marginwidth="0" style="margin:0;background-cyolor:#f2f3f8" leftmargin="0"><table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);font-family:"Open Sans",sans-serif"><tr><td><table style="background-color:#f2f3f8;max-width:670px;margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="height:80px">&nbsp;</td></tr><tr><td style="text-align:center"><a href="https://rakeshmandal.com" title="logo" target="_blank"><img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo"></a></td></tr><tr><td style="height:20px">&nbsp;</td></tr><tr><td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff;border-radius:3px;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06)"><tr><td style="height:40px">&nbsp;</td></tr><tr><td style="padding:0 35px"><h1 style="color:#1e1e2d;font-weight:500;margin:0;font-size:32px;font-family:Rubik,sans-serif">Register Credential Link </h1><span style="display:inline-block;vertical-align:middle;margin:29px 0 26px;border-bottom:1px solid #cecece;width:100px"></span><p style="color:#455056;font-size:15px;line-height:24px;margin:0"></p><a href="' .
                    base_url() .
                    "/update_credential/" .
                    base64_encode($this->request->getVar("email")) .
                    '">Verify</a></td></tr><tr><td style="height:40px">&nbsp;</td></tr></table></td><tr><td style="height:20px">&nbsp;</td></tr><tr><td style="text-align:center"><p style="font-size:14px;color:rgba(69,80,86,.7411764705882353);line-height:18px;margin:0 0 0">&copy;<strong>www.rakeshmandal.com</strong></p></td></tr><tr><td style="height:80px">&nbsp;</td></tr></table></td></tr></table></body></html>';

                $email = \Config\Services::email();
                $to = $this->request->getVar("email");
                $email->setTo($to);
                $email->setfrom(
                    "testgannuphp123@gmail.com",
                    "Login Credential Link"
                );
                $email->setSubject("Login  Credential Link");
                $email->setMessage($message);

                if ($email->send()) {
                    $session->setFlashdata(
                        "msg",
                        "Email is  sent Successfully "
                    );
                } else {
                    echo "email is not sent";
                }
            }

            return redirect()->to("kurio/signup");
        } else {
            $data["validation"] = $this->validator;
            echo view("signup", $data);
        }
    }
}
