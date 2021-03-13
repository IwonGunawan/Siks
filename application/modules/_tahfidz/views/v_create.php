
<?php

$action           = "tahfidz/save";
$uuid             = "";
$santri_id        = "";
$kelas            = "";
$tipe_setoran     = "";
$juz              = "";
$surat            = "";
$ayat_awal        = "";
$ayat_akhir       = "";
$catatan          = "";


if ($page == "Edit") 
{
    $action           = "tahfidz/update";
    $uuid             = $row['uuid'];
    $santri_id        = $row["santri_id"];
    $kelas            = $row["kelas"];
    $tipe_setoran     = $row["tipe_setoran"];
    $juz              = $row["juz"];
    $surat            = $row["surat"];
    $ayat_awal        = $row["ayat_awal"];
    $ayat_akhir       = $row["ayat_akhir"];
    $catatan          = $row["catatan"];
}
?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Tahfidz
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
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tipe Setoran*</label></div>
                          <div class="col-12 col-md-9">
                            <select name="tipe_setoran" id="tipe_setoran" class="form-control">
                                  <option value="0" <?= ($tipe_setoran == "0") ? "selected" : "" ?> >Hafalan</option>
                                  <option value="1" <?= ($tipe_setoran == "1") ? "selected" : "" ?> >Murojaah</option>
                              </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Juz</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="juz" class="form-control" value="<?=$juz;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Surat</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="surat" class="form-control" value="<?=$surat;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ayat Awal*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ayat_awal" class="form-control" value="<?=$ayat_awal;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ayat Akhir*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ayat_akhir" class="form-control" value="<?=$ayat_akhir;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Catatan*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="catatan"><?=$catatan;?></textarea></div>
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
