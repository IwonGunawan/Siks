

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
                  <strong><?=$page;?></strong> Tahfidz
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
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tipe Setoran</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['tipe_setoran']=="0") ? "Hafalan" : "Murojaah";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Juz</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['juz'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Surat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['surat'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Ayat Awal</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ayat_awal'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Ayat Akhir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ayat_akhir'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Catatan</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['catatan'];?></p>
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