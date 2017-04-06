<?php
	require_once "../includes/initiate.php";
	page_permission("branches_directory");
	sns_header('Clinics'); 
?>

<div id="branch-directory" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-branches"><span class="inlineicon network-mini">Clinics</span></div>
<div class="panel-body">
<ol class="breadcrumb link-branches">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li class="active">Clinics</li>
</ol>

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div  class="alert alert-success" role="alert">Clinic Profile has been successfully deleted!</div>
	<?php }?>
    
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Activity', 'Patients', 'Reports', 'Active Staff'],
		<?php 
		$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000")or die(mysqli_error());
		while($clinics=mysqli_fetch_array($sql)){
		?>
         ['<?php echo branch_info("name", $clinics['id']);?>',  <?php echo count_patients($clinics['id'], get_global('recent_hours'))?>,      <?php echo count_reports($clinics['id'], get_global('recent_hours'))?>,		<?php echo count_lstaff($clinics['id'], get_global('recent_hours'))?>],
		<?php }?>
    	]);

    var options = {
		seriesType: 'bars',
		fontSize: 12,
		fontName: 'Source Sans Pro',
		colors: ['#BA77FF','#DDBBFF', '#EEDDFF'],
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
  		series: {5: {type: 'line'}}

    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>

    <div id="chart_div" style="width: 100%; height: 300px;" class="center-chart"></div>
    <div class="chart-note">*last <?php echo show_recent_hours();?></div>   
    <br>
<?php 
$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 100")or die(mysqli_error());
while($clinics=mysqli_fetch_array($sql)){
?>

	<a class="nohover" href="profile.php?id=<?php echo $clinics['id']?>">
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-branches">
	  	<?php echo substr($clinics['name'],0,30);?> - <?php echo "$global_permission->guardian_short_name"; echo $clinics['id']?> <?php if($clinics['type']=="Head Office"){echo" (Head Office)";}else{ echo "";}?>
	  </div>
	  <div class="panel-body">

		<p><i class="glyphicon glyphicon-home"></i> <?php echo substr($clinics['address'], 0,16);?>, <?php echo $clinics['location']?></p>
		<p><i class="glyphicon glyphicon-earphone"></i> Call: <?php echo $clinics['contact']?></p>
	  </div>
	</div>
	</a>

<?php }?>
<br>
</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>