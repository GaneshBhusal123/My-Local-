
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

                             <a class="nav-link" href="<?php echo site_url('kurio/modal');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Modal
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
                       <h2 class="m-0 font-weight-bold text-primary">Edit Page</h2></br>
                            <div class="card-body">
                            <form action="<?php echo site_url('kurio/update_list'); ?>" method="post"  enctype="multipart/form-data">
                              <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger">
                            <?= session()->getFlashdata('msg') ?>
                             </div>
                            <?php endif;?>  

                            <input type="hidden" name="id" id="id" value="<?php echo  $userlist["id"]; ?>">

                            <?php $img= base_url().'Public/Single_Uploads/'.$userlist['image'] ;?>

                            <div class="form-group mb-3">
                                    <input type="file" id="image" name="image" class="form-control">
                                      </div>

                                        <img class="preview" height="70px" width="70px" src="<?php echo $img ;?>" accept=".jpg ,.jpeg,.png" >
                                       
                                        
                                            <div class="form-group mb-3">
                                                      <label class="small mb-1" for="inputLocation">Address</label>
                                                      <textarea class="form-control" name="address"placeholder="Enter your Address" id="address"><?php echo $userlist['address']?></textarea>
                                                  </div>

                                                  <div class="form-group mb-3">
                                                    <label class="small mb-1" id="country_id" name="countries" for="countries" >Countries</label>  
                                                    <select class="form-control" name="countries" id="country_id" onchange="fetchStateData(this.value)"  >
                                                    <option value="">Please Select Countries</option>
                                                  <?php foreach(
                                                     $country
                                                     as $ctry
                                                 ) { ?>
                                              <option <?php echo($userlist['countries'] == $ctry->id) ?'selected': '';  ?> value="<?php echo  $ctry->id; ?>"><?php echo  $ctry->name; ?>
                                                  </option>
                                                    <?php } ?>
                                                     </select>    
                                                  </div>

                                                <div class="form-group mb-3">
                                                 <label class="small mb-1" id="states" name="states" for="states" >States
                                                 </label>  
                                                 <select class="form-control" name="states"id="state_id"  onchange="fetchCityData(this.value)">
                                                   <option value="">Please Select States
                                                   </option>
                                                   <?php foreach(
                                                     $states
                                                     as $state
                                                 ) { ?>
                                             <option <?php echo($userlist['states'] ==$state->id) ?'selected': '';  ?> value="<?php echo  $state->id; ?>"><?php echo  $state->name; ?>
                                                  </option>
                                                    <?php } ?>
                                                      </select>    
                                                    </div>
                                              <div class="form-group mb-3">
                                                 <label class="small mb-1"   for="cities" >Cities
                                                 </label>  
                                             <select class="form-control" name="cities"id="city_id" >
                                                   <option value="">Please Select Cities
                                                   </option>

                                                    <?php foreach(
                                                    $cities
                                                     as $city
                                                 ) { ?>
                                           <option <?php echo($userlist['cities'] ==$city->id) ?'selected': '';  ?> value="<?php echo  $city->id; ?>"><?php echo  $city->name; ?>
                                              </option>
                                                <?php } ?>
                                              </select>    
                                                    </div> 

                                                   <div class="form-group mb-3">
                                                    <label class="small mb-1" for="pincode">Pincode</label>
                                                    <input class="form-control" id="pincode" value="<?php echo $userlist['pincode']?>" name="pincode"type="text" placeholder="Enter your Pincode" >
                                                    </div> 

                                        <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary">Update
                                        </button>
                                      <a href="<?php echo site_url('kurio/userlist');?>" class="btn btn-danger">Cancel
                                     </a>
                                </div> 
                            </form>          
                         </div>
                        </div>
                    </div>
                </main>            
            </div>
        </div>   
    </body>
    
    <script>
    function fetchStateData(country_id){
   //var state_id= $("#state_id option:selected").val();
      if(country_id){
      $.ajax({
        url:"<?php echo site_url("kurio/state_data"); ?>", 
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
        if(state_id){
          $.ajax({
          url:"<?php echo site_url("kurio/city_data"); ?>", 
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

  function clearAttribute(){
  
   var status = confirm("Are you sure you want to remove an Image ?");  
  if(status==true)
  {
     const uploadedImage = document.getElementById('image');
     console.log(uploadedImage);
     const removeButton = document.getElementById('removeButton');

    removeButton.addEventListener('click', function() {
  // Set the source of the image to an empty string, effectively removing the image
  uploadedImage.src = '';
  // Optionally, you can also hide the image element
  uploadedImage.style.display = 'none';
});   



  }


  }

   </script> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> 
   </script>

