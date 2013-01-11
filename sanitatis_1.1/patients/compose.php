<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("register_patient");

	$success=false;

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['success'])){$success=true;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Compose a Report</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">composing patient report</h1>
	<div class="patient-bottom-border"></div>

<div class="innertube">
<?php


if(isset($_REQUEST['submit'])){
	

	$patient=$_REQUEST['patient'];
	$charge=$_REQUEST['charge'];
	$fever=friendly($_REQUEST['fever']);
	$blood_pressure=friendly($_REQUEST['blood_pressure']);
	$symptoms=friendly($_REQUEST['symptoms']);
	$result=compose_report($patient,$charge,$fever,$blood_pressure,$symptoms);
	
	if($result!=false){
		
		if(isset($_FILES["file"]["tmp_name"])&& $_FILES["file"]["tmp_name"]!="")			
			{
				$dest="../media/reports/$result".".zip";
				copy($_FILES["file"]["tmp_name"],$dest);
			}
	echo"<div class=ok><span class=tickIcon>Report has been successfully composed and pending for being signed.</span></div>";	
	
			if(display_permission("prescribe_patient")==true){
				echo"<div id=page-clear align=center><div id=editButton><a href=../patients/sign$extension?id=$result>sign this report</a></div></div>";
			}else{
				echo"<div id=page-clear align=center><div id=editButton><a href=../patients/register$extension?id=$id>register new patient</a></div></div>";
			}
	
	}else{
	echo"<div class=error><span class=errorIcon>Insufficient information. Please provide complete information...</span></div>";
	
	}

}else{
?>
	<?php if($success==true){?><div align="center" class="ok"><span class="tickIcon">Patient registered successfully. Please proceed and compose the patient report.</span></div> <?php }?>

	<ul id="details">
    <li class="title">Patient Name:</li><li><a href="#" class="patient"><?php echo patient_info("name",$id);?></a></li>
    <li class="title">Patient ID:</li><li><?php echo patient_info("serial",$id);?>-<?php echo patient_info("id",$id);?></li>
    <li class="title">Registered At:</li><li><?php echo $global_permission->guardian_short_name; echo patient_info("branch",$id);?> - <?php echo branch_name(patient_info("branch",$id));?></li>
    <li class="title">Registered By:</li><li><a class="staff" href="../staff/profile<?php echo $extension;?>?id=<?php echo patient_info("physician",$id);?>"><?php echo staff_info("full_name",patient_info("physician",$id));?></a></li>
    <li class="title">Last Update:</li><li><?php echo display_time(patient_info("last_update",$id));?></li>
	</ul>
	<div class="details-clear">&nbsp;</div>


<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">

	<li class="title">Charge Mode:</li><li><select name='charge' class="inputOne"  id='charge' size='1'>
				<option value="a">Charge Mode A - <?php echo "$global_permission->currency"?> <?php echo charge_mode("a");?></option>
				<option value="b">Charge Mode B - <?php echo "$global_permission->currency"?> <?php echo charge_mode("b");?></option>
				<option value="c">Charge Mode C - <?php echo "$global_permission->currency"?> <?php echo charge_mode("c");?></option>>
				<option value="d">Charge Mode D - <?php echo "$global_permission->currency"?> <?php echo charge_mode("d");?></option></select></li><li><strong>&nbsp;</strong></li>
	<li class="title">Fever:</li><li><input name="fever" type="text" /></li><li><strong>&deg;F</strong></li>
	<li class="title">Blood Pressure:</li><li><input name="blood_pressure" type="text" /></li><li>Systolic BP mmHg / Diastolic BP mmHg</li>
	<li class="title">Symptoms:</li><li><textarea name="symptoms" id="symptoms" class="inputOne" cols="9" rows="4"></textarea></li><li><strong>&nbsp;</strong></li>
	<li class="title">Upload Reports:</li><li><input class="file" name="file" type="file" /></li><li>*zipped files only</li>
	<div class="widget-border">&nbsp;</div>
    <input type="hidden" name="patient" value="<?php echo $id;?>"/>

    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton patient" type="submit" value="proceed"></div>
</form>
<?php }?>
</div>

</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>