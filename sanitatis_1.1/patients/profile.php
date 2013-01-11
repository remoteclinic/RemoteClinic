<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";

	if(isset($_GET['id'])){$id=$_GET['id'];}

	if(isset($_GET['delete'])&&display_permission("edit_patient")==true){ delete_single_patient($id); 	
	print "<script>";
	print "self.location='../patients/patients-directory$extension?deleted';"; 
    print "</script>";
 	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">patient profile</h1>
	<div class="patient-bottom-border"></div>
<div class="innertube">
	<ul id="details">
    <li class="title">Patient Name:</li><li><?php echo patient_info("name",$id);?></li>
    <li class="title">Patient ID:</li><li><?php echo patient_info("serial",$id);?>-<?php echo patient_info("id",$id);?></li>
    <li class="title">Registered At:</li><li><?php echo "$global_permission->guardian_short_name"; echo patient_info("branch",$id);?> - <?php echo branch_name(patient_info("branch",$id));?></li>
    <li class="title">Registered by:</li><li><a class="staff" href="../staff/profile<?php echo $extension;?>?id=<?php echo patient_info("physician",$id);?>"><?php echo staff_info("full_name",patient_info("physician",$id));?></a></li>
    <li class="title">Last Update:</li><li><?php echo display_time(patient_info("last_update",$id));?></li>
    <?php if(display_permission("register_patient")==true){
?><li class="title">Actions:</li><li><a class="patient" href="../patients/compose<?php echo $extension;?>?id=<?php echo $id;?>">Compose a report for this patient</a></li><?php }?>
	<li class="title"></li><li><?php if(display_permission("edit_patient")==true){?><a href="edit<?php echo $extension;?>?id=<?php echo $id;?>">Edit Profile</a><?php }?></li>
	<li class="title"></li><li><?php if(display_permission("edit_patient")==true){?><a href="?id=<?php echo $id;?>&delete=1">Delete this profile and reports attached to this patient</a><?php }?></li>
	</ul>
    <p>&nbsp;</p>
    <?php
	$getting_total=mysql_query("select * from p_reports where patient='$id'")or die(mysql_error());
	$getting_total=mysql_num_rows($getting_total);
	if($getting_total!=0){

    ?>
	<div class="details-clear">&nbsp;</div>
    <h3>patient history</h3>
	<ul id="list_reports">
    <li class="title"><strong>ID</strong></li><li class="symptoms"><strong>Symptoms</strong></li><li class="status"><strong>Status</strong></li><li class="date"><strong>Date</strong></li>
	<?php 
	$sql=mysql_query("select * from p_reports where patient='$id' order by last_update desc limit 1000")or die(mysql_error());
	while($display_reports=mysql_fetch_array($sql)){
	?>
	<a href="../patients/report<?php echo $extension;?>?id=<?php echo $display_reports['id']?>"><li class="title">ID# <?php echo $display_reports['id']?></li><li class="symptoms"><?php echo substr($display_reports['symptoms'],0,80);?>...</li><li class="status"><?php if($display_reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_reports['signed_by']);?></span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']!=""){?><span class="e">(ENGAGED)</span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></li><li class="date"><?php echo display_time($display_reports['last_update']);?></li></a>
	<?php }?>
    </ul>
    <?php }?>
	<div class="details-clear">&nbsp;</div>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>