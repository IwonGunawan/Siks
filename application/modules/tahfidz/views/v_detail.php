
<?php
$modified_date = $data['modified_date'];
if ($modified_date != NULL) 
{
  $modified_date = date("M d, Y H:i", strtotime($data['modified_date']));
}
else {
  $modified_date = "-";
}

// tahfidz_waktu
$arr_waktu = array("Pagi", "Siang", "Sore");

// tahfidz_status
$tahfidz_status = $data['tahfidz_status'];
if ($tahfidz_status == "S") 
{
  $tahfidz_status = "Setoran";
} 
else if ($tahfidz_status == "M") 
{
  $tahfidz_status = "Muroja'ah";
} 
else if ($tahfidz_status == "T") 
{
  $tahfidz_status = "Tilawah Quran";
} 
else if ($tahfidz_status == "TS") 
{
  $tahfidz_status = "Tasmi";
}
else if ($tahfidz_status == "MZ") 
{
  $tahfidz_status = "Mumtaz";
}
?>

<style type="text/css">
  .form-group {
    margin-bottom: unset !important;
  }

  .font-bold {
    font-weight: bold;
  }
</style>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-6">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong>
              </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="row form-group">
                          <div class="col col-md-4"><label class="form-control-label font-bold">Nama Santri</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['nama'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Kelas</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['kelas'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Tanggal & Waktu</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=date("M d, Y", strtotime($data['created_date'])). " - (".$arr_waktu[$data['tahfidz_waktu']].")"; ?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Juz</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tahfidz_juz'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Surat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tahfidz_surat'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Ayat</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tahfidz_ayat'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Status</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$tahfidz_status;?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Nilai</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tahfidz_nilai'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Catatan</label></div>
                          <div class="col-12 col-md-8"><p class="form-control-static"><?=$data['tahfidz_catatan'];?></p>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-4"><label class=" form-control-label font-bold">Diubah Tgl </label></div>
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