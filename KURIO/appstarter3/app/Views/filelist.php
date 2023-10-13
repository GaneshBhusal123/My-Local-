
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
                                <table class="table table-bordered mt-3">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Files</th> 
                      </tr>
                  </thead>
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
                             <img src='<?php echo $img; ?>'height="100px" width="100px"/>
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

