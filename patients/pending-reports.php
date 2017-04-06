<?php
	require_once "../includes/initiate.php";

	if( get_global('auto_refresh') !="never" ) {
	   header('Refresh: '.get_global('auto_refresh').'');
	}

	if(isset($_GET['local'])){
		$show_pending = "local";
	}else{
		$show_pending = "global";
	}
	
	sns_header('Pending Reports');
?>

<div id="pending-reports" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-patients"><span class="inlineicon pending-mini">Pending Reports</span></div>
<div class="panel-body">
<ol class="breadcrumb link-patients">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../patients/">Patients</a></li>
  <li class="active">Pending Reports</li>
</ol>

	<?php if(display_permission("prescribe_patient")==true){ ?>
	<p class="pull-right in-page-nav">
	  <a href="pending-reports.php" role="button" class="btn btn-link <?php if($show_pending=='global'){ echo "theme-patients"; }?> btn-sm">Network</a>
	  <a href="pending-reports.php?local" role="button" class="btn btn-link <?php if($show_pending=='local'){ echo "theme-patients"; }?> btn-sm"><?php echo branch_name(staff_info('branch'));?></a>
	</p>
	<?php }?>

    <table class="table table-striped link-patients link-patients"><tbody>
    <thead>
    <tr><td>ID#</td><td width="50%">Symptoms</td><td></td><td>Status</td><td>Date</td></tr>
	</thead>
	<?php $tcount=0; $recent_hours = get_global('recent_hours'); $local_branch = staff_info('branch');
	if($show_pending=='local'){
		$sql=mysqli_query($con, "select * from p_reports where branch=$local_branch and signed_by='' and last_update > NOW() - INTERVAL $recent_hours HOUR order by last_update desc limit 999")or die(mysqli_error());
	}else{
		$sql=mysqli_query($con, "select * from p_reports where signed_by='' and last_update > NOW() - INTERVAL $recent_hours HOUR order by last_update desc limit 999")or die(mysqli_error());		
	}
	while($reports=mysqli_fetch_array($sql)){ $tcount++;
	?>
	<tr><td><?php echo $reports['id']?></td><td class="symptoms"><a href="../patients/reports.php?id=<?php echo $reports['id']?>"><?php echo substr($reports['symptoms'],0,80);?>...</a></td><td class="branch-name"><?php if($reports['branch']!=staff_info('branch')) echo "[".branch_info('name',$reports['branch'])."]";?></td><td class="status"><?php if($reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$reports['signed_by']);?></span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']!=""){?><span class="e">(Assigned)</span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']==""){?><span class="p">(Pending)</span><?php }?></td><td class="date"><?php echo display_time($reports['last_update']);?></td></tr>
	<?php }?>
	</tbody></table>
	<?php if($tcount==0){?>
		<h4 class="text-center">No pending reports!</h4>
	<?php }?>
	<div class="in-last-hours text-right">*last <?php echo show_recent_hours();?></div>


</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>