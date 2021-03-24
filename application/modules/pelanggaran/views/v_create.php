
<?php

$action           = "pelanggaran/save";
$pelanggaran_uuid             = "";
$santri_id                    = "";
$kelas                        = "";
$pelanggaran_peristiwa        = "";
$pelanggaran_kronologi        = "";
$pelanggaran_motif            = "";
$pelanggaran_solusi           = "";


if ($page == "Edit") 
{
    $action           = "pelanggaran/update";
    $pelanggaran_uuid             = $row['pelanggaran_uuid'];
    $santri_id                    = $row["santri_id"];
    $kelas                        = $row["kelas"];
    $pelanggaran_peristiwa        = $row["pelanggaran_peristiwa"];
    $pelanggaran_kronologi        = $row["pelanggaran_kronologi"];
    $pelanggaran_motif            = $row["pelanggaran_motif"];
    $pelanggaran_solusi           = $row["pelanggaran_solusi"];
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

                <input type="hidden" name="pelanggaran_uuid" value="<?=$pelanggaran_uuid;?>">

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
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kelas*</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="santri_kelas" class="form-control" value="<?=$kelas;?>" required="" readonly></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Peristiwa*</label></div>
                          <div class="col-12 col-md-9">
                            <select name="pelanggaran_peristiwa" class="form-control">

                              <?php
                              if (count($jp) > 0) 
                              {
                                foreach ($jp as $key => $row) 
                                {
                                  $selected = "";
                                  if ($row['jp_id'] == $pelanggaran_peristiwa) 
                                  {
                                    $selected = "selected";
                                  }


                                  if ($key == 0) // first
                                  {
                                    echo "<optgroup label='".$row['jp_grup_judul']."'>";
                                    echo "<option ".$selected." value='".$row['jp_id']."'>".$row['jp_judul']."</option>";
                                  }
                                  else if ($key == count($jp)-1) // last
                                  {
                                    echo "<option ".$selected." value='".$row['jp_id']."'>".$row['jp_judul']."</option>";
                                    echo "</optgroup>";
                                  }
                                  else if ($row['jp_grup_id'] == $jp[$key -1]['jp_grup_id']) 
                                  {
                                    echo "<option ".$selected." value='".$row['jp_id']."'>".$row['jp_judul']."</option>";
                                  }
                                  else if ($row['jp_grup_id'] != $jp[$key -1]['jp_grup_id']) 
                                  {
                                    echo "</optgroup>";
                                    echo "<optgroup label='".$row['jp_grup_judul']."'>";
                                    echo "<option ".$selected." value='".$row['jp_id']."'>".$row['jp_judul']."</option>";
                                  }
                                }
                              }

                              ?>
                            </select>

                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kronologi*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="pelanggaran_kronologi" rows="7" required=""><?=$pelanggaran_kronologi;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Motif Melanggar*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="pelanggaran_motif" rows="7" required=""><?=$pelanggaran_motif;?></textarea></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Solusi*</label></div>
                          <div class="col-12 col-md-9"><textarea class="form-control" name="pelanggaran_solusi" rows="7" required=""><?=$pelanggaran_solusi;?></textarea></div>
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