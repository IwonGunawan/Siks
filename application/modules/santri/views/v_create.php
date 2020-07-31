
<?php

$action               = "santri/save";
$santri_uuid          = "";
$santri_first_name    = "";
$santri_last_name     = "";
$santri_gender        = "";
$santri_birthplace    = "";
$santri_birthdate     = "";
$santri_address       = "";
$santri_nohp          = "";
$santri_father_name   = "";
$santri_father_job    = "";
$santri_mother_name   = "";
$santri_mother_job    = "";


if ($page == "Edit") 
{
  $action               = "santri/update";
  $santri_uuid          = $row['santri_uuid'];
  $santri_first_name    = $row['santri_first_name'];
  $santri_last_name     = $row['santri_last_name'];
  $santri_gender        = $row['santri_gender'];
  $santri_birthplace    = $row['santri_birthplace'];
  $santri_birthdate     = $row['santri_birthdate'];
  $santri_address       = $row['santri_address'];
  $santri_nohp          = $row['santri_nohp'];
  $santri_father_name   = $row['santri_father_name'];
  $santri_father_job    = $row['santri_father_job'];
  $santri_mother_name   = $row['santri_mother_name'];
  $santri_mother_job    = $row['santri_mother_job'];
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
                  <strong><?=$page;?></strong> Santri
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="santri_uuid" value="<?=$santri_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Depan</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_first_name" class="form-control" value="<?=$santri_first_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Belakang</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_last_name" class="form-control" value="<?=$santri_last_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-9">
                            <select name="santri_gender" id="santri_gender" class="form-control">
                                <option value="M" <?= ($santri_gender == "M") ? "selected" : "" ?> >Pria</option>
                                <option value="F" <?= ($santri_gender == "F") ? "selected" : "" ?> >Wanita</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tempat lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_birthplace" class="form-control" value="<?=$santri_birthplace;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal Lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_birthdate" class="form-control floating-label" id="date" value="<?=$santri_birthdate;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Address</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="santri_address" class="form-control" cols="10" rows="5" required=""><?=$santri_address;?></textarea>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Hp</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_nohp" class="form-control" value="<?=$santri_nohp;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Ayah</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_father_name" class="form-control" value="<?=$santri_father_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pekerjaa Ayah</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_father_job" class="form-control" value="<?=$santri_father_job;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Ibu</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_mother_name" class="form-control" value="<?=$santri_mother_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pekerjaan Ibu</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="santri_mother_job" class="form-control" value="<?=$santri_mother_job;?>" required=""></div>
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
