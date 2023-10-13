<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
                     
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Password</h3></div>

                                    <div class="card-body">
                                        <form action="<?php echo site_url('UpdatePassword/change_password'); ?>" method="post" >
                                          <input type="hidden" name="email" value="<?php echo $email; ?>">
                                          <?php if(session()->getFlashdata('msg')):?>
                                <div class="alert alert-success">
                                 <?= session()->getFlashdata('msg') ?>
                                 </div>
                                <?php endif;?>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>

                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="ConfirmPassword" />
                                                <label for="inputPassword">ConfirmPassword</label>
                                            </div>


                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                 <button type="submit" class="btn btn-primary">Update</button>
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
