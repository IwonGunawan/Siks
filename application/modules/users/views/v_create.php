
<?php

$action           = "users/save";
$users_uuid       = "";
$users_name       = "";
$users_email      = "";
$users_pass       = "";
$users_level      = "";
$users_status     = "";

if ($page == "Edit") 
{
  $action           = "users/update";
  $users_uuid       = $data['users_uuid'];
  $users_name       = $data['users_name'];
  $users_email      = $data['users_email'];
  $users_level      = $data['users_level'];
  $users_status     = $data['users_status'];
}

?>

<style type="text/css">
  .card-header {
    background-color: #3b5de7;
    color: white;
  }
  .form-control:disabled {
    background-color: #dadade !important;
  }
</style>

<div class="content mt-3">
  <div class="animated fadeIn" style="margin-top: 100px">
    <div class="row justify-content-md-center">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> User
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="users_uuid" value="<?=$users_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama </label></div>
                          <div class="col-12 col-md-9"><input type="text" id="users_name" name="users_name" class="form-control" value="<?=$users_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIK/NISN</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="users_email" name="users_email" class="form-control" value="<?=$users_email;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Akses Level</label></div>
                          <div class="col-12 col-md-3">
                            <select name="users_level" class="form-control"> 
                              <option value="1" <?= ($users_level == 1) ? "selected" : "";?> >Ustadz</option>
                              <option value="2" <?= ($users_level == 2) ? "selected" : "";?> >Santri</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Status</label></div>
                          <div class="col-12 col-md-3">
                            <select name="users_status" class="form-control"> 
                              <option value="0" <?= ($users_status == 0) ? "selected" : "";?> >Aktif</option>
                              <option value="1" <?= ($users_status == 1) ? "selected" : "";?> >Non Aktif</option>
                            </select>
                          </div>
                      </div>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-secondary waves-effect waves-light mr-1" onclick="history.back(-1)">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
              </form>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->