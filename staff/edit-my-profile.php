<?php
	require_once "../includes/initiate.php";
	page_permission("my_porfile");
	sns_header('Edit Profile');
?>

<div id="staff-edit-my-porfile" class="container page">
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

	$title=$_POST['title'];
	$first_name=friendly($_POST['first_name']);
	$last_name=friendly($_POST['last_name']);
	$passkey=friendly($_POST['passkey']);
	$contact=friendly($_POST['contact']);
	$mobile=friendly($_POST['mobile']);
	$skype=friendly($_POST['skype']);
	$address=friendly($_POST['address']);

	$result=update_my_profile(staff_info('id'),$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address);
	
	if($result==true){
	echo"<div class='alert alert-success' role='alert'>Successfully Updated!</div>";
	write_log(staff_info("id"),"updated their profile","staff","30");
	
		$id = $_SESSION['id'];
		$uploaddir = '../uploads/staff/';
		$temp = explode(".", $_FILES["image"]["name"]);
		$uploadfile = $uploaddir . $id . "." . end($temp);
		if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {/* success */}


	}else{
	echo"<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";	
	echo"<input class='btn btn-default formbutton theme-staff' value='Try Again' onclick='window.history.back()'/>";
	}
	


}else{
?>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Title:</label><select class="form-control" name='title'  id='title' size='1' tabindex='1'>
            <option value='<?php echo staff_info("title",staff_info('id'));?>'><?php echo staff_info("title");?> (Current)</option>
            <option value='Dr.'>Dr.</option>
            <option value='Mr.'>Mr.</option>
            <option value='Miss.'>Miss.</option>
            <option value='Mrs.'>Mrs. </option>
    </select></div>
	<div class="form-group"><label>First Name:</label><input class="form-control" name="first_name" type="text" value="<?php echo staff_info("first_name");?>" /></div>
	<div class="form-group"><label>Last Name:</label><input class="form-control" name="last_name" type="text" value="<?php echo staff_info("last_name");?>" /></div>
	<div class="form-group"><label>New Password:</label><input class="form-control" name="passkey" type="text" /></div>
	<div class="form-group"><label>Contact Number:</label><input class="form-control" name="contact" type="text" value="<?php echo staff_info("contact");?>"  /></div>
	<div class="form-group"><label>Mobile Number:</label><input class="form-control" name="mobile" type="text" value="<?php echo staff_info("mobile");?>" /><i>Hidden from the staff with access level less than 4</i></div>
	<div class="form-group"><label>Skype:</label><input class="form-control" name="skype" type="text" value="<?php echo staff_info("skype");?>"  /></div>
	<div class="form-group"><label>Personal Address:</label><input class="form-control" name="address" type="text" value="<?php echo staff_info("address");?>" /><i>Hidden from the staff with access level less than 4</i></div>
    <div class="form-group"><label>Profile Photo:</label><input class="form-control" name="image" type="file" /></div> 
	<input name="submit" class="btn btn-default formbutton theme-staff" name="submit" class="formbutton staff" type="submit" value="Update">
</form>

<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>