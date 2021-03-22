
<!-- DataTables -->
<link href="<?=base_url('assets/vendor/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/vendor/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?> " rel="stylesheet" type="text/css" />

<!-- start page title -->
<div class="row justify-content-md-center">
  <div class="col-10">
    <div class="page-title-box d-flex align-userss-center justify-content-between">
        <h4 class="page-title mb-0 font-size-18"><i class="bx bx-user"></i>&nbsp; USERS</h4>
    </div>
  </div>
</div>
<!-- end page title -->

<div class="row justify-content-md-center">
    <div class="col-10">
        <div class="card">
            <div class="card-body">

                <p class="card-title-desc">
                  <?php 
                    if($this->session->flashdata('msg')) 
                    { 
                      echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata("msg").'</div>';
                    }

                    if($this->session->flashdata('danger')) 
                    { 
                      echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata("danger").'</div>';
                    } 
                  ?>

                      <a href="<?=base_url('users/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New</a>
                </p>

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tgl dibuat</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                </table>
                <nav style="float: right;">
                    <!-- pagination -->
                </nav>

            </div>
        </div>
    </div>
    <!-- end col -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <form method="POST" action="<?=base_url('users/reset_pass'); ?>">
              <input type="hidden" name="users_uuid" id="users_uuid">
              <button type="submit" class="btn btn-danger">Reset Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>


</div>




    <script type="text/javascript">
    
      var table;
      $(document).ready(function() 
      {
        //datatables
        table = $('#datatable').DataTable({ 
     
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('users/ajax_list'); ?>",
              "type": "POST"
          },

          //Set column definition initialisation properties.
          "columnDefs": [
          { 
              "targets": [], //first column / numbering column
              "orderable": false, //set not orderable
          },
          ],
        });

        // show dialog reset password
        $('.bd-example-modal-sm').on('show.bs.modal', function (event) 
        {
          var button        = $(event.relatedTarget) 
          var users_uuid    = button.data('uuid')
          var users_name    = button.data('name');


          var modal = $(this)
          modal.find('#users_uuid').val(users_uuid)
          modal.find('.modal-title').text("Nama : " + users_name)
        })
      });

    </script>


    <!-- Required datatable js -->
    <script src="<?=base_url('assets/vendor/assets/libs/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>

    <!-- Responsive examples -->
    <script src="<?=base_url('assets/vendor/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');?>"></script>