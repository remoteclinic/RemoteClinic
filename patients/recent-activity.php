<?php
	require_once "../includes/initiate.php";

	if( get_global('auto_refresh') !="never" ) {
	   header('Refresh: '.get_global('auto_refresh').'');
	}

	if(isset($_GET['local'])){
		$show_from = "local";
		$show_branch = staff_info('branch');
	}else{
		$show_from = "global";
		$show_branch = "global";
	}

	sns_header('Recently Updated');
?>

<div id="recent-activity" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-patients"><span class="inlineicon recent-activity-mini">Recent Activity</span></div>
<div class="panel-body">
<ol class="breadcrumb link-patients">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../patients/">Patients</a></li>
  <li class="active">Recent Activity</li>
</ol>
	<?php if(display_permission("prescribe_patient")==true){ ?>
	<p class="pull-right no-bpadding">
	  <a href="recent-activity.php" role="button" class="btn btn-link <?php if($show_from=='global'){ echo "theme-patients"; }?> btn-sm">Network</a>
	  <a href="recent-activity.php?local" role="button" class="btn btn-link <?php if($show_from=='local'){ echo "theme-patients"; }?> btn-sm"><?php echo branch_name(staff_info('branch'));?></a>
	</p>
	<?php }?>
	<br><br>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['-', 'Patients', 'Reports'],
          ['', 0, 0],
          <?php $get_diff = get_global('recent_hours')/24;  for ($k = 0 ; $k < get_global('recent_hours'); $k++){ $k = $k+$get_diff;?>
          ['-',  <?php echo count_patients($show_branch, $k)?>,      <?php echo count_reports($show_branch, $k)?>],
          <?php }?>
        ]);

        var options = {
			curveType: 'function',
			fontSize: 12,
			fontName: 'Source Sans Pro',
			colors: ['#fb8608','#fcd553'],
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
			legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="width: 100%; height: 300px;" class="center-chart"></div>
    <div class="chart-note">*last <?php echo show_recent_hours();?></div>
    <br>
<table class="table table-striped link-patients link-patients"><tbody>
    <thead>
    <tr><td>ID#</td><td width="50%">Symptoms</td><td></td><td>Status</td><td>Date</td></tr>
	</thead>
	<?php $tcount=0; $recent_hours = get_global('recent_hours');
	if(display_permission("prescribe_patient")==true){
		if($show_from=='global'){
			$sql=mysqli_query($con, "select * from p_reports  where last_update > NOW() - INTERVAL $recent_hours HOUR order by last_update desc limit 999")or die(mysqli_error());
		}else{	$my_branch = staff_info('branch');		
			$sql=mysqli_query($con, "select * from p_reports  where last_update > NOW() - INTERVAL $recent_hours HOUR and branch=$my_branch order by last_update desc limit 999")or die(mysqli_error());
		}
	}else{
		$sql=mysqli_query($con, "select * from p_reports where composed_by='$_SESSION[id]' and last_update > NOW() - INTERVAL $recent_hours HOUR order by last_update desc limit 999")or die(mysqli_error());		
	}
	while($reports=mysqli_fetch_array($sql)){ $tcount++;
	?>
	<tr><td><?php echo $reports['id']?></td><td class="symptoms"><a href="../patients/reports<?php echo $extension;?>?id=<?php echo $reports['id']?>"><?php echo substr($reports['symptoms'],0,80);?>...</a></td><td class="branch-name"><?php if($reports['branch']!=staff_info('branch')) echo "[".branch_info('name',$reports['branch'])."]";?></td><td class="status"><?php if($reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$reports['signed_by']);?></span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']!=""){?><span class="e">(Assigned to <?php echo staff_info("full_name",$reports['engaged_by']);?>)</span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']==""){?><span class="p">(Pending)</span><?php }?></td><td class="date"><?php echo display_time($reports['last_update']);?></td></tr>
	<?php }?>
</tbody></table>
<?php if($tcount==0){?>
	<h4 class="text-center">No recent activity!</h4>
<?php }?>
	<div class="in-last-hours text-right">*last <?php echo show_recent_hours();?></div>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>