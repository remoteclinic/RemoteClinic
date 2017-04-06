<?php
	require_once "../includes/initiate.php";
	page_permission("add_staff");

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['delete'])){ staff_delete($id); 	
		print "<script>";
		print "self.location='../staff/?deleted';"; 
	    print "</script>";
 	}
	
	sns_header('Edit Profile');
?>

<div id="staff-edit-profile" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-staff"><span class="inlineicon edit-mini">Edit Profile</span></div>
<div class="panel-body">
<ol class="breadcrumb link-staff">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../staff/">Staff Members</a></li>
  <li class="active">Edit Profile</li>
</ol>

<?php

if(isset($_POST['submit'])){
	
	$id=$_POST['id'];
	$title=$_POST['title'];
	$first_name=friendly($_POST['first_name']);
	$last_name=friendly($_POST['last_name']);
	$passkey=friendly($_POST['passkey']);
	$contact=friendly($_POST['contact']);
	$mobile=friendly($_POST['mobile']);
	$skype=friendly($_POST['skype']);
	$address=friendly($_POST['address']);
	$access_level=friendly($_POST['access_level']);
	$status=friendly($_POST['status']);
	$branch=friendly($_POST['branch']);

	$result=update_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address,$access_level,$status,$branch);
	$name_of_person=staff_info("full_name",$id);
	if($result==true){
	echo"<div class='alert alert-success' role='alert'>Profile successfully updated!</div>";
	write_log("$_SESSION[id]","updated profile for $name_of_person","staff","40");
	
		if(isset($_FILES["image"]["tmp_name"])&& $_FILES["image"]["tmp_name"]!=""){
			$dest="../media/staff/$id".".png";
			copy($_FILES["image"]["tmp_name"],$dest);
		}

	
	}else{
	echo"<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";	
	echo"<input class='btn btn-default formbutton theme-staff' value='Try Again' onclick='window.history.back()'/>";
	}


}else{
?>
<?php $profile=mysqli_fetch_object(mysqli_query($con, "select * from p_staff_dir where id='$id' "));?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo "$profile->id";?>"/>
	<div class="form-group"><label>Title:</label><select class="form-control" name='title'  id='title' size='1' tabindex='1'>
            <option value='<?php echo "$profile->title";?>'><?php echo "$profile->title";?> (Current)</option>
            <option value='Dr.'>Dr.</option>
            <option value='Mr.'>Mr.</option>
            <option value='Miss.'>Miss.</option>
            <option value='Mrs.'>Mrs. </option>
            <option value='Nurse.'>Nurse. </option>
    </select></div>
	<div class="form-group"><label>First Name:</label><input class="form-control" name="first_name" type="text" value="<?php echo "$profile->first_name";?>" /></div>
	<div class="form-group"><label>Last Name:</label><input class="form-control" name="last_name" type="text" value="<?php echo "$profile->last_name";?>" /></div>
	<div class="form-group"><label>New Password:</label><input class="form-control" name="passkey" type="text" /></div>
	<div class="form-group"><label>Contact Number:</label><input class="form-control" name="contact" type="text" value="<?php echo "$profile->contact";?>"  /></div>
	<div class="form-group"><label>Mobile Number:</label><input class="form-control" name="mobile" type="text" value="<?php echo "$profile->contact";?>" /><i>Hidden from the staff with access level less than 4</i></div>
	<div class="form-group"><label>Chat:</label><input class="form-control" class="form-control" name="skype" type="text" value="<?php echo "$profile->skype";?>"  /></div>
	<div class="form-group"><label>Personal Address:</label><input class="form-control" name="address" type="text" value="<?php echo "$profile->address";?>" /><i>Hidden from the staff with access level less than 4</i></div>
	<div class="form-group"><label>Access Level:</label><select class="form-control" name='access_level'  id='access_level' size='1' tabindex='1'>
            <option value='<?php echo "$profile->access_level";?>'><?php echo "$profile->access_level";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(1);?></option>
            <option value='2'>2 - <?php echo access_level2rank(2);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select></div>
	<div class="form-group"><label>Status:</label><select class="form-control" name='status'  id='status' size='1' tabindex='1'>
            <option value='<?php echo "$profile->status";?>'><?php echo "$profile->status";?> (Current)</option>
            <option value='active'>active</option>
            <option value='blocked'>blocked</option>

    </select></div>    
	<div class="form-group"><label>Branch:</label>
	<select class="form-control" name='branch'  id='branch' size='1' tabindex='1'>
	<option value='<?php echo "$profile->branch";?>'><?php echo "$global_permission->guardian_short_name";?><?php echo "$profile->branch";?> (Current)</option>
	<?php 
	$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000")or die(mysqli_error());
	while($branches_dir=mysqli_fetch_array($sql)){
	?>
    <option value='<?php echo $branches_dir['id']?>'><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?> - <?php echo $branches_dir['name']?></option>
	<?php }?>
    </select>
    <br>
    <div class="form-group"><label>Profile Photo:</label><input class="form-control" name="image" type="file" /></div> 
	<input name="submit" class="btn btn-default formbutton theme-staff" type="submit" value="Update">
</form>

<br>
<div id="page-clear" align="center"><div id="deleteButton"><a class="delete-me" href="edit.php?id=<?php echo "$profile->id";?>&delete">Delete Profile</a></div></div>

<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>