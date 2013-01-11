<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("my_porfile");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color">staff profile</h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">

<div class="profile_page_pic"><?php echo staff_img("$_SESSION[id]","128px");?></div>

	<ul id="details">
    <li class="title">Full Name:</li><li><a class="staff"><?php echo staff_info("full_name",$_SESSION['id']);?></a></li>
    <li class="title">Title:</li><li><?php echo staff_info("title",$_SESSION['id']);?></li>
    <li class="title">First Name:</li><li><?php echo staff_info("first_name",$_SESSION['id']);?></li>
    <li class="title">Last Name:</li><li><?php echo staff_info("last_name",$_SESSION['id']);?></li>
    <li class="title">Registration ID:</li><li><?php echo staff_info("id",$_SESSION['id']);?></li>
    <li class="title">Access Level:</li><li><?php echo staff_info("access_level",$_SESSION['id']);?></li>
    <li class="title">Network Rank:</li><li><?php echo access_level2rank(staff_info("access_level",$_SESSION['id']));?></li>
    <li class="title">Branch ID:</li><li><?php echo "$global_permission->guardian_short_name"; echo staff_info("branch",$_SESSION['id']);?></li>
    <li class="title">Designated Branch:</li><li><?php echo branch_name(staff_info("branch",$_SESSION['id']));?></li>
    <li class="title">User ID:</li><li><?php echo staff_info("userid",$_SESSION['id']);?></li>
    <li class="title">Password:</li><li>*******</li>
    <li class="title">Contact Number:</li><li><?php echo staff_info("contact",$_SESSION['id']);?></li>
    <li class="title">Mobile Number:</li><li><?php echo staff_info("mobile",$_SESSION['id']);?></li>
    <li class="title">Skype:</li><li><?php echo staff_info("skype",$_SESSION['id']);?></li>
    <li class="title">Personal Address:</li><li><?php echo staff_info("address",$_SESSION['id']);?></li>
    <li class="title">Last Activity:</li><li><?php echo last_update(1,"staff_info");?></li>
    <li class="title">Log:</li><li><?php echo no_of_actions($_SESSION['id']);?> activates so far.</li>
	</ul>
	<div class="details-clear">&nbsp;</div>
    <div id="editButton"><a href="edit-my-profile<?php echo "$extension";?>">edit profile</a></div>
	<div id="profileNotes"><?php echo staff_info("title",$_SESSION['id']); echo staff_info("first_name",$_SESSION['id']);?> was last seen on <?php echo "$global_permission->portal_name";?> at <?php echo last_update(1,"staff_info");?>. Their designated branch is <?php echo branch_name(staff_info("branch",$_SESSION['id']));?> and can be reached on their contact number <?php echo staff_info("contact",$_SESSION['id']);?>. According to the current record, <?php echo staff_info("last_name",$_SESSION['id']);?> has registered 10 patients so far and prescribed 0 of them.</div>
    <div id="widgetupdates-frame-full">
    <ul id="widget-updates">
    <li><strong>Your Recent Activities at <?php echo "$global_permission->portal_name";?>:</strong></li>
	<?php 
	$sql=mysql_query("select * from p_logs where user='$_SESSION[id]' order by id desc limit 5")or die(mysql_error());
	while($display_log=mysql_fetch_array($sql)){
	?>
    <li>You <?php echo $display_log['action']?> at <?php echo display_time("$display_log[at]");?>...</li>
    <?php }?>
    </ul>
	</div>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>