<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("add_staff");

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['delete'])){ staff_delete($id); 	
	print "<script>";
	print "self.location='../staff/staff-directory$extension?deleted';"; 
    print "</script>";
 	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Staff Profile</title>
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
	

	$id=$_REQUEST['id'];
	$title=$_REQUEST['title'];
	$first_name=friendly($_REQUEST['first_name']);
	$last_name=friendly($_REQUEST['last_name']);
	$passkey=friendly($_REQUEST['passkey']);
	$contact=friendly($_REQUEST['contact']);
	$mobile=friendly($_REQUEST['mobile']);
	$skype=friendly($_REQUEST['skype']);
	$address=friendly($_REQUEST['address']);
	$access_level=friendly($_REQUEST['access_level']);
	$status=friendly($_REQUEST['status']);
	$branch=friendly($_REQUEST['branch']);

	$result=update_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address,$access_level,$status,$branch);
	$name_of_person=staff_info("full_name",$id);
	if($result==true){
	echo"<div class=ok><span class=tickIcon>Profile updated successfully.</span></div>";
	write_log("$_SESSION[id]","updated profile for $name_of_person","staff","40");
	
	if(isset($_FILES["image"]["tmp_name"])&& $_FILES["image"]["tmp_name"]!="")			
		{
			$dest="../media/staff/$id".".jpg";
			copy($_FILES["image"]["tmp_name"],$dest);
		}
	
	}else{
	echo"<div class=error><span class=errorIcon>Insufficient information. Please provide complete information...</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../staff/edit-profile$extension?id=$id>try again</a></div></div>";
	}
	


}else{
?>
<?php $profile=mysql_fetch_object(mysql_query("select * from p_staff_dir where id='$id' "));?>

<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">
    <input type="hidden" name="<?php echo "$profile->id";?>"/>
	<li class="title">Title:</li><li><select name='title'  id='title' size='1' tabindex='1'>
            <option value='<?php echo "$profile->title";?>'><?php echo "$profile->title";?> (Current)</option>
            <option value='Dr.'>Dr.</option>
            <option value='Mr.'>Mr.</option>
            <option value='Miss.'>Miss.</option>
            <option value='Mrs.'>Mrs. </option>
    </select></li>
	<li class="title">First Name:</li><li><input name="first_name" type="text" value="<?php echo "$profile->first_name";?>" /></li>
	<li class="title">Last Name:</li><li><input name="last_name" type="text" value="<?php echo "$profile->last_name";?>" /></li>
	<li class="title">New Password:</li><li><input name="passkey" type="text" /></li>
	<li class="title">Contact Number:</li><li><input name="contact" type="text" value="<?php echo "$profile->contact";?>"  /></li>
	<li class="title">Mobile Number:</li><li><input name="mobile" type="text" value="<?php echo "$profile->contact";?>" /></li><li>Hidden from the staff with access level less than 4</li>
	<li class="title">Skype:</li><li><input name="skype" type="text" value="<?php echo "$profile->skype";?>"  /></li>
	<li class="title">Personal Address:</li><li><input name="address" type="text" value="<?php echo "$profile->address";?>" /></li><li>Hidden from the staff with access level less than 4</li>
	<li class="title">Access Level:</li><li><select name='access_level'  id='access_level' size='1' tabindex='1'>
            <option value='<?php echo "$profile->access_level";?>'><?php echo "$profile->access_level";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(1);?></option>
            <option value='2'>2 - <?php echo access_level2rank(2);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select></li>
	<li class="title">Status:</li><li><select name='status'  id='status' size='1' tabindex='1'>
            <option value='<?php echo "$profile->status";?>'><?php echo "$profile->status";?> (Current)</option>
            <option value='active'>active</option>
            <option value='blocked'>blocked</option>

    </select></li>    
	<li class="title">Branch:</li><li>
	<select name='branch'  id='branch' size='1' tabindex='1'>
	<option value='<?php echo "$profile->branch";?>'><?php echo "$global_permission->guardian_short_name";?><?php echo "$profile->branch";?> (Current)</option>
	<?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 2000")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
    <option value='<?php echo $branches_dir['id']?>'><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?> - <?php echo $branches_dir['name']?></option>
	<?php }?>
    </select>
    <li class="title">Profile Photo:</li><li><input name="image" type="file" /></li> 
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton staff" type="submit" value="proceed"></div>
</form>

<div id="page-clear" align="center"><div id="deleteButton"><a href="edit-profile<?php echo "$extension";?>?id=<?php echo "$profile->id";?>&delete">delete profile</a></div></div>
<?php }?>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>