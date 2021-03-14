

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
                  <strong><?=$page;?></strong> Pelanggaran
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class="form-control-label font-bold">Nama Santri</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_nama'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">No Induk</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['no_induk'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Kelas</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['kelas'];?></p>
                          </div>
                        </div>


                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Peristiwa</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['peristiwa'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Kronologi</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['kronologi'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Motif Melanggar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['motif_melanggar'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Solusi</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['solusi'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tanggal dibuat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("d-m-Y H:i:s", strtotime($data['dibuat_tgl']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tanggal diubah </label></div>
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