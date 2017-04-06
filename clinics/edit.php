<?php
	require_once "../includes/initiate.php";
	page_permission("add_branch");

	if(isset($_GET['id'])){$branch_id=$_GET['id'];}
	if(isset($_GET['delete'])){ branch_delete($branch_id); 	
	print "<script>";
	print "self.location='../clinics/?deleted';"; 
    print "</script>";
 	}
	sns_header('Update Clinic Profile');
?>

<div id="branch-edit-profile" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-branches"><span class="inlineicon edit-mini">Clinic Profile</span></div>
<div class="panel-body">
<ol class="breadcrumb link-branches">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../clinics/">Clinics</a></li>
  <li class="active">Profile</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$guardian="1";
	$id=$_POST['id'];
	$name=friendly($_POST['name']);
	$address=friendly($_POST['address']);
	$location=friendly($_POST['location']);
	$contact=friendly($_POST['contact']);
	$type=$_POST['type'];
	
	if(update_branch_profile($guardian,$id,$name,$address,$location,$contact,$type)==true){
	echo"<div class='alert alert-success' role='alert'>Profile for $name has been successfully updated!</div>";
	write_log(staff_info('id'),"updated Branch Profile for $name ($id)","branch","40");
	}else{
	echo"<div class='alert alert-danger' role='alert'>Something went wrong. Please try again!</div>";
	}	

}

?>
<form method="post" action="" enctype="multipart/form-data">

<?php $clinic=mysqli_fetch_object(mysqli_query($con, "select * from p_branches_dir where id='$branch_id' "));?>
	
	<div class="form-group"><label>Parent:</label><input class="form-control" name="guardian" readonly="readonly" value="<?php echo "$global_permission->guardian_name"?>"" type="text" />readonly</div>
	<div class="form-group"><label>Child ID:</label><input class="form-control" name="id" value="<?php echo "$global_permission->guardian_short_name"?><?php echo "$clinic->id";?>" readonly="readonly" type="text" />readonly</div>
	
	<div class="form-group"><label>Clinic Name:</label><input class="form-control" name="name" id="name" type="text" value="<?php echo "$clinic->name";?>" maxlength="30"/></div>
	<div class="form-group"><label>Clinic Address:</label><input class="form-control" name="address" id="address" type="text" value="<?php echo "$clinic->address";?>" maxlength="50" /></div>
	<div class="form-group"><label>Clinic City:</label><input class="form-control" name="location" id="location" type="text"  value="<?php echo "$clinic->location";?>" maxlength="30"/></div>
	<div class="form-group"><label>Clinic Contact:</label><input class="form-control" name="contact" id="contact" type="text"  value="<?php echo "$clinic->contact";?>" maxlength="20"/></div>
	<div class="form-group"><label>Clinic Rank:</label><select class="form-control" name='type'  name="type" id='type' size='1' tabindex='1'>
            <option value='<?php echo "$clinic->type";?>'><?php echo "$clinic->type";?> (Current)</option>
            <option value='Branch'>Clinic</option>
            <option value='Head Office'>Head Office</option></select></div>
            <input type="hidden" name="id" id="id" value="<?php echo "$clinic->id";?>"/>
			<input name="submit" class="btn btn-default formbutton theme-branches" type="submit" value="Update">
</form>
	<div id="page-clear" align="center"><div id="deleteButton"><a class="delete-me" href="edit.php?id=<?php echo "$branch_id";?>&delete">Delete Profile</a></div></div>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>