<?php
	require_once "../includes/initiate.php";
	page_permission("prescribe_patient");

	if(isset($_GET['id'])){$id=$_GET['id'];}

	$patient_id=report_info("patient",$id);
	$engaged_status=report_info("engaged_by",$id);
	$signed_status=report_info("signed_by",$id);

	sns_header('Prescribe Patient');
?>

<div id="prescribe-patient" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-patients"><span class="inlineicon edit-mini">Prescribe Patient</span></div>
<div class="panel-body">
<ol class="breadcrumb link-patients">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../patients/">Patients</a></li>
  <li class="active">Prescribe Patient</li>
</ol>
	<?php 
		
		$get_composer_branch=staff_info("branch",report_info("composed_by",$id));
		
		if($engaged_status==""&&$signed_status==""){
		echo"<div class='alert alert-info' role='alert'>This report is now assigned to you!</div>";
		}else if($engaged_status!=""&&$signed_status==""){
		$engaged_by=report_info("engaged_by",$id);
		$engaged_by_name= staff_info("full_name",$engaged_by);
		echo"<div class='alert alert-warning' role='alert'>This report was assigned to $engaged_by_name (ID# $engaged_by) but hasn’t been signed yet!</div>";
		}else if($signed_status!=""){
		$signed_by_id=report_info("signed_by",$id);	
		$signed_by=staff_info("full_name",$signed_by_id);
		echo"<div class='alert alert-success' role='alert'>Signed by <a class='staff' href='../staff/profile.php?id=$signed_by_id'>$signed_by</a> (ID# $signed_by_id)!</div>";
		}else{
		echo"";
		}
		$engaged_by=engage_the_report($id);

	?>
	

