
<?php

$action   = "ustadz/save";
$ustadz_uuid           = "";
$ustadz_nama           = "";
$ustadz_nik            = "";
$ustadz_jk             = "";
$ustadz_alamat         = "";
$bidang_ajar_id        = null;


if ($page == "Edit") 
{
  $action   = "ustadz/update";
  $ustadz_uuid           = $row["ustadz_uuid"];
  $ustadz_nama           = $row["ustadz_nama"];
  $ustadz_nik            = $row["ustadz_nik"];
  $ustadz_jk             = $row["ustadz_jk"];
  $ustadz_alamat         = $row["ustadz_alamat"];
  $bidang_ajar_id        = ($row['bidang_ajar_id'] != null) ? json_decode($row['bidang_ajar_id']) : null;
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
                  <strong><?=$page;?></strong> Ustadz
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="ustadz_uuid" value="<?=$ustadz_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIK*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ustadz_nik" class="form-control" value="<?=$ustadz_nik;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Lengkap*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ustadz_nama" class="form-control" value="<?=$ustadz_nama;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-9">
                            <select name="ustadz_jk" id="ustadz_jk" class="form-control">
                                <option value="L" <?= ($ustadz_jk == "L") ? "selected" : "" ?> >Laki-laki</option>
                                <option value="P" <?= ($ustadz_jk == "P") ? "selected" : "" ?> >Perempuan</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Alamat*</label></div>
                          <div class="col-12 col-md-9"><textarea name="ustadz_alamat" class="form-control" cols="10" rows="5" required=""><?=$ustadz_alamat;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Bidang Ajar</label></div>
                          <div class="col-12 col-md-9">
                            <?php
                              if (count($list_ajar) > 0) 
                              {
                                foreach ($list_ajar as $key => $row) 
                                {
                                  $checked = "";
                                  if ($page == "Edit") 
                                  {
                                    if ($bidang_ajar_id != null) 
                                    {
                                      $isArray = (string) array_search($row['id'], $bidang_ajar_id);
                                      if ($isArray !== "") 
                                      {
                                        $checked = "checked";
                                      }
                                    }

                                  }
                                  echo "<input type='checkbox' name='bidang_ajar_id[]'' value='".$row['id']."' ".$checked."> ".$row['judul']." ";
                                  echo "<span style='margin-right:20px'></span>";
                                  if ($key%5 == 0 && $key > 0) 
                                  {
                                    echo "<br />";
                                  }
                                }
                              }
                            ?>
                      </div>
                      <div><small style="color: red">* wajib isi</small></div>

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