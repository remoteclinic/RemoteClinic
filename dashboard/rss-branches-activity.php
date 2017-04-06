<?php 
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
?>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['<?php echo branch_name(staff_info('branch'));?>', 'Patients', 'Reports', 'Active Staff'],
          <?php $branch_id = staff_info('branch'); $get_diff = get_global('recent_hours')/24;  for ($k = 0 ; $k < get_global('recent_hours'); $k++){ $k = $k+$get_diff;?>
			['',  <?php echo count_patients($branch_id, $k)?>,      <?php echo count_reports($branch_id, $k)?>,		<?php echo count_lstaff($branch_id, $k)?>],
          <?php } ?>
        ]);

        var options = {
            curveType: 'function',
			chartArea: {'width': '100%', 'height': '80%'},
            fontSize: 12,
            fontName: 'Source Sans Pro',
            colors: ['#7778ff','#ba77ff', '#fe77ff'],
        hAxis: {
            textStyle: {
              fontSize: 13,
              color: 'transparent',
            },
        },
        vAxis: {
            format: '0',
            baselineColor: '#fafafa',
            textStyle: {
              color: 'transparent',
            },
            gridlines: {
                color: 'transparent'
            }
        },
            legend: { position: 'top' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="width: 100%; height: 175px;" class="center-chart"></div>
<div class="in-last-hours pull-right">*last <?php echo show_recent_hours();?></div>
