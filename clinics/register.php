<?php
	require_once "../includes/initiate.php";
	page_permission("add_branch");
	sns_header('Register New Clinic');
?>

<div id="branch-register" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-branches"><span class="inlineicon edit-mini">New Clinic</span></div>
<div class="panel-body">
<ol class="breadcrumb link-branches">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../clinics/">Clinics</a></li>
  <li class="active">Register</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$guardian="1";
	$name=friendly($_POST['name']);
	$address=friendly($_POST['address']);
	$location=friendly($_POST['location']);
	$contact=friendly($_POST['contact']);
	$type=$_POST['type'];
	
	$get_id=register_branch_profile($guardian,$name,$address,$location,$contact,$type);
	write_log("$_SESSION[id]","registered New Clinic Profile for $name ($get_id)","branch","50");
	
	echo"<div class='alert alert-success' role='alert'>New Profile has been registered. <strong>ID:</strong> $global_permission->guardian_short_name - $get_id </div>";
	echo"<a class='btn btn-default formbutton theme-branches' href=../clinics/>Clinics Directory</a>";

	}else{
?>
<form method="post" action="" enctype="multipart/form-data">	
	
	<div class="form-group"><label>Parent:</label><input class="form-control" name="name" value="<?php echo "$global_permission->guardian_name"?>" readonly="readonly" type="text" /></div>
	
	<div class="form-group"><label>Clinic Name:</label><input class="form-control" name="name" type="text" /></div>
	<div class="form-group"><label>Clinic Address:</label><input class="form-control" name="address" type="text" /></div>
	<div class="form-group"><label>Clinic City:</label><input class="form-control" name="location" type="text" /></label></div>
	<div class="form-group"><label>Clinic Contact:</label><input class="form-control" name="contact" type="text" /></label></div>
	<div class="form-group"><label>Clinic Rank:</label><select class="form-control" name='type'  id='gender' size='1' tabindex='1'>
            <option value='Branch'>New Clinic</option>
            <option value='Head Office'>Head Office</option></select></div>
	<input name="submit" class="btn btn-default formbutton theme-branches" type="submit" value="Register">
</form>

<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>