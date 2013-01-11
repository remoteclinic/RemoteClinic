<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("branches_directory");

	if(isset($_GET['id'])){$branch_id=$_GET['id'];}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Branch Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="branches branches-color">branch profile</h1>
	<div class="branches-bottom-border"></div>
<div class="innertube">
	<ul id="details">
<?php $profile=mysql_fetch_object(mysql_query("select * from p_branches_dir where id='$branch_id' "));?>
    <li class="title">Guardian:</li><li><?php echo "$global_permission->guardian_name"?></li>
    <li class="title">Branch ID:</li><li><?php echo "$global_permission->guardian_short_name"?>-<?php echo "$profile->id";?></li>
    <li class="title">Branch Name:</li><li><?php echo "$profile->name";?> (<?php echo "$profile->type";?>)</li>
    <li class="title">Address:</li><li><?php echo "$profile->address";?></li>
    <li class="title">Location:</li><li><?php echo "$profile->location";?></li>
    <li class="title">Contact:</li><li><?php echo "$profile->contact";?></li>
    <li class="title">Last Update:</li><li><?php echo display_time("$profile->last_update");?></li>
    <li class="title">Today:</li><li><?php echo count_today_patients($branch_id);?> patient(s) were registered</li>
    <li class="title"></li><li><?php echo count_today_reports($branch_id);?> report(s) were composed</li>
    <li class="title"></li><li><h3><strong><?php echo "$global_permission->currency"?> <?php echo count_today_sales($branch_id);?> of estimated sales</strong></h3></li>
    <li class="title"></li><li><?php echo count_reports_charge_mode("a",$branch_id);?> patient(s) were charged with <?php echo "$global_permission->currency"?> <?php echo charge_mode("a");?></li>
    <li class="title"></li><li><?php echo count_reports_charge_mode("b",$branch_id);?> patient(s) were charged with <?php echo "$global_permission->currency"?> <?php echo charge_mode("b");?></li>
    <li class="title"></li><li><?php echo count_reports_charge_mode("c",$branch_id);?> patient(s) were charged with <?php echo "$global_permission->currency"?> <?php echo charge_mode("c");?></li>
    <li class="title"></li><li><?php echo count_reports_charge_mode("d",$branch_id);?> patient(s) were charged with <?php echo "$global_permission->currency"?> <?php echo charge_mode("d");?></li>
    </ul>
<div id="page-clear" align="center">
<?php if(display_permission("add_branch")==true){?>
<div id="editButton"><a href="edit-profile<?php echo "$extension";?>?id=<?php echo "$profile->id";?>">edit profile</a></div>
<?php } ?>
</div> 
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>