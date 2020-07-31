
<?php

$action                   = "teacher/save";
$teacher_uuid             = "";
$teacher_name             = "";
$teacher_gender           = "";
$teacher_brithplace       = "";
$teacher_brithdate        = "";
$teacher_address          = "";
$teacher_nohp             = "";
$teacher_email            = "";
$teacher_last_education   = "";
$teacher_majors           = "";
$teacher_universitas      = "";
$teacher_graduation_year  = "";
$teacher_institution_name     = "";
$teacher_longtime_teaching    = "";


if ($page == "Edit") 
{
  $action                   = "teacher/update";
  $teacher_uuid             = $row['teacher_uuid'];
  $teacher_name             = $row['teacher_name'];
  $teacher_gender           = $row['teacher_gender'];
  $teacher_brithplace       = $row['teacher_brithplace'];
  $teacher_brithdate        = $row['teacher_brithdate'];
  $teacher_address          = $row['teacher_address'];
  $teacher_nohp             = $row['teacher_nohp'];
  $teacher_email            = $row['teacher_email'];
  $teacher_last_education   = $row['teacher_last_education'];
  $teacher_majors           = $row['teacher_majors'];
  $teacher_universitas      = $row['teacher_universitas'];
  $teacher_graduation_year  = $row['teacher_graduation_year'];
  $teacher_institution_name     = $row['teacher_institution_name'];
  $teacher_longtime_teaching    = $row['teacher_longtime_teaching'];
}
?>

<!-- Datepicker -->
<link href="<?=base_url('assets/vendor/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');?>" rel="stylesheet">
<link href="<?=base_url('assets/vendor/plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css');?>" rel="stylesheet">

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Teacher
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="teacher_uuid" value="<?=$teacher_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Lengkap</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_name" class="form-control" value="<?=$teacher_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-9">
                            <select name="teacher_gender" id="teacher_gender" class="form-control">
                                <option value="M" <?= ($teacher_gender == "M") ? "selected" : "" ?> >Pria</option>
                                <option value="F" <?= ($teacher_gender == "F") ? "selected" : "" ?> >Wanita</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tempat lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_brithplace" class="form-control" value="<?=$teacher_brithplace;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal Lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_brithdate" class="form-control floating-label" id="date" value="<?=$teacher_brithdate;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="teacher_address" class="form-control" cols="10" rows="5" required=""><?=$teacher_address;?></textarea>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Hp</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_nohp" class="form-control" value="<?=$teacher_nohp;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_email" class="form-control" value="<?=$teacher_email;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pendidikan Terakhir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_last_education" class="form-control" value="<?=$teacher_last_education;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jurusan</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_majors" class="form-control" value="<?=$teacher_majors;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Universitas/lembaga</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_universitas" class="form-control" value="<?=$teacher_universitas;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tahun Lulus</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_graduation_year" class="form-control" value="<?=$teacher_graduation_year;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Lembaga Terakhir Mengajar</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_institution_name" class="form-control" value="<?=$teacher_institution_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Lama Mengajar</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="teacher_longtime_teaching" class="form-control" value="<?=$teacher_longtime_teaching;?>" required=""></div>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                </div>
              </form>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div>


<!-- Datepicker -->
<script src="<?=base_url('assets/vendor/plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js');?>"></script>
<script src="<?=base_url('assets/vendor/plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js');?>"></script>
<script src="<?=base_url('assets/vendor/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');?>"></script>

<!-- Plugins Init js -->
<script src="<?=base_url('assets/vendor/app/assets/pages/form-advanced.js');?>"></script>
