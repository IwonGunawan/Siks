
<?php
$diubah_tgl = $data['diubah_tgl'];
if ($diubah_tgl != NULL) {
  $diubah_tgl = date("d-m-Y H:i:s", strtotime($data['diubah_tgl']));
}
else {
  $diubah_tgl = "-";
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
                  <strong><?=$page;?></strong> Guru
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">NIP</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nip'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Nama Lengkap</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nama'];?></p>
                          </div>
                        </div>


                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['jk']=="M") ? "Pria" : "Wanita";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Tempat, Tgl Lahir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tempat_lahir'].", ".date("d-m-Y", strtotime($data['tgl_lahir']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['alamat'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Email</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['email'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">No Hp</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nohp'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Pendidikan Terakhir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['pendidikan_terakhir'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Bidang Ajar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static">
                            <?php
                              $bidang_ajar = json_decode($data['bidang_ajar']);
                              if (count($bidang_ajar) > 0) 
                              {
                                echo "<ul>";
                                foreach ($bidang_ajar as $row) 
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
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("d-m-Y H:i:s", strtotime($data['dibuat_tgl']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class="font-bold form-control-label">Tanggal diubah </label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$diubah_tgl; ?></p>
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