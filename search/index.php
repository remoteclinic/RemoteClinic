<?php
	require_once "../includes/initiate.php";

	if(isset($_GET['searchme'])){$query=$_GET['searchme'];}
	$count=0;
	$trimmed = trim($query);
	$trimmed_array = explode(" ",$trimmed);
	sns_header('Search');
?>
<div id="search" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-portal"><span class="inlineicon search-mini">Search</span></div>
<div class="panel-body">
<ol class="breadcrumb link-portal">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li class="active">Seach</li>
</ol>
<?php foreach ($trimmed_array as $trimm){?>


<?php if(display_permission("staff_directory")==true && $query!=""){;?>
	<div class="row">

	<?php 
	$sql=mysqli_query($con, "select * from p_staff_dir where first_name like '%$trimm%' or last_name like '%$trimm%' or full_name like '%$trimm%' or id like '%$trimm%' limit 1000")or die(mysqli_error());
	while($staff=mysqli_fetch_array($sql)){
	$count++;	
	?>
	<a class="nohover" href="../staff/profile<?php echo $extension;?>?id=<?php echo $staff['id']?>">
	<div class="panel panel-default profile-card profile-branch">
	  <div class="panel-heading _theme-staff"><?php echo $staff['full_name']?></div>
  	<div class="panel-body">
	<div class="pull-right"><?php echo staff_img("$staff[id]","80px");?></div>
	<p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID# <?php echo $staff['id']?> — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name"; echo $staff['branch']?></span></p>
	<p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address']?></p>
	<p><i class="glyphicon glyphicon-earphone"></i>Call: <?php echo $staff['contact']?></p>
	<p><i class="glyphicon glyphicon-facetime-video"></i>SKYPE: <?php echo $staff['skype']?></p>
	</div></div>
	</a>
	<?php }?>

	</div>
<?php }?>

<?php if(display_permission("patients_directory")==true && $query!=""){;?>
	<div class="row">
	<ul class="list-group row ul-patients">
	<?php 
	$sql=mysqli_query($con, "select * from p_patients_dir where name like '$query' or serial like '%$trimm%' or friendly_name like '%$trimm%' or id like '%$trimm%' or contact like '%$trimm%' or email like '%$trimm%' limit 1000")or die(mysqli_error());
	while($patients=mysqli_fetch_array($sql)){
	$count++;	
	?>
	<a href="../patients/profile<?php echo "$extension";?>?id=<?php echo $patients['id']?>"><li class="list-group-item col-md-2">		
		<span class="branchspan"><?php echo $patients['serial']?></span><br>
		<span class="namespan"><?php echo $patients['name']?> (<?php echo substr($patients['gender'], 0, 1);?>)</span>
	</li></a>

	<?php }?>
	</ul>
	</div>
<?php }?>

<?php if(display_permission("medicine_profile")==true && $query!=""){?>
	<div class="row">

	<?php 
	$sql=mysqli_query($con, "select * from p_medicine_dir where code like '%$trimm%' or name like '%$trimm%' or id like '%$trimm%' limit 1000")or die(mysqli_error());
	while($medicines=mysqli_fetch_array($sql)){
	$count++;	
	?>
	<div class="panel panel-default profile-card profile-medicines">
	  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
	  <div class="panel-body">
	  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
	  </div>
	</div>
	<?php } ?>

	</div>
	<?php } ?>

	<div class="row">
    <table class="table table-striped link-patients link-patients"><tbody>
	<?php
	if($query!=""){
	$sql=mysqli_query($con, "select * from p_reports where id like '%$trimm%' or symptoms like '%$trimm%'  order by last_update desc limit 100")or die(mysqli_error());
	while($reports=mysqli_fetch_array($sql)){
	$count++;	
	?>
	<tr><td><?php echo $reports['id']?></td><td width="65%" class="symptoms"><a href="../patients/report<?php echo $extension;?>?id=<?php echo $reports['id']?>"><?php echo substr($reports['symptoms'],0,80);?>...</a></td><td class="status"><?php if($reports['signed_by']!=""){?><span class="s"><?php echo staff_info("full_name",$reports['signed_by']);?></span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']!=""){?><span class="e">(ENGAGED)</span><?php }?><?php if($reports['signed_by']==""&&$reports['engaged_by']==""){?><span class="p">(PENDING)</span><?php }?></td><td class="date"><?php echo display_time($reports['last_update']);?></td></tr>
	<?php }}?>
	</tbody></table>


<?php } ?>
<br><h4><?php echo "$count";?> Result(s) were found!</h4><br>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->
<?php sns_footer();?>