<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";


	if($global_permission->auto_refresh!="never"){
	   header('Refresh: '.$global_permission->auto_refresh.'');
	}
	$denied=false;
	if(isset($_GET['denied'])){$denied=true;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Desktop</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">

<?php if($denied==true){?>
<div align="center" class="error"><span class="errorIcon">Sorry, you don’t have enough clearance to access that section.</span></div>
<?php }?>
<!---- searchMe ---->
<form method="get" action="../search/">
<div id="searchMe">
<input name="searchme" value="Search here..." onfocus="if (this.value == 'Search here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search here...';}"/>
</div>
</form>
<!---- #searchMe ---->
<ul id="desktop-widgets">

	<li class="full">
	<h1 class="patients patient-color">patients</h1>
	<div class="patient-bottom-border"></div>
    <div id="widgetupdates-frame-full">
    <ul id="widget-updates">
	<?php $pending_count=0;	
	if(display_permission("prescribe_patient")==true){?>
	<?php 
	$sql=mysql_query("select * from p_reports where signed_by='' and engaged_by='' order by last_update desc limit 5")or die(mysql_error());
	while($display_unsigned_reports=mysql_fetch_array($sql)){
	$pending_count++;	
	?>
    <li><a href="../patients/sign<?php echo $extension;?>?id=<?php echo $display_unsigned_reports['id']?>"><span class="staff"><?php echo staff_info("full_name",$display_unsigned_reports['composed_by']);?></span> composed a report for Patient <span class="patient"><strong><?php echo patient_info("name",$display_unsigned_reports['patient']);?></strong></span> at <strong><?php echo "$global_permission->guardian_short_name";?><?php echo staff_info("branch",$display_unsigned_reports['composed_by']);?></strong> - SYMPTOMS: <?php echo substr($display_unsigned_reports['symptoms'],0,45);?>… <span class="pending">(<strong>Pending</strong>)</span>  <span class="dim-date"><?php echo display_time($display_unsigned_reports['last_update']);?></span></a></li>
	<?php }?>
    <?php }else{?>
	<?php 
	$sql=mysql_query("select * from p_reports where signed_by=''and engaged_by='' order by last_update desc limit 5")or die(mysql_error());
	while($display_unsigned_reports=mysql_fetch_array($sql)){
	$pending_count++;	
	?>
    <li><span class="staff"><?php echo staff_info("full_name",$display_unsigned_reports['composed_by']);?></span> composed a report for Patient <span class="patient"><strong><?php echo patient_info("name",$display_unsigned_reports['patient']);?></strong></span> at <strong><?php echo "$global_permission->guardian_short_name";?><?php echo staff_info("branch",$display_unsigned_reports['composed_by']);?></strong> - SYMPTOMS: <?php echo substr($display_unsigned_reports['symptoms'],0,45);?>… <span class="pending">(<strong>Pending</strong>)</span>  <span class="dim-date"><?php echo display_time($display_unsigned_reports['last_update']);?></span></li>
	<?php }?>
	<?php }?>
    <?php if($pending_count==0){?><li>0 pending Reports - <a class="patient" href="../patients/recent<?php echo $extension;?>">click here for further details</a></li><?php }?>
    </ul>
    </div>
	<div class="widget-border">&nbsp;</div>
    	<ul id="buttons">
        <?php if(display_permission("register_patient")==true){?><a href="../patients/register<?php echo $extension;?>"><li class="add">register new patient</li></a><?php }?>
        <?php if(display_permission("patients_directory")==true){?><a href="../patients/patients-directory<?php echo $extension;?>"><li class="search">patients directory</li></a><?php }?>
        <a href="../patients/recent<?php echo $extension;?>"><li class="info">recently updated</li></a>
        <?php if(display_permission("pending_prescriptions")==true){?><a href="../patients/pending<?php echo $extension;?>"><li class="peding">pending reports (<?php echo count_pending();?>)</li></a><?php }?>
        </ul>
	</li>

	<li class="half">
    <h1 class="staff staff-color">staff</h1>
    <div class="staff-bottom-border"></div>
    <div id="widgetupdates-frame-half">
    <ul id="widget-updates">
 	<?php 
	$staff_alerts_count=0;
	if(display_permission("prescribe_patient")==true){
	$sql=mysql_query("select * from p_reports where signed_by!='' order by last_update desc limit 5")or die(mysql_error());
	while($display_signed_reports=mysql_fetch_array($sql)){
	$staff_alerts_count++;
	?>
    <li><a href="#"><span class="staff"><strong><?php echo staff_info("full_name",$display_signed_reports['signed_by']);?></strong></span> signed the report for Patient <span class="patient"><?php echo patient_info("name",$display_signed_reports['patient']);?></span></a></li>
	<?php }?>
    <?php }else{?>
 	<?php 
	$sql=mysql_query("select * from p_reports where signed_by!='' and composed_by='$_SESSION[id]' order by last_update desc limit 5")or die(mysql_error());
	while($display_signed_reports=mysql_fetch_array($sql)){
	$staff_alerts_count++;
	?>
    <li><a href="#"><span class="staff"><strong><?php echo staff_info("full_name",$display_signed_reports['signed_by']);?></strong></span> signed your report for Patient <span class="patient"><?php echo patient_info("name",$display_signed_reports['patient']);?></span></a></li>   
   	<?php }}?>
    <?php if($staff_alerts_count==0){?><li>No Staff alerts</li><?php }?>
    </ul>
    </div>
	<div class="widget-border">&nbsp;</div>
    	<ul id="buttons">
        <?php if(display_permission("add_staff")==true){?><a href="../staff/register<?php echo $extension;?>"><li class="add">add member</li></a><?php }?>
        <?php if(display_permission("staff_directory")==true){?><a href="../staff/staff-directory<?php echo $extension;?>"><li class="view">staff directory</li></a><?php }?>
        <?php if(display_permission("my_porfile")==true){?><a href="../staff/my-profile<?php echo $extension;?>"><li class="profile">my profile</li></a><?php }?>
        </ul>
    </li>
	
	<li class="half">
    <h1 class="branches branches-color">branches</h1>
    <div class="branches-bottom-border"></div>
    <div id="widgetupdates-frame-half">
    <ul id="widget-updates">
	<?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 6")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
    <li><span class="branch"><strong><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?></strong></span>  is working with its <span class="staff"><?php echo count_local_staff($branches_dir['id']);?> staff member(s)</span> and have <span class="patient"><?php echo count_local_registered($branches_dir['id']);?> enrolled patient(s)</span></li>
	<?php }?>
    </ul>
    </div>
	<div class="widget-border">&nbsp;</div>
    	<ul id="buttons">
        <?php if(display_permission("add_branch")==true){?><a href="../branches/register<?php echo $extension;?>"><li class="add">add branch</li></a><?php }?>
        <?php if(display_permission("branches_directory")==true){?><a href="../branches/branches-directory<?php echo $extension;?>"><li class="info">branches directory</li></a><?php }?>
        <?php if(display_permission("global_settings")==true){?><a href="../branches/global-settings<?php echo $extension;?>"><li class="settings">global settings</li></a><?php }?>
        </ul>
    </li>	
    
	<li class="full">
    <h1 class="medicine medicine-color">medicine</h1>
    <div class="medicine-bottom-border"></div>
		<div id="coulmn">
		    <div class="left">

    <div id="widgetupdates-frame-half">
    <ul id="widget-updates">
    <li><div class="right-align"><strong>consumed stock @ <span class="lowercase"><?php echo branch_info("name","$_SESSION[branch]");?></span></strong></div></li>
 	<?php 
	$alerts_count=0;
	$sql=mysql_query("select * from p_stock where branch='$_SESSION[branch]' order by remaining asc limit 5")or die(mysql_error());
	while($display_stock=mysql_fetch_array($sql)){
	$alerts_count++;
	?>
    <li>Stock for <strong><a class="medicine" href="#"><?php echo $display_stock['code']?></a></strong> is running with <i><strong><span class="red-low"><?php echo $display_stock['remaining']?> doses</span></strong></i> only</li>
	<?php }?>	
    <?php if($alerts_count==0){?><li>No Stock updates are available to display.</li><?php }?>
    </ul>
    </div>
            
            </div>
            
	    <div class="right">

    <div id="widgetupdates-frame-half">
    <ul id="widget-updates">
    <li><div class="right-align"><strong>recently updated stock @ <span class="lowercase"><?php echo branch_info("name","$_SESSION[branch]");?></span></strong></div></li>
 	<?php 
	$update_counts=0;
	$sql=mysql_query("select * from p_stock where branch='$_SESSION[branch]' order by last_update desc limit 5")or die(mysql_error());
	while($display_stock=mysql_fetch_array($sql)){
	$update_counts++;
	?>
    <li>Stock for <strong><a class="medicine" href="#"><?php echo $display_stock['code']?></a></strong> was updated with <i><strong><?php echo $display_stock['total']?> doses</strong></i> - <span class="dim-date"><?php echo display_time($display_stock['last_update']);?></span></li>    
	<?php }?>	
    <?php if($update_counts==0){?><li>Please contact your Head Office to assign you a Stock.</li><?php }?>
    </ul>    </div>
        
		</div>
	 </div>
	<div class="widget-border">&nbsp;</div>
    	<ul id="buttons">
        <?php if(display_permission("introduce_medicine")==true){?><a href="../medicine/introduce-medicine<?php echo $extension;?>"><li class="write">introduce new medicine</li></a><?php }?>
        <?php if(display_permission("update_stock")==true){?><a href="../medicine/update-stock<?php echo $extension;?>"><li class="stockupdate">update stock</li></a><?php }?>
        <?php if(display_permission("consumed_stock_local")==true){?><a href="../medicine/consumed-local-stock<?php echo $extension;?>"><li class="info">consumed stock (local)</li></a><?php }?>
        <?php if(display_permission("medicine_directory")==true){?><a href="../medicine/medicine-directory<?php echo $extension;?>"><li class="view">medicine directory</li></a><?php }?>
        </ul>    
    </li>
    





</ul>

</div>

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>