<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("staff_directory");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Directory</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color">staff directory</h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">
	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class="ok"><span class="tickIcon">Staff Profile has been deleted successfully...</span></div>
	<?php }?>
    
<?php if(display_permission("staff_profile")==true){?>
<h3 class="lowercase">Staff with <?php echo access_level2rank(5);?> rank</h3>
<?php echo date("F j, Y, g:i a");?>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='5' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li><a href="profile<?php echo $extension;?>?id=<?php echo $staff_dir['id']?>">
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</a></li>

	<?php }?>
</ul>
<hr/>
<h3 class="lowercase">Staff with <?php echo access_level2rank(4);?> rank</h3>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='4' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li><a href="profile<?php echo $extension;?>?id=<?php echo $staff_dir['id']?>">
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</a></li>

	<?php }?>
</ul>
<hr/>
<h3 class="lowercase">Staff with <?php echo access_level2rank(3);?> rank</h3>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='3' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li><a href="profile<?php echo $extension;?>?id=<?php echo $staff_dir['id']?>">
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</a></li>

	<?php }?>
</ul>
<?php }else{?>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='5' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li>
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</li>

	<?php }?>
</ul>
<hr/>
<h3 class="lowercase">Staff with <?php echo access_level2rank(4);?> rank</h3>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='4' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li>
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</li>

	<?php }?>
</ul>
<hr/>
<h3 class="lowercase">Staff with <?php echo access_level2rank(3);?> rank</h3>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where access_level='3' order by first_name asc limit 2000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	?>
	<li>
	<h1><?php echo $staff_dir['full_name']?></h1>
	<div class="left">
	<h2><span class="small_id_icon">ID# <?php echo $staff_dir['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff_dir['branch']?></span><br/><span class="small_branch_icon"><?php echo $staff_dir['address']?></span></h2>
	<h2><span class="small_call_icon">Call: <?php echo $staff_dir['contact']?></span></h2>
	<h2><span class="small_im_icon">SKYPE: <?php echo $staff_dir['skype']?></span></h2>
	</div>
	<div class="right">
	<?php echo staff_img("$staff_dir[id]","80px");?>
	</div>
	<div id="sd-id"><?php echo $staff_dir['access_level']?></div>
	</li>

	<?php }?>
</ul>

<?php }?>
	<div class="details-clear">&nbsp;</div>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>