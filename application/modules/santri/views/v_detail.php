
<?php
$modified_date = $data['modified_date'];
if ($modified_date != NULL) {
  $modified_date = date("d-m-Y H:i:s", strtotime($data['modified_date']));
}
else {
  $modified_date = "-";
}


?>



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
                          <div class="col col-md-3"><label class=" form-control-label">Nama Depan</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_first_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Nama Belakang</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_last_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['santri_gender']=="M") ? "Pria" : "Wanita";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Tempat, Tgl Lahir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_birthplace'].", ".date("d-m-Y", strtotime($data['santri_birthdate']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_address'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">No Hp</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_nohp'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Nama Ayah</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_father_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Pekerjaan Ayah</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_father_job'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Nama Ibu</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_mother_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Pekerjaan Ibu</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['santri_mother_job'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Tanggal dibuat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("d-m-Y H:i:s", strtotime($data['created_date']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Tanggal diubah </label></div>
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