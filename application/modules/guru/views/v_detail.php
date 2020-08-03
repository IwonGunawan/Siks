
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
                  <strong><?=$page;?></strong> Teacher
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Nama Lengkap</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=($data['teacher_gender']=="M") ? "Pria" : "Wanita";?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Tempat, Tgl Lahir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_brithplace'].", ".date("d-m-Y", strtotime($data['teacher_brithdate']));?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_address'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">No Hp</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_nohp'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Email</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_name'];?></p>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Pendidikan Terakhir</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_last_education'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Jurusan</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_majors'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Universitas</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_universitas'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Tahun Lulus</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_graduation_year'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Lemga Terakhir Mengajar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_institution_name'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3"><label class=" form-control-label">Lama Mengajar</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['teacher_longtime_teaching'];?></p>
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