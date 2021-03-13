
<?php
$modified_date = $data['modified_date'];
if ($modified_date != NULL) {
  $modified_date = date("d-m-Y H:i:s", strtotime($data['modified_date']));
}
else {
  $modified_date = "-";
}
?>

<style type="text/css">
  .form-group {
    margin-bottom: unset !important;
  }

  .font-bold {
    font-weight: bold;
  }
</style>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong>
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">NIK</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ustadz_nik'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Nama Lengkap</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ustadz_nama'];?></p>
                          </div>
                        </div>


                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['ustadz_jk']=="M") ? "Laki-laki" : "Perempuan";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ustadz_alamat'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Bidang Ajar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static">
                            <?php
                              $bidang_ajar_id = json_decode($data['bidang_ajar_id']);
                              if (count($bidang_ajar_id) > 0) 
                              {
                                echo "<ul>";
                                foreach ($bidang_ajar_id as $row) 
                                {
                                  echo "<li>".judul($row)."</li>";
                                }
                                echo "</ul>";
                              }
                            ?>
                          </p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Tanggal dibuat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("M d, Y H:i", strtotime($data['created_date']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Tanggal diubah </label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$modified_date; ?></p>
                          </div>
                        </div>
                    </div>

                    
                  </div>

                      
                </div>
                <div class="card-footer">
                  <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                      <i class="fa fa-ban"></i> Back
                  </button>
                </div>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->