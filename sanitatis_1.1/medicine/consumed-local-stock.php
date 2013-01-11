<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("consumed_stock_local");

	if(isset($_GET['id'])){$id=$_GET['id'];
	}else{
	$id=$_SESSION['branch'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consumed Stock (Local)</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="medicine medicine-color">consumed stock (local)</h1>
	<div class="medicine-bottom-border"></div>
<div class="innertube">
	<h3 class="lowercase">stock left for <?php echo branch_info("name","$id");?></h3>
	<ul id="med_stock">
	<?php 
	$sql=mysql_query("select * from p_stock where branch='$id' order by code asc limit 20000")or die(mysql_error());
	while($stock_local=mysql_fetch_array($sql)){
	?>
    <li>
    <div class="upper"><div class="left"><?php echo $stock_local['remaining']?><span>/<?php echo $stock_local['total']?></span></div><div class="right">
    <div id="medPower"><div id="powerBar"><div id="consumedPower" style="width:<?php echo percentage("$stock_local[remaining]","$stock_local[total]")?>%">&nbsp;</div></div></div>
    </div>&nbsp;</div>
    <div class="lower"><div class="left"><?php echo display_time($stock_local['last_update']);?></div><div class="right"><strong><?php echo $stock_local['code']?></strong></div>&nbsp;</div>
    </li>
	<?php }?>

    </ul>&nbsp;
<?php if(display_permission("consumed_stock_global")==true){?>
    <h3>display stock for:</h3>
   	<ul id="buttons">
    <?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 2000")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
    <a href="?id=<?php echo $branches_dir['id'];?>"><li class="info"><?php echo substr($branches_dir['name'],0,30);?></li></a>
    <?php }?>
	</ul>    
    <hr/>
<?php }?>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>