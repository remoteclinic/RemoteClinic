<?php
	require_once "../includes/initiate.php";
	page_permission("staff_profile");

	if(isset($_GET['id'])){$id=$_GET['id'];
	 	// action
	}else{
		$id=$_SESSION['id'];
	}
	sns_header('Staff Log');
?>

<div id="staff-log" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-staff"><span class="inlineicon staff-mini"><?php echo staff_info("full_name",$id);?> on <?php echo "$global_permission->portal_name";?></span></div>
<div class="panel-body">

<table class="table table-striped"><tbody>
	<?php 
	$sql=mysqli_query($con, "select * from p_logs where user='$id' order by id desc limit 500")or die(mysqli_error());
	while($display_log=mysqli_fetch_array($sql)){
	?>
    <tr><td><?php echo display_time($display_log['at']);?><span class="priority_<?php echo priority_level($display_log['priority']);?>">: <?php echo $display_log['action']?></span></td></tr>
	<?php }?>
</tbody></table>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>