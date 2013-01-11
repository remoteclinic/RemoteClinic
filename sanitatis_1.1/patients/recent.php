<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recently Updated</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">recently updated</h1>
	<div class="patient-bottom-border"></div>
<div class="innertube">
	<ul id="list_reports">
    <li class="title"><strong>ID</strong></li><li class="symptoms"><strong>Symptoms</strong></li><li class="status"><strong>Status</strong></li><li class="date"><strong>Date</strong></li>
	<?php 
	$sql=mysql_query("select * from p_reports  order by last_update desc limit 150")or die(mysql_error());
	while($display_reports=mysql_fetch_array($sql)){
	?>
	<a href="../patients/report<?php echo $extension;?>?id=<?php echo $display_reports['id']?>"><li class="title">ID# <?php echo $display_reports['id']?></li><li class="symptoms"><?php echo substr($display_reports['symptoms'],0,80);?>...</li><li class="status"><?php if($display_reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_reports['signed_by']);?></span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']!=""){?><span class="e">(ENGAGED)</span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></li><li class="date"><?php echo display_time($display_reports['last_update']);?></li></a>
	<?php }?>
    </ul>
	<div class="details-clear">&nbsp;</div>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>