

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-md-4 offset-md-3">
            <div class="card">
              <div class="card-body">
                <form action="<?=base_url('santri/exportSubmit');?>" method="POST">  
                    <label>Limit (data):</label>
                    <select class="form-control" name="limit" style="margin-bottom: 10px">
                      <option value="1">All</option>
                      <option value="100">100</option>
                      <option value="200">200</option>
                      <option value="300" selected="">300</option>
                      <option value="400">400</option>
                      <option value="500">500</option>
                    </select>
                
                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-download"></i>&nbsp; Export</button>
                    <small>file type: *.xlsx</small>
                  </form>
              </div>
            </div>
        </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->
