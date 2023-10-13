
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
                             
                            <a class="nav-link" href="<?php echo site_url('crud/index'); ?>">
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
                        <h1 class="mt-4">Userlist</h1>
                            <div class="card-body">
                            <!--table of the Userlist-->
                                <table id="datatablesSimple">
                                    <?php if (
                                        session()->getFlashdata("msg")
                                            ): ?>
                                        <div class="alert alert-success">
                                        <?= session()->getFlashdata("msg") ?>
                                        </div>
                                        <?php endif; ?>
                                  <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Address</th>      
                                            <th>Mobile</th>
                                            <th>Profiles</th>
                                            <th>Gender</th>
                                            <th>D.O.B</th>
                                            <th>Created_at</th>
                                            <th>Action</th>     
                                        </tr>
                                    </thead>
                        <tbody>
                                <?php if ($userlist):
                                $i = 1; ?>
                                <?php foreach ($userlist as $user): ?>   
                                <?php $img = site_url() . "Public/Uploads/" . $user["image"]; ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user["firstname"]; ?></td>
                                <td><?php echo $user["lastname"]; ?></td>
                                <td><?php echo $user["email"]; ?></td>
                                <td><?php echo $user["address"]; ?></td>
                                <td><?php echo $user["mobile"]; ?></td>
                                    <td>
                                    <?php if ($user["image"]) { ?>
                                    <img src='<?php echo $img; ?>'height="70px" width="70px"/>
                                     <?php } else { ?>
                                    <?php } ?>
                                    </td>

                                    <td><?php echo $user["gender"]; ?></td>
                                    <td><?php echo $user["date_of_birth"]; ?></td>
                                        <td><?php
                                        $timestamp = new Datetime($user["created_at"]);
                                        $date = $user["created_at"];
                                        echo date("h:i:s A  d-m-Y", strtotime($date));
                                        ?>
                                        </td>
                                     <td> 
                                        <button type="button" onclick="delete_record(<?php echo $user[
                                                                         "id"
                                                ]; ?>)" class="btn btn-danger" >Delete
                                        </button>
                                      </td>          
                                    </tr>
                                    <?php $i++;endforeach; ?>
                                    <?php
                                endif; ?>       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>            
            </div>
        </div>   
    </body>
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
 ></script>
<script type="text/javascript">       
    function delete_record(id){ 
            if(confirm('Are you want  to sure to  delete')){        
            $.ajax({
            url:"<?php echo site_url("kurio/delete"); ?>",
            type: "GET",  
            data: {id: id},
             success:function(res){ 
            if(res==true)
                {
                    location.reload(true);

                }  
            }
        });
     }
}
</script>
