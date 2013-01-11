<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("medicine_directory");	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Medicine Directory</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="medicine medicine-color">medicine directory</h1>
	<div class="medicine-bottom-border"></div>
<div class="innertube">
	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class="ok"><span class="tickIcon">Medicie <?php echo $deleted;?> has been removed successfully...</span></div>
	<?php }?>
    <ul id="med_stock">
<?php if(display_permission("medicine_profile")==true){?>

	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Bottle' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li><a href="medicine-profile<?php echo $extension?>?id=<?php echo $medicine_dir['id']?>">
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</a></li>
	<?php } ?>

<?php }else{ ?>

	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Bottle' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li>
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</li>
	<?php } ?>


<?php } ?>
    </ul>&nbsp;
    <hr/>

    <ul id="med_stock">
	<?php if(display_permission("medicine_profile")==true){?>
	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Tablets' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li><a href="medicine-profile<?php echo $extension?>?id=<?php echo $medicine_dir['id']?>">
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</a></li>
	<?php } ?>
	<?php }else{ ?>

	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Tablets' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li>
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</li>
	<?php } ?>

	<?php } ?>
    </ul>&nbsp;
    <hr/>
    <ul id="med_stock">
	<?php if(display_permission("medicine_profile")==true){?>
	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Syrup' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li><a href="medicine-profile<?php echo $extension?>?id=<?php echo $medicine_dir['id']?>">
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</a></li>
	<?php } ?>
	<?php }else{ ?>
	<?php 
	$sql=mysql_query("select * from p_medicine_dir where category='Syrup' order by code asc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
    <li>
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</li>
	<?php } ?>
	<?php } ?>
    </ul>&nbsp;        
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>