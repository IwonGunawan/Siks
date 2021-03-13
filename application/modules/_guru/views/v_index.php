
<!-- DataTables -->
<link href="<?=base_url('assets/vendor/plugins/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/vendor/plugins/datatables/buttons.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/vendor/plugins/datatables/responsive.bootstrap4.min.css');?>" rel="stylesheet" type="text/css" />

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
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

              <div class="card-header">
                  <a href="<?=base_url('guru/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New</a>
              </div>
              <div class="card-body">
                  <table id="datatable" class="table table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>JK</th>
                            <th>Email</th>
                            <th>Pendidikan Terakhir</th>
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


    </div>
  </div><!-- .animated -->
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
          "url": "<?php echo site_url('guru/ajax_list'); ?>",
          "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [ 6 ], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ],

    });
  });
</script>


<!-- datatable js -->
<script src="<?=base_url('assets/vendor/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('assets/vendor/plugins/datatables/dataTables.bootstrap4.min.js');?>"></script>