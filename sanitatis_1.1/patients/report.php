<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";

	if(isset($_GET['id'])){$id=$_GET['id'];}

	$patient_id=report_info("patient",$id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Report</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">patient report</h1>
	<div class="patient-bottom-border"></div>
<div class="innertube">
	<?php 


		$patient_id=report_info("patient",$id);
		$engaged_status=report_info("engaged_by",$id);
		$signed_status=report_info("signed_by",$id);	
		
		$get_composer_branch=staff_info("branch",report_info("composed_by",$id));
		
		if($engaged_status==""&&$signed_status==""){
		echo"<div class=alert><span class=alertIcon>This report is now engaged by you.</span></div>";
		}else if($engaged_status!=""&&$signed_status==""){
		$engaged_by=report_info("engaged_by",$id);
		$engaged_by_name= staff_info("full_name",$engaged_by);
		echo"<div class=error><span class=errorIcon>This report was engaged by $engaged_by_name (ID# $engaged_by) but still not signed.</span></div>";
		}else if($signed_status!=""){
		$signed_by_id=report_info("signed_by",$id);	
		$signed_by=staff_info("full_name",$signed_by_id);
		echo"<div class=ok><span class=tickIcon>Signed by <a class='staff' href='../staff/profile$extension?id=$signed_by_id'>$signed_by</a> (ID# $signed_by_id).</span></div>";
		}else{
		echo"";
		}
		$engaged_by=engage_the_report($id);

	?>

	<ul id="details">
   <li class="title">Report ID:</li><li><?php echo $id;?></li>
    <li class="title">Last Update:</li><li><?php echo display_time(report_info("last_update",$id));?></li>
    <li class="title">Charged:</li><li><?php echo charge_mode(report_info("charge",$id));?> x <?php echo report_info("charging_for",$id);?> day(s) = <?php echo charge_mode(report_info("charge",$id))*report_info("charging_for",$id);?> <?php echo "$global_permission->currency"?></li>  

    <?php if(report_info("fever",$id)!=""){?><li class="title">Fever:</li><li><?php echo report_info("fever",$id);?></li><?php }?>
    <?php if(report_info("blood_pressure",$id)!=""){?><li class="title">Blood Pressure:</li><li><?php echo report_info("blood_pressure",$id);?></li><?php }?>
    <?php if(report_attachment("exist",$id)==true){?><li class="title">Reports:</li><li><a href="../media/reports/<?php echo "$id"?>.zip">Download attachments</a> </li><li></li><?php }?>	
    <li class="title">Symptoms:</li><li><textarea><?php echo report_info("symptoms",$id);?></textarea></li>	
   <?php if(report_info("notes",$id)!=""){;?><div id="sysNotes"><?php echo report_info("notes",$id);?></div><?php }?>
   <?php if(report_info("reply",$id)!=""){;?> <li class="title">Reply:</li><li><textarea><?php echo report_info("reply",$id);?></textarea></li><?php }?>	
	<?php 
	$sql=mysql_query("select * from p_med_record where report_id='$id' order by last_update desc limit 9000")or die(mysql_error());
	while($list_med=mysql_fetch_array($sql)){
	?>
    <li class="title"><?php echo $list_med['medicine']?></li><li><?php echo $list_med['doses']?> (<?php echo $list_med['timings']?>) for <?php echo $list_med['days']?> day(s)</li>
    <?php } ?>

    </ul>
	<?php if(display_permission("prescribe_patient")==true){;?>
    <div class="details-clear">&nbsp;</div>
    <div id="editButton"><a href="sign<?php echo "$extension";?>?id=<?php echo "$id";?>">EDIT THIS REPORT</a></div>
	<?php }?>
    <p>&nbsp;</p>
   
 
<ul id="details">
   <h3>about this patient</h3>
    <li class="title">Patient:</li><li><a href="../patients/profile<?php echo $extension;?>?id=<?php echo $patient_id;?>" class="patient"><?php echo patient_info("name",$patient_id);?></a> | <?php echo patient_info("serial",$patient_id);?>-<?php echo patient_info("id",$patient_id);?></li>
    <li class="title">Registered At:</li><li><?php echo $global_permission->guardian_short_name; echo patient_info("branch",$patient_id);?> - <?php echo branch_name(patient_info("branch",$patient_id));?></li>
    <li class="title">Registered By:</li><li><a class="staff" href="../staff/profile<?php echo $extension;?>?id=<?php echo patient_info("physician",$patient_id);?>"><?php echo staff_info("full_name",patient_info("physician",$patient_id));?></a></li>
    <li class="title">Last Update:</li><li><?php echo display_time(patient_info("last_update",$patient_id));?></li>
	</ul>
	<div class="details-clear">&nbsp;</div>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>