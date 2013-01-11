<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("staff_profile");

	if(isset($_GET['id'])){$id=$_GET['id'];
	}else{
	$id=$_SESSION['id'];
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color">staff profile</h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">

<?php $profile=mysql_fetch_object(mysql_query("select * from p_staff_dir where id='$id' "));?>
<div class="profile_page_pic"><?php echo staff_img("$profile->id","128px");?></div>

	<ul id="details">
    <li class="title">Full Name:</li><li><a class="staff"><?php echo $profile->full_name;?></a></li>
    <li class="title">Title:</li><li><?php echo $profile->title;?></li>
    <li class="title">First Name:</li><li><?php echo $profile->first_name;?></li>
    <li class="title">Last Name:</li><li><?php echo $profile->last_name;?></li>
    <li class="title">Registration ID:</li><li><?php echo $profile->id;?></li>
    <li class="title">Access Level:</li><li><?php echo $profile->access_level;?></li>
    <li class="title">Network Rank:</li><li><?php echo access_level2rank($profile->access_level);?></li>
    <li class="title">Branch ID:</li><li><?php echo "$global_permission->guardian_short_name"; echo $profile->branch;?></li>
    <li class="title">Designated Branch:</li><li><?php echo branch_name($profile->branch);?></li>
    <li class="title">User ID:</li><li><?php echo $profile->userid;?></li>
    <li class="title">Contact Number:</li><li><?php echo $profile->contact;?></li>
    <?php if(display_permission("mobile_number")==true){?><li class="title">Mobile Number:</li><li><?php echo $profile->mobile;?></li><?php }?>
    <li class="title">Skype:</li><li><?php echo $profile->skype;?></li>
    <?php if(display_permission("address")==true){?><li class="title">Personal Address:</li><li><?php echo $profile->address;?></li><?php }?>
    <li class="title">Last Activity:</li><li><?php echo display_time($profile->last_update);?></li>
    <li class="title">Log:</li><li><?php echo no_of_actions($profile->id);?> activates so far.</li>
    <li class="title">Registered by:</li><li><a class="staff" href="profile<?php echo $extension;?>?id=<?php echo staff_info("registered_by",$profile->id);?>"><?php echo staff_info("full_name",staff_info("registered_by",$profile->id));?></a></li>
	</ul>
	<div class="details-clear">&nbsp;</div>
    
	<?php if(display_permission("add_staff")==true){?>
    <div id="editButton"><a href="edit-profile<?php echo "$extension";?>?id=<?php echo "$id";?>">edit profile</a></div>
    <?php }?>

	<div id="profileNotes"><?php echo staff_info("title",$profile->id); echo staff_info("first_name",$profile->id);?> was last seen on <?php echo "$global_permission->portal_name";?> at <?php echo last_update($profile->id,"staff_info");?>. Their designated branch is <?php echo branch_name(staff_info("branch",$profile->id));?> and can be reached on their contact number <?php echo staff_info("contact",$profile->id);?>. According to the current record, <?php echo staff_info("last_name",$profile->id);?> has registered <?php echo count_reg_patients_staff("$profile->id");?> patient(s) so far and prescribed <?php echo count_signed_reports_staff("$profile->id");?> of them.</div>
    <div id="widgetupdates-frame-full">
    <ul id="widget-updates">
    <li><strong>Recent Activities by <?php echo staff_info("title",$profile->id); echo staff_info("first_name",$profile->id);?> at <?php echo "$global_permission->portal_name";?>:</strong></li>
	<?php 
	$sql=mysql_query("select * from p_logs where user='$profile->id' order by id desc limit 5")or die(mysql_error());
	while($display_log=mysql_fetch_array($sql)){
	?>
    <li>They <?php echo $display_log['action']?> at <?php echo display_time("$display_log[at]");?>...</li>
    <?php }?>
    </ul>
	</div>
    <div id="editButton"><a href="staff-log<?php echo "$extension";?>?id=<?php echo "$id";?>">view log</a></div>
	
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>