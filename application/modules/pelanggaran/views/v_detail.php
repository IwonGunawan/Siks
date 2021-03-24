

<?php
$modified_date = $data['modified_date'];
if ($modified_date != NULL) 
{
  $modified_date = date("M d, Y H:i", strtotime($data['modified_date']));
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

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Pelanggaran
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class="form-control-label font-bold">Nama Santri</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nama'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Kelas</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['kelas'];?></p>
                          </div>
                        </div>


                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Peristiwa</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['jp_judul'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Kronologi</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['pelanggaran_kronologi'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Motif Melanggar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['pelanggaran_motif'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Solusi</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['pelanggaran_solusi'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tanggal dibuat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("M d, Y H:i", strtotime($data['created_date']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tanggal diubah </label></div>
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