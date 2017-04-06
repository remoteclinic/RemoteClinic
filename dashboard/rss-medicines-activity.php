<?php 
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
?>
<div class="low-med-pies desktop-meds-cel">
<?php 
$alerts_count=0;
$my_branch = staff_info('branch');
$sql=mysqli_query($con, "select * from p_stock where branch='$my_branch' and remaining!=total order by remaining asc limit 4")or die(mysqli_error());
while($display_stock=mysqli_fetch_array($sql)){
	if( $display_stock['remaining'] == $display_stock['total'] || $alerts_count > 4) continue;
$alerts_count++;

$slice_one = ($display_stock['remaining']/$display_stock['total'])*100;
?>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Pac Man', 'Percentage'],
          ['<?php echo $display_stock['code'];?>', <?php echo $slice_one;?>],
          ['', <?php echo 100-$slice_one;?>]
        ]);

        var options = {
        chartArea: {'width': '85%', 'height': '80%'},
          pieStartAngle: 360,
            legend: { position: 'bottom', alignment: 'end', textStyle: { fontSize: '13', fontName: 'Source Sans Pro',}  },
          pieSliceText: 'Te',
          tooltip: { text: 'sds' },
          slices: {
            0: { color: '#e6a3e1' },
            1: { color: 'transparent' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_med_<?php echo $alerts_count;?>'));
        chart.draw(data, options);
      }
    </script>
    <div id="pie_med_<?php echo $alerts_count;?>" class="med_pie" style="width: 100x; height: 178px;"></div>

<?php }?>	
<?php if($alerts_count==0){?><div class="text-center no-med-data">No Stock warnings!</div><?php }?>
</div>


