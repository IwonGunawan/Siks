<!DOCTYPE html>
<html lang="en">

  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <title><?=$page." - SIKS";?></title>
      <meta content="SIKS is a application for manage activity santri among other tahfiz and punishment" name="description" />
      <meta content="yayi" name="author" />
      <link rel="shortcut icon" href="<?=base_url('assets/img/logo-s.png');?>">

      <link rel="stylesheet" href="<?=base_url('assets/vendor/plugins/morris/morris.css');?>">

      <link href="<?=base_url('assets/vendor/app/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
      <link href="<?=base_url('assets/vendor/app/assets/css/metismenu.min.css');?>" rel="stylesheet" type="text/css">
      <link href="<?=base_url('assets/vendor/app/assets/css/icons.css');?>" rel="stylesheet" type="text/css">
      <link href="<?=base_url('assets/vendor/app/assets/css/style.css');?>" rel="stylesheet" type="text/css">
      <link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet" type="text/css">
      
      <!-- Jquery -->
      <script src="<?=base_url('assets/vendor/app/assets/js/jquery.min.js');?>"></script>

  </head>

  <body>

      <!-- Begin page -->
      <div id="wrapper">

          <!-- Top Bar Start -->
          <?php $this->load->view('app_topbar'); ?>
          <!-- Top Bar End -->

          <!-- ========== Left Sidebar Start ========== -->
          <?php $this->load->view("app_sidebar"); ?>
          <!-- Left Sidebar End -->

          <!-- ============================================================== -->
          <!-- Start right Content here -->
          <!-- ============================================================== -->
          <div class="content-page">
              <!-- Start content -->
              <div class="content" style="margin-top: 100px">
                  <div class="container-fluid">

                      <?php //$this->load->view("app_breadcrumbs"); ?> 

                      <?php $this->load->view($content);?>

                  </div> <!-- container-fluid -->

              </div> <!-- content -->

              <footer class="footer">
                  © 2020 SIKS <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Yayi.</span>
              </footer>

          </div>


          <!-- ============================================================== -->
          <!-- End Right content here -->
          <!-- ============================================================== -->


      </div>
      <!-- END wrapper -->
          

      <!-- jQuery  -->
      <script src="<?=base_url('assets/vendor/app/assets/js/bootstrap.bundle.min.js');?>"></script>
      <script src="<?=base_url('assets/vendor/app/assets/js/metisMenu.min.js');?>"></script>
      <script src="<?=base_url('assets/vendor/app/assets/js/jquery.slimscroll.js');?>"></script>
      <script src="<?=base_url('assets/vendor/app/assets/js/waves.min.js');?>"></script>
      <script src="<?=base_url('assets/vendor/plugins/jquery-sparkline/jquery.sparkline.min.js');?>"></script>


      <!-- Peity JS -->
      <script src="<?=base_url('assets/vendor/plugins/peity/jquery.peity.min.js');?>"></script>

      <script src="<?=base_url('assets/vendor/plugins/morris/morris.min.js');?>"></script>
      <script src="<?=base_url('assets/vendor/plugins/raphael/raphael-min.js');?>"></script>

      <!-- <script src="<?=base_url('assets/vendor/app/assets/pages/dashboard.js');?>"></script> -->

      <!-- App js -->
      <script src="<?=base_url('assets/vendor/app/assets/js/app.js');?>"></script>

  </body>

</html>