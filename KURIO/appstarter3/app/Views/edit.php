
    <body class="sb-nav-fixed">   
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo site_url('kurio/dashboard');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?php echo site_url('kurio/file');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Files
                            </a>
                            <a class="nav-link" href="<?php echo site_url('kurio/dropdown');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profile Page Add Address 
                            </a> 

                            <a class="nav-link" href="<?php echo site_url('book/index');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Ajax Crud App
                            </a> 
               
                        </div>
                      </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <div class="card-body">
                                    <main>
                                        <div class="container-fluid px-4">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                  <i class="fas fa-table me-1"></i>
                                                   <h1 class="mt-4">Profile</h1>
                                                </div>
                                               
                                                <?php if (session()->getFlashdata("msg")): ?>
                                             <div class="alert alert-success">
                                               <?= session()->getFlashdata("msg") ?>
                                            </div>
                                           <?php endif; ?> 
                                                <div class="card-body">
                                                    <div class="container-xl px-4 mt-4">
                        <!-- Account page navigation-->
                        <nav class="nav nav-borders">
                            <a class="nav-link active ms-0" href="<?php echo site_url('kurio/profile');?>">Profile</a>  
                        </nav>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
                        <hr class="mt-0 mb-4">
                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Profile Picture</div>
                                    <div class="card-body text-center">
                                       <form action="<?php echo site_url(
                                           "kurio/update"
                                       ); ?>" method="post"  enctype="multipart/form-data" runat="server" >
                                        
                                        <!-- Profile picture image-->
                                         <div class="mb-3">
                                          <?php $img =
                                              base_url() .
                                              "Public/Uploads/" .
                                              $userlist["image"]; ?>
                                      <!--******* If image is present then shows in the profile page otherwise  dummy image will  seen  in the profile Page *********-->
                                          <?php if ($userlist["image"]) { ?>
                                            <img class="img-account-profile rounded-circle mb-2"  src="<?php echo $img; ?>" id="my-image" height="200" width="200" >
                                         <?php } else { ?>
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                       class="rounded-circle img-fluid" style="width: 150px;"/> 
                                        <?php } ?>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4" id="image-container">JPG,PNG,JPEG,GIF,BMP Image is only allowed</div>

                                        <!-- Preview an image before it is uploaded-->    
                                        <input type="file"accept="jpeg/png/bmp/gif/jpg" id="image" name="image"class=" form-control" value="">
                                        
                                       <img id="blah"width="70" height="70" src="#" alt="your image" />
                                        <button class= "close-button" onclick="removeImage(this)">
                                            Close
                                        </button>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                            <!-- Form Group (username)-->
                                            <div class="mb-3">   
                                        <input type="hidden" name="id" id="id" value="<?php echo $userlist[
                                            "id"
                                        ]; ?>">
                                            </div>
                                            
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                              
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                                    <input class="form-control" id="inputFirstName" name="firstname"type="text" placeholder="Enter your first name" value="<?php echo $userlist[
                                                        "firstname"
                                                    ]; ?>">
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                                    <input class="form-control" id="inputLastName" name="lastname" type="text" placeholder="Enter your last name" value="<?php echo $userlist[
                                                        "lastname"
                                                    ]; ?>">
                                                </div>

                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhone">Mobile</label>
                                                    <input class="form-control" id="mobile" name="mobile" type="text" placeholder="Enter your phone number" value="<?php echo $userlist[
                                                        "mobile"
                                                    ]; ?>" onkeypress="phoneno()" maxlength="10">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLocation">Address</label>
                                                    <textarea class="form-control" name="address"placeholder="Enter your Address" id="inputLocation" ><?php echo $userlist['address']?></textarea>
                                                </div>
                                              </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email address" value="<?php echo $userlist[
                                                    "email"
                                                ]; ?>">
                                              </div>

                                               <!--  <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">State</label>
                                                <select  multiple="multiple" name="pr_state_id[]" id="pr_state_id" class="form-control">
                                                <option value="">Please Select</option>
                                                <option value="">Andhra Pradesh</option>
                                                <option value="">Arunachal Pradesh</option>
                                                <option value="">Assam</option>
                                                <option value="">Bihar</option>
                                                <option value="">Chhattisgarh</option>
                                                <option value="">Delhi</option>
                                                <option value="">Firozabad</option>
                                                <option value="">Goa</option>
                                                <option value="">Gujarat</option> 
                                                <option value="">Haryana</option> 
                                                <option value="">Himachal Pradesh</option>
                                                <option value="">Jharkhand</option>
                                                <option value="">Karnataka </option>
                                                <option value="">Kerala</option>
                                                <option value="">Madhya Pradesh </option>
                                                <option value="">Maharashtra</option>
                                                <option value="">Mizoram</option> 
                                                <option value="">Nagaland</option>
                                                <option value="">Odisha</option>
                                                <option value="">Punjab</option> 
                                                <option value="">Rajasthan</option> 
                                                <option value="">Sikkim</option>
                                                <option value="">Tamil Nadu </option>
                                                <option value="">Telangana</option> 
                                                <option value="">Tripura</option> 
                                                <option value="">Uttar Pradesh</option>
                                                <option value="">Uttarakhand </option>
                                                <option value="">West Bengal</option>
                                                </select>
                                              </div>


                                              <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">City</label>
                                                <select multiple="multiple" name="pr_city_id[]" id="pr_city_id" class="form-control"  >
                                                <option value="">Please Select</option>
                                                <option value="">Chandigarh </option>
                                                <option value="">Mumbai </option>
                                                <option value="">Assam</option>
                                                <option value="">Agartala</option>
                                                <option value="">Aizawl</option>
                                                <option value="">Dehradun</option>
                                                <option value="">Gangtok</option>
                                                <option value="">Hyderavad</option>
                                                <option value="">Imphal</option>
                                                <option value="">Kolkata</option>
                                                <option value="">Delhi</option>
                                                <option value="">Bhubaneswar</option> 
                                                <option value="">Ahemdadad</option> 
                                                <option value="">Kohima</option>
                                                <option value="">Jaipur</option>
                                                <option value="">Lucknow </option>
                                                <option value="">Indore</option>
                                                <option value="">Nagpur </option>
                                                <option value="">Shillong </option>
                                                <option value="">Mizoram</option> 
                                                <option value="">Patna</option>
                                                <option value="">Varanasi</option>
                                                <option value=""></option>     
                                                </select>
                                              </div> -->

                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (phone number)-->
                                                  <div class="col-md-6">
                                                    <label class="small mb-1" id="gender" name="gender" for="gender" >Gender</label>  
                                               <select class="form-control" name="gender" value="<?php echo $userlist[
                                                   "gender"
                                               ]; ?>" >
                                                  <option name="gender" id="gender" value="Male" >Male</option>
                                                    <option  name="gender" id="gender" name="gender" value="Female">Female</option>
                                                     </select>    
                                                  </div>

                                                <!-- Form Group (birthday)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputBirthday">D.O.B</label>
                                                    <input class="form-control" id="inputBirthday" type="date" name="date_of_birth" placeholder="Enter your birthday" value="<?php echo $userlist[
                                                        "date_of_birth"
                                                    ]; ?>">
                                                </div>
                                            </div>
                                            <!-- Save changes button-->
                                                         <div class="form-group mb-3">
                                                        <button type="submit"  class="btn btn-primary">Update</button>
                                                        <a href="<?php echo site_url(
                                                        "kurio/dashboard"
                                                        ); ?>" class="btn btn-danger">Cancel</a>
                                                           </div>                  
                                                             </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>  
                                      </div>
                                  </div>
                                </main> 
                            </div>
                        </div>
                    </div>
                </main>            
            </div>
        </div>   
    </body>

 <script>        
function phoneno(){          
$('#mobile').keypress(function(e) {
var a = [];
var k = e.which;
for (i = 48; i < 58; i++)
a.push(i);

if (!(a.indexOf(k)>=0))
e.preventDefault();
});
}
</script>

<script>
$("#image").change(function()
{

    var Data = document.getElementById('image');
    var FileUploadPath = Data.value;

    if (FileUploadPath != '') {
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        //The file uploaded is an image

        if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                            || Extension == "jpeg" || Extension == "jpg"){
            return true;
        }else if (Extension != 'gif' || Extension != 'png' || Extension != 'bmp' || Extension != 'jpeg' || Extension != 'jpg') {

            alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
          Data.type = '';
          Data.type = 'file';
            return false;
        }
    }
});

image.onchange = evt =>{
  const [file] = image.files
  if (file){
    blah.src = URL.createObjectURL(file);
  }
}

function removeImage(closeButton){

    // Find the parent image container
    var imageContainer = closeButton.parentNode;
  

    // Remove the image container from the DOM
    imageContainer.remove();


}


</script> 


  



