
<style type="text/css">
  .progress {
  background: red;
  display: block;
  height: 20px;
  text-align: center;
  transition: width .3s;
  width: 0;
}

.progress.hide {
  opacity: 0;
  transition: opacity 1.3s;
}

#file_santri {
  margin-top: 10px;
  margin-bottom: 10px;
}
</style>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5>Cara import : </h5>
              <ol style="margin-left: 10px; font-size: 12px;">
                <li>Silakan download template <a href="<?=base_url('assets/santri.xlsx');?>" target="_blank">santri.xlsx</a></li>
                <li>ketikan data santri yang ingin di import pada file santri.xlsx > setelah selesai lalu save</li>
                <li>Pada <b>form import data</b> klik "Choose file" lalu pilih santri.xlsx yang telah di isi</li>
                <li>klik "button import" (tunggu sampai proses preview data selesai)</li>
                <li>jika preview data sudah benar, silakan klik button "save data" untuk menyimpan data ke server.</li>
                <li>tunggu sampai proses selesai.</li>
              </ol>

            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                  <form id="import_form" method="POST" enctype="multipart/form-data">
                    <h5>Form Import Data</h5>
                    <input type="file" id="file_santri" name="file_santri" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                
                    <button type="submit" id="import" class="btn btn-warning btn-lg btn-block"><i class="fa fa-upload"></i>&nbsp; Import</button>
                  </form>

                  <form action="<?=base_url('santri/importSave');?>" id="save_form" method="POST">
                    <input type="hidden" id="text_santri" name="text_santri" >

                    <button type="submit" id="save" class="btn btn-success btn-lg btn-block" style="display: none;"><i class="fa fa-save"></i>&nbsp; Save Data</button>
                  </form>
                  
                  <small>
                    <ul style="margin-left: 15px;">
                      <li>action import support only : save</li>
                      <li>file type : *.xlsx</li>
                    </ul>
                  </small>

                
                  <div class="progress"></div>
              </div>
            </div>
        </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
                <div id="container">
                  <small align="center">no preview data ...</small>
                </div>
            </div>
          </div>
        </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->


<script type="text/javascript">

  $('#import_form').on('submit', function(event)
  {

    event.preventDefault();

    $.ajax({
        xhr: function () {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function (evt) {
              if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  
                  $('.progress').css({
                      width: percentComplete * 100 + '%'
                  });
                  if (percentComplete === 1) {
                      $('.progress').addClass('hide');
                  }
              }
          }, false);
          xhr.addEventListener("progress", function (evt) {
              if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  console.log(percentComplete);
                  $('.progress').css({
                      width: percentComplete * 100 + '%'
                  });
              }
          }, false);
          return xhr;
      },
      url     : "<?php echo base_url('santri/importSubmit');?>",
      method  : "POST",
      data    : new FormData(this),
      contentType   :false,
      cache         :false,
      processData   :false,

      success:function(result)
      {
        var a = JSON.parse(result);

        $('#container').html(a.table);
        document.getElementById('text_santri').value = a.data

        console.log(a.data)

        // show and hide button
        document.getElementById('import').style.display = "none";
        document.getElementById('save').style.display = "block";

      }

    });
  });

</script>
