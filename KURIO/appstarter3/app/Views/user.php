<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
            <?php if(isset($validation)):?>
                <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
                    </div>
                        <?php endif;?>                                                
        <link href="<?php echo site_url('asset/css/styles.css'); ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">User Login</h3></div>
                                  
                                    <div class="card-body">
                                        <form id="form" action="<?php echo site_url('UserController/loginAuth'); ?>" method="post" >

                                             <?php if(session()->getFlashdata('msg')):?>
                                        <div class="alert alert-success">
                                        <?= session()->getFlashdata('msg') ?>
                                        </div>
                                        <?php endif;?>
                                        
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  name="email"id="email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                 <button type="submit" id="button"class="btn btn-primary">Login</button>
                                                   <label>
                                    <input type="checkbox" name="remember_me" checked >
                                        Remember me 
                                        </label>
                                             <a href="<?php echo site_url('kurio/forget_password'); ?>" >Forget Password?</a>
                                                 <a  href="<?php echo site_url('kurio/signup'); ?>" class="btn btn-info">Signup</a>        
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo site_url('asset/js/scripts.js');?>"></script>
    </body>
</html>
<script>
 const email=document.querySelector("#email");
 const button=document.querySelector("#button");
  button.disabled=true;
  email.addEventListener("keyup",()=>{
    if(email.value.length > 0){
      button.disabled=false;

    }else{
      button.disabled=true;
    }
  })
</script>