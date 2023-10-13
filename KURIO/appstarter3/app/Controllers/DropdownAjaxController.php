<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MainModel;
use App\Models\FileModel;

class DropdownAjaxController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    protected $model;
    public function __construct()
    {
        $mainModel = new MainModel();
        $fileModel = new FileModel();
    }

    public function index()
    {
        helper(["form", "url"]);
        $session = session();
        $id = $session->get("id");
        $mainModel = new MainModel();
        $country = $mainModel->selectData("countries");
        $data["countries"] = $country;

        echo view("header");
        echo view("dropdown-view", $data);
        echo view("footer");
    }

    public function country()
    {
        helper(["form", "url"]);
        $mainModel = new MainModel();
        $country = $mainModel->selectData("countries");
        $countryData = $mainModel->selectData("countries", [
            "country_id" => $countryId,
        ]);
        if (!empty($countryData)) {
            foreach ($countryData as $country) {
                echo '<option value="' .
                    $country->id .
                    '">' .
                    $country->name .
                    "</option>";
            }
        } else {
            echo '<option value="">Not Found</option>';
        }
    }

    public function state()
    {
        $mainModel = new MainModel();
        $countryId = $this->request->getPost("cId");
        $stateData = $mainModel->selectData("states", [
            "country_id" => $countryId,
        ]);

        if (!empty($stateData)) {
            foreach ($stateData as $state) {
                echo '<option value="' .
                    $state->id .
                    '">' .
                    $state->name .
                    "</option>";
            }
        } else {
            echo '<option value="">Not Found</option>';
        }
    }
    public function cities()
    {
        $mainModel = new MainModel();
        $stateId = $this->request->getPost("sId");
        $cityData = $mainModel->selectData("cities", ["state_id" => $stateId]);

        if (!empty($cityData)) {
            foreach ($cityData as $city) {
                echo '<option value="' .
                    $city->id .
                    '">' .
                    $city->name .
                    "</option>";
            }
        } else {
            echo '<option value="">Not Found</option>';
        }

        exit();
    }
    public function upload_dropdown()
    {
        $session = session();
        $id = $session->get("id");
        $fileModel = new FileModel();
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
                            "Public/Single_Uploads",
                            $image_name
                        );
                    }
                    $data = [
                        "address" => $this->request->getVar("address"),
                        "countries" => $this->request->getVar("countries"),
                        "states" => $this->request->getVar("states"),
                        "cities" => $this->request->getVar("cities"),
                        "image" => $image_name,
                        "parent_id" => $id,
                        "pincode" => $this->request->getVar("pincode"),
                    ];

                    $fileModel = new FileModel();
                    $data1 = $fileModel->save($data);
                }
                return redirect()
                    ->to(site_url("kurio/dropdown"))
                    ->with("msg", " Inserted Successfully");
            } else {
                return redirect()
                    ->to(site_url("kurio/dropdown"))
                    ->with("msg", "File is Required ");
            }
        }
    }
    public function userlist()
    {
        $session = session();
        $id = $session->get("id");
        $fileModel = new FileModel();
        $db = \Config\Database::connect();
        $builder = $db->table("profile");
        $builder->select(
            "profile.*,countries.name as Country_Name,states.name as State_Name,cities.name as City_Name "
        );
        $builder->join(
            "countries",
            'profile.countries
                =countries.id',
            "left"
        );
        $builder->join("states", "profile.states = states.id ", "left");
        $builder->join(
            "cities",
            'profile.cities = cities.id
                ',
            "left"
        );
        $query = $builder->get();
        $data1["userslist"] = $query->getResult("array");

        echo view("header");
        echo view("dropdown_userlist", $data1);
        echo view("footer");
    }

    public function edit_list($id = null)
    {
        $fileModel = new FileModel();
        $data["userlist"] = $fileModel->where("id", $id)->first();

        $mainModel = new MainModel();
        $country = $mainModel->selectData("countries");
        $data["country"] = $country;
        $states = $mainModel->selectData("states", [
            "country_id" => $data["userlist"]["countries"],
        ]);
        $data["states"] = $states;
        $cities = $mainModel->selectData("cities", [
            "state_id" => $data["userlist"]["states"],
        ]);
        $data["cities"] = $cities;

        echo view("header");
        echo view("edit_page", $data);
        echo view("footer");
    }
    public function state_data()
    {
        $mainModel = new MainModel();
        $countryId = $this->request->getPost("cId");
        $stateData = $mainModel->selectData("states", [
            "country_id" => $countryId,
        ]);

        if (!empty($stateData)) {
            foreach ($stateData as $state) {
                echo '<option value="' .
                    $state->id .
                    '">' .
                    $state->name .
                    "</option>";
            }
        } else {
            echo '<option value="">Not Found</option>';
        }
    }

    public function city_data()
    {

        $mainModel = new MainModel();
        $stateId = $this->request->getPost("sId");
        $cityData = $mainModel->selectData("cities", ["state_id" => $stateId]);
        if (!empty($cityData)) {
            foreach ($cityData as $city){
                echo '<option value="' .
                    $city->id .
                    '">' .
                    $city->name .
                    "</option>";
            }
        } else {
            echo '<option value="">Not Found</option>';
        }
    }

    public function update_list()
    {
        $session = session();
        $fileModel = new FileModel();
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
                            "Public/Single_Uploads",
                            $image_name
                        );
                    }

                    $data = [
                        "address" => $this->request->getVar("address"),
                        "countries" => $this->request->getVar("countries"),
                        "states" => $this->request->getVar("states"),
                        "cities" => $this->request->getVar("cities"),
                        "image" => $image_name,
                        "pincode" => $this->request->getVar("pincode"),
                    ];

                    $fileModel = new FileModel();
                    $data1 = $fileModel->update($id, $data);
                    if (!empty($data1)) {
                        return redirect()
                            ->to(site_url("kurio/userlist"))
                            ->with("msg", " Details updated successfully");
                    }
                }
            } else {
                $data = [
                    "address" => $this->request->getVar("address"),
                    "countries" => $this->request->getVar("countries"),
                    "states" => $this->request->getVar("states"),
                    "cities" => $this->request->getVar("cities"),
                    "pincode" => $this->request->getVar("pincode"),
                ];

                $data2 = $fileModel->update($id, $data);
                if (!empty($data2)) {
                    return redirect()
                        ->to(site_url("kurio/userlist"))
                        ->with("msg", " Details updated successfully");
                }
            }
        }
    }


        public function load_modal()
            {
                helper(["form"]);
                $data = [];
                echo view("modal", $data);


            }


    public function delete_file($id = null)
    {
        $fileModel = new FileModel();
        $data["userlist"] = $fileModel->where("id",$id)->delete($id);
        if (!empty($data))
        {   
                return redirect()
                ->to(site_url("kurio/userlist"))
                ->with("msg", " Data Deleted Successfully");
        }
    }
   
   public function delete_selected(){
         $request = \Config\Services::request();
         if ($request->is("post")){
             $data = $this->request->getPost("vals");
             $fileModel = new FileModel();
              $data2 = $fileModel->delete($data);
              if ($data2){
                    $res = true;
                } else {
                $res = false;
            }
            echo $res;
             
         }
           
    }

     public function delete_checked(){
        $request = \Config\Services::request();
            if ($request->is("post")){
              $data = $this->request->getPost("vals");
               $fileModel = new FileModel();
               $data2 = $fileModel->delete($data);
               if ($data2){
                    $res = true;
                } else {
                $res = false;
            }
            echo $res;
        }
    } 

}