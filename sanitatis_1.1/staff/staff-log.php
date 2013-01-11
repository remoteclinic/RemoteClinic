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
<title>Staff Log</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color lowercase">staff activates at <?php echo "$global_permission->portal_name";?></h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">


	<ul id="details">
    <h3 class="lowercase">displaying recent activates for <?php echo staff_info("full_name",$id);?></h3>
	<?php 
	$sql=mysql_query("select * from p_logs where user='$id' order by id desc limit 1000")or die(mysql_error());
	while($display_log=mysql_fetch_array($sql)){
	?>
    <li class="title"><?php echo display_time($display_log['at']);?></li><li><span class="priority_<?php echo priority_level($display_log['priority']);?>"><?php echo $display_log['action']?></span></li>
	<div class="thin_border">&nbsp;</div>
	<?php }?>
	</ul>
	<div class="details-clear">&nbsp;</div>
    <div id="editButton"><a href="profile<?php echo "$extension";?>?id=<?php echo "$id";?>">profile</a></div>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>