<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("medicine_profile");	

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['delete'])){ medicine_delete($id); 	
	print "<script>";
	print "self.location='../medicine/medicine-directory$extension?deleted';"; 
    print "</script>";
 	}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Medicine Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="medicine medicine-color">medicine profile</h1>
	<div class="medicine-bottom-border"></div>
<div class="innertube">
<?php $profile=mysql_fetch_object(mysql_query("select * from p_medicine_dir where id='$id' "));?>

	<ul id="details">
    <li class="title">Database ID:</li><li><?php echo $profile->id;?></li>
    <li class="title">Medicine Code:</li><li><?php echo $profile->code;?></li>
    <li class="title">Category:</li><li><?php echo $profile->category;?></li>
    <li class="title">Name:</li><li><?php echo $profile->name;?></li>
    <li class="title">Price:</li><li><?php echo $profile->price;?></li>
	<?php 
	$count=0;
	$medicine_code=$profile->code;
	$sql=mysql_query("select * from p_med_record where medicine='$medicine_code' order by last_update desc limit 100")or die(mysql_error());
	while($list_med=mysql_fetch_array($sql)){
	$count=$list_med['total'];
	?>
    <?php } ?>
    <li class="title">Prescribed:</li><li><?php echo $count;?> time(s)</li>
    <li class="title">Estimate Sales:</li><li><?php echo $count;?>*<?php echo $profile->price;?> = <?php echo $profile->price*$count; ?></li>

	</ul>


	<div class="details-clear">&nbsp;</div>
	<div id="editButton"><a href="edit-medicine<?php echo $extension;?>?id=<?php echo $profile->id;?>&delete=1">edit profile</a></div>

<div id="page-clear" align="center"><div id="deleteButton"><a href="?id=<?php echo $profile->id;?>&delete=1">delete medicine</a></div></div>


</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>