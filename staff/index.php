<?php
	require_once "../includes/initiate.php";
	page_permission("staff_directory");
	sns_header('Staff Members');
?>

<div id="staff-directory" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-staff"><span class="inlineicon staff-mini">Staff Members</span></div>
<div class="panel-body">
<ol class="breadcrumb link-staff">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li class="active">Staff Members</li>
</ol>

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    	<div class="alert alert-success" role="alert">Staff Profile has been deleted successfully!</div>
	<?php }?>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Activity', '<?php echo access_level2rank(5);?>(s)', '<?php echo access_level2rank(4);?>(s)', '<?php echo access_level2rank(3);?>(s)'],
		<?php 
		$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000")or die(mysqli_error());
		while($branches_dir=mysqli_fetch_array($sql)){
		?>
         ['<?php echo branch_info("name", $branches_dir['id']);?>',  <?php echo staff_by_rank($branches_dir['id'],5);?>,      <?php echo staff_by_rank($branches_dir['id'],4);?>,		<?php echo staff_by_rank($branches_dir['id'],3);?>],
		<?php }?>
    	]);

    var options = {
		seriesType: 'bars',
		fontSize: 11,
		fontName: 'Source Sans Pro',
		colors: ['#50D2C2','#A8E9E1', '#D3F4F0'],
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

    
<?php if(display_permission("staff_profile")==true){?>
	<h4 class="profile-ranks"><?php echo access_level2rank(5);?>(s)</h4>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='5' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<a class="nohover" href="profile<?php echo $extension;?>?id=<?php echo $staff['id']?>">
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>
	</a>

	<?php }?>

<hr/>
	<h4 class="profile-ranks"><?php echo access_level2rank(4);?>(s)</h4>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='4' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<a class="nohover" href="profile<?php echo $extension;?>?id=<?php echo $staff['id']?>">
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>
	</a>

	<?php }?>
<hr/>
	<h4 class="profile-ranks"><?php echo access_level2rank(3);?>(s)</h4>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='3' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<a class="nohover" href="profile<?php echo $extension;?>?id=<?php echo $staff['id']?>">
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>
	</a>

	<?php }?>
<?php }else{?>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='5' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>

	<?php }?>
<hr/>
	<h4 class="profile-ranks"><?php echo access_level2rank(4);?>(s)</h4>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='4' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>

	<?php }?>
<hr/>
	<h4 class="profile-ranks"><?php echo access_level2rank(3);?>(s)</h4>
	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where access_level='3' order by first_name asc limit 2000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	?>
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>Chat: <?php echo $staff['skype']?></p>
	</div></div>

	<?php }?>

<?php }?>
	<div class="details-clear">&nbsp;</div>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>