<div class="row" style="margin-top: 15%">
  <div class="col-6" style="margin-top: -50px; margin-bottom: -30px">
    <div class="divider fs-16"><h3><?= $page; ?></h3></div>
  </div>

  <div class="col-12">
    <div class="card col-md-6">
      <div class="card-body">

        <?php
          if($this->session->flashdata('msg')) 
          {
            echo "<small class='text-success'>".$this->session->flashdata("msg")."</small>";
          }
          else if ($this->session->flashdata("error")) 
          {
            echo "<small class='text-danger'>".$this->session->flashdata("error")."</small>";
          }
        ?>
        <form method="POST" action="<?= base_url('users/password/change'); ?>">
          <div class="form-group">
            <label>Password saat ini</label>
            <input type="password" name="current_password" class="form-control" required="">
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="new_password1" class="form-control" required="">
          </div>
          <div class="form-group">
            <label>Ulangi Password Baru</label>
            <input type="password" name="new_password2" class="form-control" required="">
          </div>

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div>

</div> 