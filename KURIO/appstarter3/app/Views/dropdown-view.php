
<body class="sb-nav-fixed">   
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo site_url(
                                "kurio/dashboard"
                            ); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?php echo site_url(
                                "kurio/file"
                            ); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Files
                            </a>
                             <a class="nav-link" href="<?php echo site_url(
                                 "kurio/dropdown"
                             ); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profile Page Add Address 
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
                                                   <h1 class="mt-4">Country, State, And City Populate using Ajax call. </h1>
                                                </div>
                                                <div class="card-body">
                                                    <div class="container-xl px-4 mt-4">
                                                       <?php if (
                                        session()->getFlashdata("msg")=="File is Required "
                                            ): ?>
                                        <div class="alert alert-danger">
                                        File is Required
                                        </div>
                                        <?php endif; ?>

                                         <?php if (
                                        session()->getFlashdata("msg")==" Inserted Successfully"
                                            ): ?>
                                        <div class="alert alert-success">
                                           Inserted Successfully
                                        </div>
                                        <?php endif; ?>


                                        <?php if (
                                        session()->getFlashdata("error")==" Record not Found"
                                            ): ?>
                                        <div class="alert alert-danger">
                                           Record not Found
                                        </div>
                                        <?php endif; ?>
                                     
                        <!-- Account page navigation-->
                        <nav class="nav nav-borders">
                            <a class="nav-link active ms-0" href="<?php echo site_url(
                                "kurio/profile"
                            ); ?>">Profile</a>  
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
                                           "kurio/upload_dropdown"
                                       ); ?>" method="post"  enctype="multipart/form-data" runat="server" >

                                      <div class="mb-3">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                       class="rounded-circle img-fluid" style="width: 150px;"/> 
                                      
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">JPG,PNG,JPEG,GIF,BMP Image is only allowed</div>
                                        <!-- Preview an image before it is uploaded-->    
                                        <input type="file"accept="jpeg/png/bmp/gif/jpg" id="image" name="image"class=" form-control" value="">
                                      </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-xl-8">
                                    <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">    
                                            <div class="row gx-3 mb-3">
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                  <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLocation">Address</label>
                                                    <textarea class="form-control" name="address"placeholder="Enter your Address" id="address"></textarea>
                                                </div> 
                                                 <div class="col-md-6">
                                                    <label class="small mb-1" id="countries" name="countries" for="countries" >Countries</label>  
                                               <select class="form-control" name="countries"id="country_id" onchange="fetchStateData()"  >
                                                 <option value="">Please Select Countries</option>
                                                 <?php foreach(
                                                     $countries
                                                     as $country
                                                 ) { ?>
                                                 <option value="<?php echo  $country->id; ?>"><?php echo  $country->name; ?></option>
                                                    <?php } ?>
                                                     </select>    
                                                  </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                              
                                                   <div class="col-md-6">
                                                    <label class="small mb-1"  name="states" for="states" >States</label>  
                                                <select class="form-control" name="states" id="state_id"onchange="fetchCityData(this)">
                                                <option value="">Please Select States</option>
                                                     </select>    
                                                  </div>

                                                 <div class="col-md-6">
                                                    <label class="small mb-1"  name="cities" for="cities" >Cities</label>  
                                                  <select class="form-control" name="cities" id="city_id" >
                                                      <option value="">Please Select Cities</option>
                                                     </select>    
                                                  </div>
                                            </div>
                                                     <div class="row gx-3 mb-3">
                                                  <div class="col-md-6">
                                                    <label class="small mb-1" for="pincode">Pincode</label>
                                                    <input class="form-control" id="pincode" name="pincode"type="text" placeholder="Enter your Pincode" >
                                                </div>
                                              </div>

                                            <!-- Save changes button-->
                                                     <div class="form-group mb-3">
                                                      <button type="submit"  class="btn btn-primary">Create</button>
                                                     <a href="<?php echo site_url(
                                                         "kurio/dashboard"
                                                     ); ?>" class="btn btn-danger">Cancel</a>
                                                           </div>---> 
                                                            <a href="<?php echo site_url(
                                                         "kurio/userlist"
                                                     ); ?>" class="btn btn-success">Tablelist</a>
                                                           <!-- end of button -->
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
      </div>   
    </body>
 
   <script>
    function fetchStateData(country_id){
     var country_id= $("#country_id ").val();
     
     if(country_id){
      $.ajax({
        url:"<?php echo site_url("kurio/state"); ?>", 
        type: "POST",
        data:{cId: country_id},
        success:function(result){
           $("#state_id").html(result);
            $('#city_id').html('<option value="">Select state first</option>'); 
          } 
      });
    }else{
            $('#state_id').html('<option value="">Select country first</option>');
            $('#city_id').html('<option value="">Select state first</option>');
        }

    };
    
       function fetchCityData(state_id){
         var state_id= $("#state_id option:selected").val();
          if(state_id){
          $.ajax({
          url:"<?php echo site_url("kurio/cities"); ?>", 
          type: "POST",
           data:{sId: state_id},
           success:function(result){

           $("#city_id").html(result);
              } 

            });
        }else{
          $('#city_id').html('<option value="">Select state first</option>'); 

        }
    };
   </script> 
