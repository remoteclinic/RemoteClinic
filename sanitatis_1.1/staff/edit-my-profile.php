<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("my_porfile");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Your Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color">edit your profile</h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">
<?php

if(isset($_REQUEST['submit'])){
	

	$title=$_REQUEST['title'];
	$first_name=friendly($_REQUEST['first_name']);
	$last_name=friendly($_REQUEST['last_name']);
	$passkey=friendly($_REQUEST['passkey']);
	$contact=friendly($_REQUEST['contact']);
	$mobile=friendly($_REQUEST['mobile']);
	$skype=friendly($_REQUEST['skype']);
	$address=friendly($_REQUEST['address']);

	$result=update_my_profile($_SESSION['id'],$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address);
	
	if($result==true){
	echo"<div class=ok><span class=tickIcon>Profile updated successfully.</span></div>";
	write_log("$_SESSION[id]","updated their profile","staff","30");
	
	if(isset($_FILES["image"]["tmp_name"])&& $_FILES["image"]["tmp_name"]!="")			
		{
			$dest="../media/staff/$_SESSION[id]".".jpg";
			copy($_FILES["image"]["tmp_name"],$dest);
		}
	
	}else{
	echo"<div class=error><span class=errorIcon>Insufficient information. Please provide complete information...</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../staff/edit-my-profile$extension>try again</a></div></div>";
	}
	


}else{
?>

<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">
	<li class="title">Title:</li><li><select name='title'  id='title' size='1' tabindex='1'>
            <option value='<?php echo staff_info("title",$_SESSION['id']);?>'><?php echo staff_info("title",$_SESSION['id']);?> (Current)</option>
            <option value='Dr.'>Dr.</option>
            <option value='Mr.'>Mr.</option>
            <option value='Miss.'>Miss.</option>
            <option value='Mrs.'>Mrs. </option>
    </select></li>
	<li class="title">First Name:</li><li><input name="first_name" type="text" value="<?php echo staff_info("first_name",$_SESSION['id']);?>" /></li>
	<li class="title">Last Name:</li><li><input name="last_name" type="text" value="<?php echo staff_info("last_name",$_SESSION['id']);?>" /></li>
	<li class="title">New Password:</li><li><input name="passkey" type="text" /></li>
	<li class="title">Contact Number:</li><li><input name="contact" type="text" value="<?php echo staff_info("contact",$_SESSION['id']);?>"  /></li>
	<li class="title">Mobile Number:</li><li><input name="mobile" type="text" value="<?php echo staff_info("mobile",$_SESSION['id']);?>" /></li><li>Hidden from the staff with access level less than 4</li>
	<li class="title">Skype:</li><li><input name="skype" type="text" value="<?php echo staff_info("skype",$_SESSION['id']);?>"  /></li>
	<li class="title">Personal Address:</li><li><input name="address" type="text" value="<?php echo staff_info("address",$_SESSION['id']);?>" /></li><li>Hidden from the staff with access level less than 4</li>
    <li class="title">Profile Photo:</li><li><input name="image" type="file" /></li> 
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton staff" type="submit" value="proceed"></div>
</form>
<?php }?>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>