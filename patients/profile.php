<?php
    require_once "../includes/initiate.php";

	if(isset($_GET['id'])){$id=$_GET['id'];}

	if(isset($_GET['delete'])&&display_permission("edit_patient")==true){ delete_single_patient($id); 	
    	print "<script>";
    	print "self.location='../patients/?deleted';"; 
        print "</script>";
 	}

    sns_header( patient_info("name",$id) );
?>

<div id="patient-profile" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-patients"><span class="inlineicon patients-mini"><?php echo patient_info("name",$id);?></span></div>
<div class="panel-body">
<ol class="breadcrumb link-patients">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../patients/">Patients</a></li>
  <li class="active">Profile</li>
</ol>

<table class="table table-striped link-patients"><tbody>
    <tr><td>Patient Name</td><td><?php echo patient_info("name",$id);?></td></tr>
    <tr><td>Patient ID</td><td><?php echo patient_info("serial",$id);?>-<?php echo patient_info("id",$id);?></td></tr>
    <tr><td>Registered at</td><td><?php echo "$global_permission->guardian_short_name"; echo patient_info("branch",$id);?> - <?php echo branch_name(patient_info("branch",$id));?></td></tr>
    <tr><td>Registered by</td><td><a class="staff" href="../staff/profile.php?id=<?php echo patient_info("physician",$id);?>"><?php echo staff_info("full_name",patient_info("physician",$id));?></a></td></tr>

    <?php if( patient_info("contact",$id) && display_permission('patient_contact')==true ):?>
    <tr><td>Contact</td><td><?php echo patient_info("contact",$id);?></td></tr>
    <?php endif;?>

    <?php if( patient_info("email",$id) && display_permission('patient_email')==true ):?>
    <tr><td>Email</td><td><?php echo patient_info("email",$id);?></td></tr>
    <?php endif;?>

    <?php if( patient_info("ref_contact",$id) ):?>
    <tr><td>Ref. Contact</td><td><?php echo patient_info("ref_contact",$id);?></td></tr>
    <?php endif;?>


    <?php if( patient_info("profession",$id) ):?>
    <tr><td>Profession</td><td><?php echo patient_info("profession",$id);?></td></tr>
    <?php endif;?>

    <?php if( patient_info("address",$id) && display_permission('patient_address')==true ):?>
    <tr><td>Address</td><td><?php echo patient_info("address",$id);?></td></tr>
    <?php endif;?>


    <?php if( patient_info("weight",$id) ):?>
    <tr><td>Weight</td><td><?php echo patient_info("weight",$id);?></td></tr>
    <?php endif;?>


    <tr><td>Last Update</td><td><?php echo display_time(patient_info("last_update",$id));?></td></tr>
    <?php if(display_permission("register_patient")==true){
?><tr><td>Actions</td><td><a class="patient" href="../patients/register-report.php?id=<?php echo $id;?>">New Report</a></td></tr><?php }?>
	<tr><td></td><td><?php if(display_permission("edit_patient")==true){?><a href="edit-patient.php?id=<?php echo $id;?>">Edit Profile</a><?php }?></td></tr>
	<tr><td></td><td><?php if(display_permission("edit_patient")==true){?><a href="?id=<?php echo $id;?>&delete=1">Delete Patient and data associated with them!</a><?php }?></td></tr>
</tbody></table>

    <?php
	$getting_total=mysqli_query($con, "select * from p_reports where patient='$id'")or die(mysqli_error());
	$getting_total=mysqli_num_rows($getting_total);
	if($getting_total!=0){

    ?>
    <h4>Patient History</h4>
<table class="table table-striped link-patients table-reports"><tbody>
    <thead>
    <tr><td>ID</td><td width="60%">Symptoms</td><td>Status</td><td>Update</td></tr>
	</thead>
    	<?php 
    	$sql=mysqli_query($con, "select * from p_reports where patient='$id' order by last_update desc limit 1000")or die(mysqli_error());
    	while($reports=mysqli_fetch_array($sql)){
    	?>
    	
    		<tr><td><?php echo $reports['id']?></td><td class="symptoms"><a href="../patients/reports<?php echo $extension;?>?id=<?php echo $reports['id']?>"><?php echo substr($reports['symptoms'],0,80);?>...</a></td><td class="status"><?php if($reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$reports['signed_by']);?></span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']!=""){?><span class="e">(Assigned)</span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></td><td class="date"><?php echo display_time($reports['last_update']);?></td>
    		
    	<?php }?>
    <?php }?>
</tbody></table>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>