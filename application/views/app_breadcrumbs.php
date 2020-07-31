
<?php
$uri 	= $this->uri->segment(1);
$uri2	= $this->uri->segment(2);

?>
<!-- <div class="col-sm-12">
    <div class="page-header float-right">
        <div class="page-title">
            <ol class="breadcrumb text-right">
                <li><?=$uri;?></li>
                <li><?=$uri2;?></li>
            </ol>
        </div>
    </div>
</div> -->

<div class="row">
  <div class="col-sm-12">
      <div class="page-title-box">
          <h4 class="page-title">Dashboard</h4>
          <ol class="breadcrumb">
              <li class="breadcrumb-item active">Welcome to Agroxa Dashboard</li>
          </ol>

          <div class="state-information d-none d-sm-block">
              <div class="state-graph">
                  <div id="header-chart-1"></div>
                  <div class="info">Balance $ 2,317</div>
              </div>
              <div class="state-graph">
                  <div id="header-chart-2"></div>
                  <div class="info">Item Sold 1230</div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- end row -->