
<?php

$action           = "pelanggaran/save";
$uuid             = "";
$santri_id        = "";
$kelas            = "";
$peristiwa        = "";
$kronologi        = "";
$motif_melanggar  = "";
$solusi           = "";


if ($page == "Edit") 
{
    $action           = "pelanggaran/update";
    $uuid             = $row['uuid'];
    $santri_id        = $row["santri_id"];
    $kelas            = $row["kelas"];
    $peristiwa        = $row["peristiwa"];
    $kronologi        = $row["kronologi"];
    $motif_melanggar  = $row["motif_melanggar"];
    $solusi           = $row["solusi"];
}
?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Pelanggaran
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="uuid" value="<?=$uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Santri*</label></div>
                          <div class="col-12 col-md-9">
                            <select name="santri_id" class="form-control">
                              <option style="display: none;">-select-</option>
                              <?php
                              if (count($santriList) > 0) 
                              {
                                foreach ($santriList as $row) 
                                {
                                  $selected = "";
                                  if ($row['santri_id'] == $santri_id) {
                                    $selected = "selected";
                                  }
                                  echo "<option value='".$row['santri_id']."' ".$selected.">".$row['santri_nama']."</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kelas*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="kelas" class="form-control" value="<?=$kelas;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Peristiwa*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="peristiwa" rows="7"><?=$peristiwa;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kronologi*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="kronologi" rows="7"><?=$kronologi;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Motif Melanggar*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="motif_melanggar" rows="7"><?=$motif_melanggar;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Solusi*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="solusi" rows="7"><?=$solusi;?></textarea></div>
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
