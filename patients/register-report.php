<?php
	require_once "../includes/initiate.php";
	page_permission("register_patient");

	$success=false;

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['success'])){$success=true;}

	sns_header('New Report');
?>

<div id="new-report" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-patients"><span class="inlineicon edit-mini">New Report</span></div>
<div class="panel-body">
<ol class="breadcrumb link-patients">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../patients/">Patients</a></li>
  <li><a href="../patients/register-patients.php">New Patient</a></li>
  <li class="active">New Report</li>
</ol>
<?php

if(isset($_POST['submit'])){

	$patient=$_POST['patient'];
	$charge=$_POST['charge'];
	$fever=friendly($_POST['fever']);
	$blood_pressure=friendly($_POST['blood_pressure']);
	$symptoms=friendly($_POST['symptoms']);
	$engaged_by=$_POST['engaged_by'];
	$result=compose_report($patient,$charge,$fever,$blood_pressure,$symptoms,$engaged_by);
	
	if($result!=false){
		
			if(isset($_FILES["file"]["tmp_name"])&& $_FILES["file"]["tmp_name"]!=""){
				$dest="../media/reports/$result".".zip";
				copy($_FILES["file"]["tmp_name"],$dest);
			}

	echo"<div class='alert alert-success' role='alert'>Report successfully updated!</div>";	
	
			if(display_permission("prescribe_patient")==true){
				echo"<a class='btn btn-default formbutton theme-patients' href=../patients/prescribe.php?id=$result>Prescribe</a>";
			}else{
				echo"<a class='btn btn-default formbutton theme-patients' href=../patients/register-patient.php?id=$id>New Patient</a>";
			}
	
	}else{
	echo"<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";	
	echo"<input class='btn btn-default formbutton theme-patients' value='Try Again' onclick='window.history.back()'/>";
	}

}else{
?>
	<?php if($success==true){?>
	<div class="alert alert-success" role="alert">Patient successfully registered.</div> 
	<?php }?>
    
    <table class="table table-striped link-patients"><tbody>
    <tr><td>Patient Name:</td><td><a href="../patients/profile.php?id=<?php echo patient_info("id",$id);?>" class="patient"><?php echo patient_info("name",$id);?></a></td></tr>
    <tr><td>Patient ID:</td><td><?php echo patient_info("serial",$id);?>-<?php echo patient_info("id",$id);?></td></tr>
    <tr><td>Registered At:</td><td><?php echo $global_permission->guardian_short_name; echo patient_info("branch",$id);?> - <?php echo branch_name(patient_info("branch",$id));?></td></tr>
    <tr><td>Registered By:</td><td><a class="staff" href="../staff/profile<?php echo $extension;?>?id=<?php echo patient_info("physician",$id);?>"><?php echo staff_info("full_name",patient_info("physician",$id));?></a></td></tr>
    <tr><td>Last Update:</td><td><?php echo display_time(patient_info("last_update",$id));?></td></tr>
	</tbody></table>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Token Charge Mode:</label><select class="form-control" name='charge' class="inputOne"  id='charge' size='1'>
				<option value="a">Charge Mode A - <?php echo "$global_permission->currency"?> <?php echo charge_mode("a");?></option>
				<option value="b">Charge Mode B - <?php echo "$global_permission->currency"?> <?php echo charge_mode("b");?></option>
				<option value="c">Charge Mode C - <?php echo "$global_permission->currency"?> <?php echo charge_mode("c");?></option>>
				<option value="d" selected="selected">Charge Mode D - <?php echo "$global_permission->currency"?> <?php echo charge_mode("d");?></option></select></div>
	<div class="form-group"><label>Symptoms:</label><textarea class="form-control" name="symptoms" id="symptoms" class="inputOne" cols="9" rows="4"></textarea></div>
	<div class="form-group"><label>Fever:</label><input class="form-control" name="fever" type="text" /><i>&deg;F</i></div>
	<div class="form-group"><label>Blood Pressure:</label><input class="form-control" name="blood_pressure" type="text" /><i>Systolic BP mmHg / Diastolic BP mmHg</i></div>
	<!--
	<div class="form-group"><label>Upload(s):</label><input class="form-control" class="file" name="file" type="file" /><i>*zipped files only</i></div>
	-->
	<div class="form-group"><label>Assign to:</label><select class="form-control" name='engaged_by'  id='engaged_by' size='1' tabindex='1'>
	<?php if( display_permission('prescribe_patient',staff_info('id'))==true) { ?>
	<option value="<?php echo staff_info('id');?>">Myself</option>
	<?php }?>
	<option value="">Open Ticket</option>
	<?php 
	$my_branch = staff_info("branch");
	$sql=mysqli_query($con, "select * from p_staff_dir where branch=$my_branch and status='active' order by first_name desc limit 2000")or die(mysqli_error());
	while($staff_dir=mysqli_fetch_array($sql)){ 
		if( display_permission('prescribe_patient', $staff_dir['id'] ) == false ) continue;
		if( $staff_dir['id'] == staff_info('id') ) continue;
	?>
    <option value='<?php echo $staff_dir['id'];?>'><?php echo $staff_dir['full_name'];?> (<?php echo branch_info('name', staff_info('branch',$staff_dir['id']));?>)</option>
	<?php }?>
    </select></div>


	<div class="widget-border">&nbsp;</div>
    <input type="hidden" name="patient" value="<?php echo $id;?>"/>
	<input name="submit" class="btn btn-default formbutton theme-patients" name="submit" class="formbutton patient" type="submit" value="Register">
</form>
<?php }?>
</div>


</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>