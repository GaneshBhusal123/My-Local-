<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
                    <form method="post" action="<?php echo base_url('kurio/update_modal');?>" enctype="multipart/form-data">
                      
                      <input type="hidden" name='id' id="id" value=""  class=" form-control">

                      <div class="form-group mt-3">
                         <input type="file"  name='image' id="image"  class=" form-control">
                        
                          <div >
                        <img id="my_image" height="100" width="100"/>
                        </div>
                        </div>

                        <div class="form-group mt-3">
                         <input type="text" name='title' placeholder="Enter your title" id="title"  class=" form-control">
                        </div>

                           <div class="form-group mt-3">
                         <textarea class="form-control" name="description"placeholder="Enter your Description"  id="description"></textarea>
                        </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary">Update
                                </button>
                              
                                </div>  
                                </form>  
                                

         <!--  <div id="my_text">
            </div>
                <div id="my_description">
                  </div>
                    <div id="my_imagename">
                        </div>
                        <div >
                        <img id="my_image"   />
                        </div>  -->
                     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
</body>
</html>



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
                        <h1 class="mt-4">Files</h1>
                            <div class="card-body">
                              <form method="post" action="<?php echo base_url('kurio/uploadfile');?>" enctype="multipart/form-data">

                                        <!-- Show Messages like  uploaded, File is Required and  Deleted   -->

                                        <?php if (
                                        session()->getFlashdata("msg")=="Uploaded"
                                            ): ?>
                                        <div class="alert alert-success">
                                          uploaded
                                        </div>
                                        <?php endif; ?>

                                        <?php if (
                                        session()->getFlashdata("msg")=="File is Required or Invalid"
                                            ): ?>
                                        <div class="alert alert-danger">
                                          File is Required or Invalid
                                        </div>
                                        <?php endif; ?>

                                         <?php if (
                                        session()->getFlashdata("msg")=="Deleted Successfully"
                                            ): ?>
                                        <div class="alert alert-danger">
                                         Record Deleted Successfully
                                        </div>
                                        <?php endif; ?>

                                        <?php if (
                                        session()->getFlashdata("msg")=="Data updated successfully"
                                            ): ?>
                                        <div class="alert alert-success">
                                         Data updated successfully
                                        </div>
                                        <?php endif; ?>

                                        <!-- end of Messages -->

                        <div class="form-group mt-3">
                         <input type="file" name='image[]' id="image" multiple="" class=" form-control">
                        </div>
                        <div class="form-group mt-3">

                         <div class="form-group mt-3">
                         <input type="text" placeholder="Enter your title" name='title' id="title" class=" form-control">
                        </div>
                        <div class="form-group mt-3"> 

                        <div class="form-group mt-3">
                         <textarea class="form-control" name="description"placeholder="Enter your Description" id="description"></textarea>
                        </div>
                        <div class="form-group mt-3">    
        
                          <button type="submit" name="submit" id="button" class="btn btn-primary" >Submit</button>
                        </div>
                      </form>
                      <div class="container-fluid px-4">
                        <h1 class="mt-4">Fileslist</h1>
                            <div class="card-body">

                      <!-- Listed Records of the filelist -->
                      <table id="datatablesSimple">
                    <thead>
                          <tr>
                            <th>S.N</th>
                            <th>Files</th>
                            <th>FileName</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>View</th>
                            <th>Actions</th>
                          </tr>
                           <tbody> 
                              <?php if ($userslist):
                                $i = 1; ?>
                                <?php foreach ($userslist as $user): ?>   
                                <?php $img = site_url() . "Public/Multiple_Uploads/" . $user["image"]; ?>
                              <tr>

                                  <td>
                                   <?php echo $i; ?> 
                                  </td>
                                  <td>
                                   <img src='<?php echo $img; ?>'height="100px" width="100px" id="pop"/>
                                 </td>
                                 <td><?php echo $user["image"]; ?></td>
                                 <td><?php echo $user["title"]; ?></td>
                                  <td><?php echo $user["description"]; ?></td>
                                  <td>
                                   <button type="button" id="savebutton" class="btn btn-primary" data-toggle="modal" data-textname="title" data-target="#exampleModal" onclick='getid("<?php echo $user["title"]; ?>","<?php echo $user["description"]; ?>","<?php echo $img; ?> "," <?php echo $user['id']; ?> ")' >View   
                                    </button>

                                <td>
                                    <a href="<?php echo base_url('kurio/edit_file/' .$user['id']);?>" class="btn btn-primary ">Edit
                                    </a>  
                                      <a href="<?php echo base_url('kurio/remove_file/'.$user['id']); ?>" class="btn btn-danger">Delete
                                      </a>
                                </td> 
                            </tr> 

                                <?php $i++;endforeach; ?>
                                  <?php
                                endif; ?>
                                 </tbody>     
                              </table> 
                              <!-- End of Table Listing. -->

                                </div>
                              </div>
                            </div>
                          </thead>
                      </div>
                    </div>
                  </main>            
              </div>
          </div>   
      </body>
      <!-- Ajax for Delete a record on dashboard user details. -->
    <script type="text/javascript">       
    function delete_record($id){   
    if(confirm('Are you want  to sure to  delete')){        
      $.ajax({
        url:"<?php echo site_url("kurio/remove_file"); ?>",    //the 
        type: "GET",  
        data: {id: id},
        success:function(result){ 
        if(result==true)
        {
           location.reload(true);
        }  
        }
      });
     }
    }
    </script>
<!-- end of Ajax. -->


<script type="text/javascript">
  
function getid(x,y,z,a){
 
 //  $("#my_text").html(a);
 //  $("#my_description").html(b);
  
 // $("#my_image").attr("src",c);
 // $("#my_imagename").html(d);
$("#title").val(x);
$("#description").val(y);
$("#my_image").attr("src",z);
$("#id").val(a);




}

</script>





