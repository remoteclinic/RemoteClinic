<?php 
require_once "../pre-includes/all.php";
include "../includes/libraries.php";

$pending_count=0;
$my_pending_count=0;
if(display_permission("prescribe_patient")==true){
?>

    <table class="table table-striped table-noborder link-patients link-patients"><tbody>
	<?php  $my_id = staff_info('id'); 
	$sql_myreports=mysqli_query($con, "select * from p_reports where signed_by='' and engaged_by=$my_id and last_update > NOW() - INTERVAL 1 DAY order by last_update desc limit 5")or die(mysqli_error());
	while($display_myreports=mysqli_fetch_array($sql_myreports)){ $my_pending_count++;
	?>
		<tr><td><?php echo patient_info('name',$display_myreports['patient']);?></td><td width="45%" class="symptoms"><a href="../patients/reports.php?id=<?php echo $display_myreports['id']?>"><?php echo substr($display_myreports['symptoms'],0,80);?>...</a></td><td class="branch-name"><?php  if($display_myreports['branch']!=staff_info('branch')) echo "[".branch_info('name',$display_myreports['branch'])."]";?></td><td class="status"><?php if($display_myreports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_myreports['signed_by']);?></span><?php }?><?php if($display_myreports['signed_by']==""&&$display_myreports['engaged_by']!=""){?><span class="e">(Assigned to you)</span><?php }?><?php if($display_myreports['signed_by']==""&&$display_myreports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></td><td class="date minitime"><?php echo display_time($display_myreports['last_update']);?></td></tr>
	<?php } ?>

		<?php 
		if( $my_pending_count == 0 ){
		$sql=mysqli_query($con, "select * from p_reports where engaged_by='' order by last_update desc limit 5")or die(mysqli_error());

		while($display_reports=mysqli_fetch_array($sql)){
		$pending_count++;	
		?>
		<tr><td><?php echo patient_info('name',$display_reports['patient']);?></td><td width="45%" class="symptoms"><a href="../patients/reports.php?id=<?php echo $display_reports['id']?>"><?php echo substr($display_reports['symptoms'],0,80);?>...</a></td><td class="branch-name"><?php  if($display_reports['branch']!=staff_info('branch')) echo "[".branch_info('name',$display_reports['branch'])."]";?></td><td class="status"><?php if($display_reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_reports['signed_by']);?></span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']!=""){?><span class="e">(Assigned)</span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></td><td class="date minitime"><?php echo display_time($display_reports['last_update']);?></td></tr>
		<?php } }?>
	</tbody></table>
<?php }else{ ?>
    <table class="table table-stripsed link-patients link-patients"><tbody>
	<?php 
	$my_id= staff_info('id');
	$sql=mysqli_query($con, "select * from p_reports where composed_by='$my_id' order by last_update desc limit 5")or die(mysqli_error());		
	while($display_reports=mysqli_fetch_array($sql)){
	$pending_count++;	
	?>
	<tr><td><?php echo $display_myreports['id'];?></td><td><?php echo patient_info('name',$display_reports['patient']);?><td width="65%" class="symptoms"><a href="../patients/reports.php?id=<?php echo $display_reports['id']?>"><?php echo substr($display_reports['symptoms'],0,80);?>...</a></td><td class="status"><?php if($display_reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_reports['signed_by']);?></span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']!=""){?><span class="e">(Waiting)</span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']==""){?><span class="p">(Pending)</span><?php }?></td><td class="date minitime"><?php echo display_time($display_reports['last_update']);?></td></tr>
	<?php }?>
	</tbody></table>
<?php }?>
<?php if($pending_count==0 && $my_pending_count==0){?>
	<br><br><h4 class="text-center">Your pending reports would be displayed here!</h4>
<?php }?>

