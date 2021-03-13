
<?php

$action           = "tahfidz/save";
$tahfidz_uuid     = "";
$santri_id        = "";
$santri_kelas     = "";
$tahfidz_waktu    = "";
$tahfidz_juz      = "";
$tahfidz_surat    = "";
$tahfidz_ayat     = "";
$tahfidz_status   = "";
$tahfidz_nilai    = "";
$tahfidz_catatan  = "";


if ($page == "Edit") 
{
    $action           = "tahfidz/update";
    $tahfidz_uuid     = $row['tahfidz_uuid'];
    $santri_id        = $row["id"];
    $santri_kelas     = $row["kelas"];
    $tahfidz_waktu    = $row["tahfidz_waktu"];
    $tahfidz_juz      = $row["tahfidz_juz"];
    $tahfidz_surat    = $row["tahfidz_surat"];
    $tahfidz_ayat     = $row["tahfidz_ayat"];
    $tahfidz_status   = $row["tahfidz_status"];
    $tahfidz_nilai    = $row["tahfidz_nilai"];
    $tahfidz_catatan  = $row["tahfidz_catatan"];
}
?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Data
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="tahfidz_uuid" value="<?=$tahfidz_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Santri*</label></div>
                          <div class="col-12 col-md-9">
                            <select name="santri_id" class="form-control" onchange="showClass(this)">
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
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kelas</label></div>
                          <div class="col-12 col-md-9"><input type="text" class="form-control" id="santri_kelas" value="<?=$santri_kelas;?>" readonly="true"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Waktu*</label></div>
                          <div class="col-12 col-md-9">
                            <select name="tahfidz_waktu" id="tahfidz_waktu" class="form-control">
                                  <option value="0" <?= ($tahfidz_waktu == "0") ? "selected" : "" ?> >Pagi</option>
                                  <option value="1" <?= ($tahfidz_waktu == "1") ? "selected" : "" ?> >Siang</option>
                                  <option value="2" <?= ($tahfidz_waktu == "2") ? "selected" : "" ?> >Sore</option>
                              </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Juz</label></div>
                          <div class="col-12 col-md-9">
                            <select name="tahfidz_juz" class="form-control">
                              <?php
                                for ($i=1; $i <=30; $i++) 
                                { 
                                  $selected = "";
                                  if ($i == $tahfidz_juz) 
                                  {
                                    $selected = "selected";
                                  }
                                  echo "<option ".$selected." value='".$i."'>Juz ".$i."</option>";
                                }

                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Surat*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tahfidz_surat" class="form-control" value="<?=$tahfidz_surat;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ayat*</label></div>
                          <div class="col-12 col-md-9"><input type="text" name="tahfidz_ayat" class="form-control" value="<?=$tahfidz_ayat;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Status</label></div>
                          <div class="col-12 col-md-9">
                            <select name="tahfidz_status" class="form-control">
                              <option <?= ($tahfidz_status == "S") ? "selected" : ""; ?> value="S">Setoran</option>  
                              <option <?= ($tahfidz_status == "M") ? "selected" : ""; ?> value="M">Muroja'ah</option>
                              <option <?= ($tahfidz_status == "T") ? "selected" : ""; ?> value="T">Tilawah Quran</option>
                              <option <?= ($tahfidz_status == "TS") ? "selected" : ""; ?> value="TS">Tasmi</option>
                              <option <?= ($tahfidz_status == "MZ") ? "selected" : ""; ?> value="MZ">Mumtaz</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nilai*</label></div>
                          <div class="col-12 col-md-9"><input type="number" name="tahfidz_nilai" class="form-control" value="<?=$tahfidz_nilai;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Catatan</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="tahfidz_catatan" rows="5"><?=$tahfidz_catatan;?></textarea></div>
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

<script type="text/javascript">
  function showClass(object)
  {
    var santriID = object.value;

    $.ajax({
      url     : "<?php echo base_url('santri/getClassByID');?>",
      method  : "GET",
      data    : "santri_id=" + santriID,

      success:function(result)
      {
        document.getElementById('santri_kelas').value = result
      }
    });
  }

</script>