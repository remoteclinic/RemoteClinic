<?php
	require_once "../includes/initiate.php";
	page_permission("update_stock");
	sns_header('Update Stock');
	
?>

<div id="update-stock" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-medicines"><span class="inlineicon edit-mini">Update Stock</span></div>
<div class="panel-body">
<ol class="breadcrumb link-medicines">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../medicines/">Medicine Directory</a></li>
  <li class="active">Update Stock</li>
</ol>

<?php
if(isset($_POST['submit'])){

	$branch=$_POST['branch'];
	$code=$_POST['code'];
	$addidtion=friendly($_POST['addidtion']);
	$addidtion=preg_replace("/[^0-9\s]/", "", $addidtion);
	$branch_name=branch_info("name",$branch);
	if(update_stock($branch,$code,$addidtion)==true){
	echo"<div class='alert alert-success' role='alert'>Stock for $branch_name has been successfully updated with $addidtion dose(s) of $code!</div>";
	write_log("$_SESSION[id]","updated Stock for $branch_name with $addidtion doses of $code","stock","40");
	}else{
	echo"<div class='alert alert-danger' role='alert'>Something went wrong. Please try again!</div>";
	}

}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Branch:</label><select class="form-control" name='branch'  id='branch' size='1' tabindex='1'>
	<?php 
	$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000")or die(mysqli_error());
	while($clinics=mysqli_fetch_array($sql)){
	?>
    <option value='<?php echo $clinics['id']?>'><?php echo "$global_permission->guardian_short_name"; echo $clinics['id']?> - <?php echo $clinics['name']?></option>
	<?php }?>
    </select></div>

	<div class="form-group"><label>Medicine:</label><select class="form-control" name='code'  id='code' size='1' tabindex='1'>
	<?php 
	$sql=mysqli_query($con, "select * from p_medicine_dir order by last_update desc limit 9000")or die(mysqli_error());
	while($medicines=mysqli_fetch_array($sql)){
	?>
	<option value='<?php echo $medicines['code']?>'><?php echo $medicines['code']?> (<?php echo $medicines['name']?>)</option>
	<?php }?>
    </select></div>	
	
	<div class="form-group"><label>Dose(s):</label><input class="form-control" name="addidtion" type="text" maxlength="4" /></li>
	<input name="submit" class="btn btn-default formbutton theme-medicines" name="submit" class="formbutton medicine" type="submit" value="Update">
</form>    

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>