<?php
if(isset($_POST['submit'])){
	

	$report_id=$id;
	$medicine=$_POST['medicine'];
	$doses=$_POST['doses'];
	$timings=$_POST['timings'];
	$days=$_POST['days'];
	$medicine_charge=$_POST['medicine_charge'];
	$reply=friendly($_POST['reply']);
	$notes=friendly($_POST['notes']);
	$result=prescribe($report_id,$medicine,$doses,$timings,$days,$reply,$notes,$medicine_charge);
	
	if($result!=false){
		
		
	echo"<div class='alert alert-success' role='alert'>Report has been successfully updated!</div>";	
		
	}else{
	echo"<div class='alert alert-danger' role='alert'>Sorry, selected medicine is longer available in your stock~</div>";
	
	}

}
?>
    <table class="table table-striped link-patients link-patients"><tbody>
    <tr><td>Report ID:</td><td><?php echo $id;?></td></tr>
    <tr><td>Token Charge:</td><td><?php echo "$global_permission->currency"?> <?php echo charge_mode(report_info("charge",$id));?></td></tr>

    <?php if(report_info("checkout_charges",$id)!=""){  ?>
    <tr><td>Medicine Charges:</td><td><?php echo "$global_permission->currency"?> <?php echo report_info("checkout_charges",$id);?></td></tr>
    <?php }else{?>
    <tr><td>Medicine Charges:</td><td>n/a</td></tr>  
    <?php } ?>

    <?php if(report_info("fever",$id)!=""){?><tr><td>Fever:</td><td><?php echo report_info("fever",$id);?></td></tr><?php }?>
    <?php if(report_info("blood_pressure",$id)!=""){?><tr><td>Blood Pressure:</td><td><?php echo report_info("blood_pressure",$id);?></td></tr><?php }?>
    <?php if(report_attachment("exist",$id)==true){?><tr><td>Reports:</td><td><a href="../media/reports/<?php echo "$id"?>.zip">Download attachments</a></td></tr><?php }?>	
    <tr><td>Symptoms:</td><td><textarea readonly class="form-textarea"><?php echo report_info("symptoms",$id);?></textarea></td></tr>
	<?php 
	$sql=mysqli_query($con, "select * from p_med_record where report_id='$id' order by last_update desc limit 9000")or die(mysqli_error());
	while($list_med=mysqli_fetch_array($sql)){
	?>
    <tr><td>- <?php echo $list_med['medicine']?></td><td><?php echo $list_med['doses']?> (<?php echo $list_med['timings']?>) for <?php echo $list_med['days']?> day(s)</td></tr>
    <?php } ?>
    </tbody></table>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Medicine:</label><select class="form-control" name='medicine'  id='medicine' size='1' tabindex='1'>
	<?php 
	$sql=mysqli_query($con, "select * from p_stock where branch='$get_composer_branch' order by code asc limit 9000")or die(mysqli_error());
	while($medicines=mysqli_fetch_array($sql)){
	?>
	<option value='<?php echo $medicines['code']?>'><?php echo $medicines['code']?> <?php if(display_permission("medicine_profile")==true){ echo '- '.medicine_by_code('name', $medicines['code']); }?></option>
	<?php }?>
    </select></div>
    <div class="form-group"><label>Doses:</label><select class="form-control" name='doses' id='doses' size='1'>
			<option value="1+0+0">1+0+0</option>
			<option value="1+1+0">1+1+0</option>
			<option value="1+1+1">1+1+1</option>
			<option value="0+1+0">0+1+0</option>
			<option value="1+0+1">1+0+1</option>
			<option value="0+1+1">0+1+1</option>
          </select><i>Morning+Evening+Night</i></div>
    <div class="form-group"><label>Timings:</label><select class="form-control" name='timings' id='timings' size='1'>
			<option value="After Meal">After Meal</option>
			<option value="Before Meal">Before Meal</option>
          </select></div>
    <div class="form-group"><label>Days:</label><select class="form-control" name='days' id='days' size='1'>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
          </select></div>
    <div class="form-group"><label>Medicine Charge:</label><select class="form-control" name='medicine_charge' id='medicine_charge' size='1'>
			<option value="no">Free</option>
			<option value="yes">Charged</option>
          </select></div>

	<div class="details-clear">&nbsp;</div>

         
	<div class="form-group"><label>Attach note(s):</label><textarea class="form-control" name="reply" id="reply" class="inputOne" cols="9" rows="4"><?php echo report_info("reply",$id);?></textarea></div>
    <input type="hidden" name="notes" value="<?php echo report_info("notes",$id);?>"/>
    
    <input type="hidden" name="patient" value="<?php echo report_info("patient",$id);?>" class="inputOne" cols="9" rows="4"/>

    <!--
    <div id="sysNotes"><?php echo report_info("notes",$id);?></div>
	-->
	<input name="submit" class="btn btn-default formbutton theme-patients sign_rep_1" name="submit" class="formbutton patient" type="submit" value="update">
</form>

    <a class="btn btn-default formbutton theme-stsaff norm sign_rep_1" href="../dashboard">Close!</a>

    <div class="panel panel-default push_low">
    <div class="panel-heading _theme-patients">About Patient</div>
    <div class="panel-body">
    <table class="table table-striped link-patients link-patients"><tbody>
    <tr><td>Patient:</td><td><a href="../patients/profile.php?id=<?php echo patient_info("id",$patient_id);?>" class="patient"><?php echo patient_info("name",$patient_id);?></a> | <?php echo patient_info("serial",$patient_id);?>-<?php echo patient_info("id",$patient_id);?></td></tr>
    <tr><td>Registered:</td><td><?php echo $global_permission->guardian_short_name; echo patient_info("branch",$patient_id);?> - <?php echo branch_name(patient_info("branch",$patient_id));?></td></tr>
    <tr><td>Registered By:</td><td><a class="staff" href="../staff/profile.php?id=<?php echo patient_info("physician",$patient_id);?>"><?php echo staff_info("full_name",patient_info("physician",$patient_id));?></a></td></tr>
    <tr><td>Last Update:</td><td><?php echo display_time(patient_info("last_update",$patient_id));?></td></tr>
    </tbody></table>
	</div></div>


</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>