<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>SIKS - Sistem Informasi Kontrol Santri</title>
        <meta content="SIKS is a application for manage activity santri among other tahfiz and punishment" name="description" />
        <meta content="yayi" name="author" />
        <link rel="shortcut icon" href="<?=base_url('assets/img/logo-sm.png');?>">

        <link href="<?=base_url('assets/vendor/app/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?=base_url('assets/vendor/app/assets/css/metismenu.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?=base_url('assets/vendor/app/assets/css/icons.css');?>" rel="stylesheet" type="text/css">
        <link href="<?=base_url('assets/vendor/app/assets/css/style.css');?>" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h6 class="text-center m-0">
                      <?php
                        if($this->session->flashdata('msg')) 
                        {
                          echo "<div class='alert alert-success' role='alert'>".$this->session->flashdata("msg")."</div>";
                        }
                        else if ($this->session->flashdata("error")) 
                        {
                          echo "<div class='alert alert-danger' role='alert'>".$this->session->flashdata("error")."</div>";
                        }
                      ?>
                        <!-- <a href="index.html" class="logo logo-admin"><img src="<?=base_url('assets/vendor/app/assets/images/logo.png');?>" height="30" alt="logo"></a> -->
                    </h6>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to SIKS.</p>

                        <form class="form-horizontal m-t-30" action="<?=base_url('login/process');?>" method="POST">

                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="text" class="form-control" id="users_email" name="users_email" placeholder="Enter Email">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="users_password" name="users_password" placeholder="Enter password">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <!-- <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div> -->
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-white-50">Don't have an account ? <a href="pages-register.html" class="text-white"> Signup Now </a> </p>
                
            </div>

        </div>

        <!-- END wrapper -->
            

        <!-- jQuery  -->
        <script src="<?=base_url('assets/vendor/app/assets/js/jquery.min.js');?>"></script>
        <script src="<?=base_url('assets/vendor/app/assets/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?=base_url('assets/vendor/app/assets/js/metisMenu.min.js');?>"></script>
        <script src="<?=base_url('assets/vendor/app/assets/js/jquery.slimscroll.js');?>"></script>
        <script src="<?=base_url('assets/vendor/app/assets/js/waves.min.js');?>"></script>

        <script src="<?=base_url('assets/vendor/plugins/jquery-sparkline/jquery.sparkline.min.js');?>"></script>

        <!-- App js -->
        <script src="<?=base_url('assets/vendor/app/assets/js/app.js');?>"></script>

    </body>

</html>