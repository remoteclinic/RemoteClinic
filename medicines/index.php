<?php
	require_once "../includes/initiate.php";
	page_permission("medicine_directory");	
	sns_header('Medicine Directory');
?>

<div id="medicine-directory" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-medicines"><span class="inlineicon medicine-mini">Medicine Directory</span></div>
<div class="panel-body">
<ol class="breadcrumb link-medicines">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li class="active">Medicine Directory</li>
</ol>

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class='alert alert-success' role='alert'>Successfully deleted!</div>
	<?php }?>


<?php if(display_permission("medicine_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Bottle' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $medicines['id']?>">
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $medicines['name']?></p>
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Bottle' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

<?php } ?>

    <hr/>

	<?php if(display_permission("medicine_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Tablets' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $medicines['id']?>">
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $medicines['name']?></p>
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

	<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Tablets' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

	<?php } ?>
    <hr/>
	<?php if(display_permission("medicine_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Syrup' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $medicines['id']?>">
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $medicines['name']?></p>
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

	<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_medicine_dir where category='Syrup' order by code asc limit 9000")or die(mysqli_error());
		while($medicines=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-medicines">
		  <div class="panel-heading _theme-medicines"><?php echo $medicines['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $medicines['category']?></strong> | <?php echo $medicines['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

	<?php } ?>
	<br><br>
</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>