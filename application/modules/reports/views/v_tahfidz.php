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
      url     : "<?=base_url('reports/tahfidz/view_avg_class');?>", 
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
        type: 'column'
      },
      title: {
        text: 'Laporan Nilai Tahfidz'
      },
      subtitle: {
        text: "Bulan <?=$curr_month;?>"
      },
      xAxis: {
        type: 'category',
        labels: {
          rotation: -45,
          style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Nilai Tahfidz'
        }
      },
      legend: {
        enabled: false
      },
      tooltip: {
        pointFormat: 'Nilai rata-rata : <b>{point.y:.1f} </b>'
      },
      series: [{
        name: 'Rata-rata',
        data: content,
        dataLabels: {
          enabled: true,
          rotation: -90,
          color: '#FFFFFF',
          align: 'right',
          format: '{point.y:.1f}', // one decimal
          y: 10, // 10 pixels down from the top
          style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      }]
    });
  }
</script>