
<?php

$action           = "santri/save";
$uuid             = "";
$nama             = "";
$no_induk         = "";
$nisn             = "";
$jk               = "";
$tempat_lahir     = "";
$tgl_lahir        = "";
$agama            = "";
$status           = "";
$anak_ke          = "";
$alamat           = "";
$asal_sekolah     = "";
$diterima_dikelas = "";
$tgl_terima       = "";
$ayah             = "";
$ayah_pekerjaan   = "";
$ibu              = "";
$ibu_pekerjaan    = "";
$wali             = "";
$wali_pekerjaan   = "";


if ($page == "Edit") 
{
    $action           = "santri/update";
    $uuid             = $row['uuid'];
    $nama             = $row['nama'];
    $no_induk         = $row['no_induk'];
    $nisn             = $row['nisn'];
    $jk               = $row['jk'];
    $tempat_lahir     = $row['tempat_lahir'];
    $tgl_lahir        = $row['tgl_lahir'];
    $agama            = $row['agama'];
    $status           = $row['status'];
    $anak_ke          = $row['anak_ke'];
    $alamat           = $row['alamat'];
    $asal_sekolah     = $row['asal_sekolah'];
    $diterima_dikelas = $row['diterima_dikelas'];
    $tgl_terima       = $row['tgl_terima'];
    $ayah             = $row['ayah'];
    $ayah_pekerjaan   = $row['ayah_pekerjaan'];
    $ibu              = $row['ibu'];
    $ibu_pekerjaan    = $row['ibu_pekerjaan'];
    $wali             = $row['wali'];
    $wali_pekerjaan   = $row['wali_pekerjaan'];
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

                <input type="hidden" name="uuid" value="<?=$uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Lengkap</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="nama" class="form-control" value="<?=$nama;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">No Induk</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="no_induk" class="form-control" value="<?=$no_induk;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">NISN</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="nisn" class="form-control" value="<?=$nisn;?>" required=""></div>
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
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tempat lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tempat_lahir" class="form-control" value="<?=$tempat_lahir;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal Lahir</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tgl_lahir" class="form-control floating-label" id="date" value="<?=$tgl_lahir;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Agama</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="agama" class="form-control" value="<?=$agama;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Status dlm Keluarga</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="status" class="form-control" value="<?=$status;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Anak ke</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="anak_ke" class="form-control" value="<?=$anak_ke;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Alamat</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="alamat" class="form-control" cols="10" rows="5" required=""><?=$alamat;?></textarea>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Asal Sekolah</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="asal_sekolah" class="form-control" value="<?=$asal_sekolah;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">diterima dikelas</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="diterima_dikelas" class="form-control" value="<?=$diterima_dikelas;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tanggal diterima</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tgl_terima" class="form-control floating-label" id="date2" value="<?=$tgl_terima;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Ayah</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ayah" class="form-control" value="<?=$ayah;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pekerjaa Ayah</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ayah_pekerjaan" class="form-control" value="<?=$ayah_pekerjaan;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Ibu</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ibu" class="form-control" value="<?=$ibu;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pekerjaan Ibu</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="ibu_pekerjaan" class="form-control" value="<?=$ibu_pekerjaan;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Wali</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="wali" class="form-control" value="<?=$wali;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pekerjaan Wali</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="wali_pekerjaan" class="form-control" value="<?=$wali_pekerjaan;?>" required=""></div>
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
