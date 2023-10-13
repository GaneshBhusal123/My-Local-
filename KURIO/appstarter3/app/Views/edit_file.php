
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
                       <h2 class="m-0 font-weight-bold text-primary">Edit File</h2>
                            <div class="card-body">
                            <form action="<?php echo site_url('kurio/update_file'); ?>" method="post"  enctype="multipart/form-data">
                              <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger">
                            <?= session()->getFlashdata('msg') ?>
                             </div>
                            <?php endif;?>  

                            <input type="hidden" name="id" id="id" value="<?php echo  $userlist["id"]; ?>">
                            <?php $img= base_url().'Public/Multiple_Uploads/'.$userlist['image'] ;?>

                                <div class="form-group ">
                                <input type="file" id="image" name="image"  class="form-control">
                               
                                <img class="preview"height="70px" width="70px" src="<?php echo $img ;?>" accept=".jpg ,.jpeg,.png" >
                                 <button onclick="clearAttribute()">Remove</button>  
                                </div>
                                 <div class="form-group ">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?php echo site_url('kurio/file');?>" class="btn btn-danger">Cancel</a>
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
  function clearAttribute(){
    debugger;
   let get = document.getElementById('image');
   get.removeAttribute('src', '');
}
 </script>