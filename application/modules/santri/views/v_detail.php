

<?php
$modified_date = $data['modified_date'];
if ($modified_date != NULL) {
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

        <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Santri
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class="form-control-label font-bold">No Induk</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['no_induk'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">NISN</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nisn'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Nama Lengkap</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nama'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['jk']=="M") ? "Pria" : "Wanita";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tempat, Tgl Lahir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tempat_lahir'].", ".date("M d, Y", strtotime($data['tgl_lahir']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Agama</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['agama'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Status dlm Keluarga</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['status'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Anak ke </label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['anak_ke'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Alamat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['alamat'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Asal Sekolah</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['asal_sekolah'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">diterima dikelas</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['diterima_dikelas'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Tanggal diterima</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("M d, Y", strtotime($data['tgl_terima']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Nama Ayah</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ayah'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Pekerjaan Ayah</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ayah_pekerjaan'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Nama Ibu</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ibu'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Pekerjaan Ibu</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['ibu_pekerjaan'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Nama Wali</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['wali'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label font-bold">Pekerjaan Wali</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['wali_pekerjaan'];?></p>
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