    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
        <?php $recent_hours = get_global('recent_hours'); $sql_meds=mysqli_query($con, "select * from p_med_record where last_update > NOW() - INTERVAL $recent_hours HOUR order by total desc limit 10")or die(mysqli_error()); ?>
         ['Activity',<?php while($medicines=mysqli_fetch_array($sql_meds)){ echo "'".$medicines['medicine']."', ";  }?>],
         ['',<?php $sql_meds=mysqli_query($con, "select * from p_med_record where last_update > NOW() - INTERVAL $recent_hours HOUR order by total desc limit 10")or die(mysqli_error());  $count_all_active=0;
         while($medicines=mysqli_fetch_array($sql_meds)){ $count_all_active = $count_all_active+$medicines['total']; echo $medicines['total'].", ";  }?>],
        ]);

    var options = {
        seriesType: 'bars',
        fontSize: 12,
        fontName: 'Source Sans Pro',
        colors: ['#c939bf','#ce48c4','#d258c9','#d667ce','#da76d3','#de86d8','#e395dd','#e7a5e2','#ebb4e7','#efc4ec',],
        chartArea: {'width': '100%', 'height': '90%'},
        hAxis: {
            textStyle: {
              fontSize: 13,
              color: '#1d1d1d',
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
        legend: 'none',
        series: {10: {type: 'line'}}

    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>
    <?php if($count_all_active==0){?><div class="text-center no-med-data">No data available!</div><?php }else{?>

        <div id="chart_div" style="width: 100%; height: 255px;" class="center-chart"></div>
       <?php if($count_all_active==0){?><div class="text-center">No data available!</div><?php }?>
   <?php }?>
