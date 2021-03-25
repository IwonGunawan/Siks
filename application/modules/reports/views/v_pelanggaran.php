<script src="<?=base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script src="<?=base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
<script src="<?=base_url('assets/plugins/highcharts/export-data.js'); ?>"></script>
<script src="<?=base_url('assets/plugins/highcharts/accessibility.js'); ?>"></script>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <form method="GET" action="<?=base_url('reports/tahfidz/view');?>">
                    <div class="col-md-3">
                      <label class="form-label">View By : </label>
                      <select class="form-control" name="class_type" onchange="changeGraph(this.value)">
                        <option value="all">Semua</option>
                        <option value="VII">Kelas VII</option>
                        <option value="VIII">Kelas VIII</option>
                        <option value="IX">Kelas IX</option>
                      </select>
                    </div>

                  </form>
              </div>
              <div class="card-body">

                <figure class="highcharts-figure">
                  <div id="container"></div>
                </figure>

              </div>
            </div>
        </div>


    </div>
  </div><!-- .animated -->
</div>

<script type="text/javascript">

  showHighCharts();


  function changeGraph(val){

    $.ajax({
      method  : "GET", 
      url     : "<?=base_url('reports/pelanggaran/view_avg_class');?>", 
      data    : "view_by=" + val, 
      success: function(result) {
        showHighCharts(result)
      }
    })
  }


  function showHighCharts(val=null) 
  {
    var content = <?php echo $graph_data; ?>;
    
    if (val != null) {
      content = JSON.parse(val)
    }

    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Laporan Pencatatan Sanksi : <?php echo $curr_month; ?>'
        },
        tooltip: {
            pointFormat: '{series.name} <b>{point.y}</b> dari 100 poin'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}'
                }
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: content
        }]
    });
  }
</script>