
<?php

$action         = "guru/save";
$uuid           = "";
$nama           = "";
$nip            = "";
$jk             = "";
$tempat_lahir   = "";
$tgl_lahir      = "";
$alamat         = "";
$email          = "";
$nohp           = "";
$pendidikan_terakhir    = "";
$bidang_ajar    = array();


if ($page == "Edit") 
{
  $action         = "guru/update";
  $uuid           = $row["uuid"];
  $nama           = $row["nama"];
  $nip            = $row["nip"];
  $jk             = $row["jk"];
  $tempat_lahir   = $row["tempat_lahir"];
  $tgl_lahir      = $row["tgl_lahir"];
  $alamat         = $row["alamat"];
  $email          = $row["email"];
  $nohp           = $row["nohp"];
  $pendidikan_terakhir    = $row["pendidikan_terakhir"];
  $bidang_ajar    = json_decode($row['bidang_ajar']);
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
                  <strong><?=$page;?></strong> Guru
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="uuid" value="<?=$uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Lengkap*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="nama" class="form-control" value="<?=$nama;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIP*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="nip" class="form-control" value="<?=$nip;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Jenis Kelamin</label></div>
                          <div class="col-12 col-md-9">
                            <select name="jk" id="jk" class="form-control">
                                <option value="M" <?= ($jk == "M") ? "selected" : "" ?> >Pria</option>
                                <option value="F" <?= ($jk == "F") ? "selected" : "" ?> >Wanita</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tempat lahir*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tempat_lahir" class="form-control" value="<?=$tempat_lahir;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal Lahir*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tgl_lahir" class="form-control floating-label" id="date" value="<?=$tgl_lahir;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="alamat" class="form-control" cols="10" rows="5"><?=$alamat;?></textarea>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="email" class="form-control" value="<?=$email;?>"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Hp*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="nohp" class="form-control" value="<?=$nohp;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pendidikan Terakhir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="pendidikan_terakhir" class="form-control" value="<?=$pendidikan_terakhir;?>" ></div>
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
                                    $isArray = (string) array_search($row['id'], $bidang_ajar);
                                    if ($isArray !== "") {
                                      $checked = "checked";
                                    }

                                  }
                                  echo "<input type='checkbox' name='bidang_ajar[]'' value='".$row['id']."' ".$checked."> ".$row['judul']." ";
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