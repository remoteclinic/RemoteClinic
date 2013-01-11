<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("patients_directory");
	if(isset($_GET['start'])){$start=$_GET['start'];}else{$start=0;}

	$limit=100;

	$total_items=mysql_query("select * from p_patients_dir ");
	$total_items=mysql_num_rows($total_items);
		 




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patients Directory</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">patients directory</h1>
	<div class="patient-bottom-border"></div>
<div class="innertube">
	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class="ok"><span class="tickIcon">Patient's record has been removed successfully...</span></div>
	<?php }?>



<h4 align="right">Total: <?php echo $total_items;?> patients  <?php if($start!=0){?> <a href="?start=<?php echo $start-$limit; ?>">previous page</a>  <?php }?><?php if($total_items>=$start+$limit){?><a href="?start=<?php echo $start+$limit; ?>">next page</a><?php }?></h4>
<ul id="patients_directory">
	<?php 
	$sql=mysql_query("select * from p_patients_dir order by id asc limit $start, $limit")or die(mysql_error());
	while($patients_dir=mysql_fetch_array($sql)){
	?>
	<li><a href="profile<?php echo "$extension";?>?id=<?php echo $patients_dir['id']?>"><div class="upper"><?php echo $patients_dir['name']?></div><div class="branch"><?php echo "$global_permission->guardian_short_name"; echo $patients_dir['branch']?></div><div class="lower"><?php echo $patients_dir['serial']?>-<?php echo $patients_dir['id']?></div></a></li>
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