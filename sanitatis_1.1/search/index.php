<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";

	if(isset($_GET['searchme'])){$query=$_GET['searchme'];}
	$count=0;
	$trimmed = trim($query);
	$trimmed_array = explode(" ",$trimmed)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search <?php echo "$global_permission->portal_name";?></title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="login_heading"><?php echo "$global_permission->portal_name";?><span>global search results...</span></h1>
	<div id="snfBstrip">&nbsp;</div>
<div class="innertube">

<?php foreach ($trimmed_array as $trimm){?>


<?php if(display_permission("staff_directory")==true){;?>
<ul id="staff-drecotry">
	<?php 
	$sql=mysql_query("select * from p_staff_dir where first_name like '%$trimm%' or last_name like '%$trimm%' or full_name like '%$trimm%' or id like '%$trimm%' limit 1000")or die(mysql_error());
	while($staff_dir=mysql_fetch_array($sql)){
	$count++;	
	?>
	<li><a href="../staff/profile<?php echo $extension;?>?id=<?php echo $staff_dir['id']?>">
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
<?php }?>

<?php if(display_permission("patients_directory")==true){;?>

<ul id="patients_directory">
	<?php 
	$sql=mysql_query("select * from p_patients_dir where name like '$query' or serial like '%$trimm%' or friendly_name like '%$trimm%' or id like '%$trimm%' or contact like '%$trimm%' or email like '%$trimm%' limit 1000")or die(mysql_error());
	while($patients_dir=mysql_fetch_array($sql)){
	$count++;	
	?>
	<li><a href="../patients/profile<?php echo $extension;?>?id=<?php echo $patients_dir['id']?>"><div class="upper"><?php echo $patients_dir['name']?></div><div class="branch"><?php echo "$global_permission->guardian_short_name"; echo $patients_dir['branch']?></div><div class="lower"><?php echo $patients_dir['serial']?>-<?php echo $patients_dir['id']?></div></a></li>
	<?php }?>
</ul>
<?php }?>

<?php if(display_permission("medicine_profile")==true){?>

	<?php 
	$sql=mysql_query("select * from p_medicine_dir where code like '%$trimm%' or name like '%$trimm%' or id like '%$trimm%' limit 1000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	$count++;	
	?>
    <ul id="med_stock">
    <li><a href="../medicine/medicine-profile<?php echo $extension?>?id=<?php echo $medicine_dir['id']?>">
    <div class="upper"><div class="left"><strong><?php echo $medicine_dir['category']?></strong> | Price: <?php echo $medicine_dir['price']?></div><div class="right">    
    </div>&nbsp;</div>
    <div class="lower"><div class="right"><strong><?php echo $medicine_dir['code']?></strong></div>&nbsp;</div>
	</a></li>
	</ul>
	<?php } ?>

	<?php } ?>

	<ul id="list_reports">
	<?php 
	$sql=mysql_query("select * from p_reports where id like '%$trimm%' or symptoms like '%$trimm%'  order by last_update desc limit 100")or die(mysql_error());
	while($display_reports=mysql_fetch_array($sql)){
	$count++;	
	?>
	<a href="../patients/report<?php echo $extension;?>?id=<?php echo $display_reports['id']?>"><li class="title">ID# <?php echo $display_reports['id']?></li><li class="symptoms"><?php echo substr($display_reports['symptoms'],0,80);?>...</li><li class="status"><?php if($display_reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$display_reports['signed_by']);?></span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']!=""){?><span class="e">(ENGAGED)</span><?php }?><?php if($display_reports['signed_by']==""&&$display_reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></li><li class="date"><?php echo display_time($display_reports['last_update']);?></li></a>
	<?php }?>
    </ul>


<?php } ?>
<h3><?php echo "$count";?> result(s) found</h3>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>