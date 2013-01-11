<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("branches_directory");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Branches Directory</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="branches branches-color">branches directory</h1>
	<div class="branches-bottom-border"></div>
<div class="innertube">

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class="ok"><span class="tickIcon">Branch Profile has been deleted successfully...</span></div>
	<?php }?>
    

<ul id="listBracnhes">
	<?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 2000")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
<li><a href="profile<?php echo $extension;?>?id=<?php echo $branches_dir['id']?>">
<div class="branch_code"><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?></div>
<h1><?php echo substr($branches_dir['name'],0,30);?></h1>
<h2><span class="small_branch_icon"><?php echo substr($branches_dir['address'], 0,16);?>, <?php echo $branches_dir['location']?></span></h2>
<h2><span class="small_call_icon">Call: <?php echo $branches_dir['contact']?></span></h2>
<h2 class="right"><?php if($branches_dir['type']=="Head Office"){echo"<strong> (Head Office)</strong>";}else{ echo "&nbsp;";}?></h2>
</a></li>

<?php }?>
</ul>

	<div id="page-clear" align="center">&nbsp;</div>



</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>