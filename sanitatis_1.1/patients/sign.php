<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("prescribe_patient");

	if(isset($_GET['id'])){$id=$_GET['id'];}

	$patient_id=report_info("patient",$id);
	$engaged_status=report_info("engaged_by",$id);
	$signed_status=report_info("signed_by",$id);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescribe the Patient</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">prescribe the patient</h1>
	<div class="patient-bottom-border"></div>

<div class="innertube">


	<?php 
		
		$get_composer_branch=staff_info("branch",report_info("composed_by",$id));
		
		if($engaged_status==""&&$signed_status==""){
		echo"<div class=alert><span class=alertIcon>This report is now engaged by you.</span></div>";
		}else if($engaged_status!=""&&$signed_status==""){
		$engaged_by=report_info("engaged_by",$id);
		$engaged_by_name= staff_info("full_name",$engaged_by);
		echo"<div class=alert><span class=alertIcon>This report is already engaged by $engaged_by_name but waiting for being signed.</span></div>";
		}else if($signed_status!=""){
		$signed_by_id=report_info("signed_by",$id);	
		$signed_by=staff_info("full_name",$signed_by_id);
		echo"<div class=ok><span class=tickIcon>Signed by $signed_by (ID# $signed_by_id).</span></div>";
		}else{
		echo"";
		}
		$engaged_by=engage_the_report($id);

	?>

	
	<ul id="details">
    <li class="title">Report ID:</li><li><?php echo $id;?></li>
    <li class="title">Charge:</li><li><?php echo "$global_permission->currency"?> <?php echo charge_mode(report_info("charge",$id));?></li>
    <?php if(report_info("fever",$id)!=""){?><li class="title">Fever:</li><li><?php echo report_info("fever",$id);?></li><?php }?>
    <?php if(report_info("blood_pressure",$id)!=""){?><li class="title">Blood Pressure:</li><li><?php echo report_info("blood_pressure",$id);?></li><?php }?>
    <?php if(report_attachment("exist",$id)==true){?><li class="title">Reports:</li><li><a href="../media/reports/<?php echo "$id"?>.zip">Download attachments</a> </li><li></li><?php }?>	
    <li class="title">Symptoms:</li><li><textarea><?php echo report_info("symptoms",$id);?></textarea></li>
	</ul>

	<ul id="details">
<?php
if(isset($_REQUEST['submit'])){
	

	$report_id=$id;
	$medicine=$_REQUEST['medicine'];
	$doses=$_REQUEST['doses'];
	$timings=$_REQUEST['timings'];
	$days=$_REQUEST['days'];
	$charging_for=$_REQUEST['charging_for'];
	$reply=friendly($_REQUEST['reply']);
	$notes=friendly($_REQUEST['notes']);
	$result=prescribe($report_id,$medicine,$doses,$timings,$days,$reply,$notes,$charging_for);
	
	if($result!=false){
		
		
	echo"<div class=ok><span class=tickIcon>Report has been successfully updated.</span></div>";	
		
	}else{
	echo"<div class=error><span class=errorIcon>Sorry, Not enough medicine available in the stock.</span></div>";
	
	}

}
?>
	<?php 
	$sql=mysql_query("select * from p_med_record where report_id='$id' order by last_update desc limit 9000")or die(mysql_error());
	while($list_med=mysql_fetch_array($sql)){
	?>
    <li class="title"><?php echo $list_med['medicine']?></li><li><?php echo $list_med['doses']?> (<?php echo $list_med['timings']?>) for <?php echo $list_med['days']?> day(s)</li>
    <?php } ?>
    </ul>
	<div class="details-clear">&nbsp;</div>

<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">
	<li class="title">Medicine:</li><li><select name='medicine'  id='medicine' size='1' tabindex='1'>
	<?php 
	$sql=mysql_query("select * from p_stock where branch='$get_composer_branch' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
	<option value='<?php echo $medicine_dir['code']?>'><?php echo $medicine_dir['code']?></option>
	<?php }?>
    </select></li>
    <li class="title">Doses:</li><li><select name='doses' id='doses' size='1'>
			<option value="1+0+0">1+0+0</option>
			<option value="1+1+0">1+1+0</option>
			<option value="1+1+1">1+1+1</option>
			<option value="0+1+0">0+1+0</option>
			<option value="1+0+1">1+0+1</option>
			<option value="0+1+1">0+1+1</option>
          </select></li><li>Morning+Evening+Night</li>
    <li class="title">Timings:</li><li><select name='timings' id='timings' size='1'>
			<option value="After Meal">After Meal</option>
			<option value="Before Meal">Before Meal</option>
          </select></li>
    <li class="title">Days:</li><li><select name='days' id='days' size='1'>
			<option value="0">please select</option>
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
          </select></li>
    <li class="title">Charging for Days?</li><li><select name='charging_for' id='charging_for' size='1'>
<?php if(report_info("charging_for",$id)!=""){;?>
			<option value="<?php echo report_info("charging_for",$id);?>"><?php echo report_info("charging_for",$id);?></option>
<?php }?>
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
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
			<option value="32">32</option>
			<option value="33">33</option>
			<option value="34">34</option>
			<option value="35">35</option>
			<option value="36">36</option>
			<option value="37">37</option>
			<option value="38">38</option>
			<option value="39">39</option>
			<option value="40">40</option>
			<option value="41">41</option>
			<option value="42">42</option>
			<option value="43">43</option>
			<option value="44">44</option>
			<option value="45">45</option>
			<option value="46">46</option>
			<option value="47">47</option>
			<option value="48">48</option>
			<option value="49">49</option>
			<option value="50">50</option>
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59">59</option>
			<option value="0">0</option>
          </select></li>	<div class="details-clear">&nbsp;</div>

         
	<li class="title">Reply to the Report:</li><li><textarea name="reply" id="reply" class="inputOne" cols="9" rows="4"><?php echo report_info("reply",$id);?></textarea></li><li><strong>&nbsp;</strong></li>
    <input type="hidden" name="notes" value="<?php echo report_info("notes",$id);?>"/>
    
    <input type="hidden" name="patient" value="<?php echo report_info("patient",$id);?>" class="inputOne" cols="9" rows="4"/>

    </ul>
    <div id="sysNotes"><?php echo report_info("notes",$id);?></div>
	<div id="page-clear" align="center"><input name="submit" class="formbutton patient" type="submit" value="update"></div>
</form>
<div id="page-clear" align="center"><div id="deleteButton"><a href="../desktop/">FINISH</a></div></div>
<h3>about the patient</h3>
<ul id="details">
    <li class="title">Patient:</li><li><a href="#" class="patient"><?php echo patient_info("name",$patient_id);?></a> | <?php echo patient_info("serial",$patient_id);?>-<?php echo patient_info("id",$patient_id);?></li>
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