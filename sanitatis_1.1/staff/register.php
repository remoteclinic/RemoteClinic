<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("add_staff");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register New Staff Member</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="staff staff-color">register new staff member</h1>
	<div class="staff-bottom-border"></div>
<div class="innertube">
<?php
if(isset($_REQUEST['submit'])){
	

	$title=$_REQUEST['title'];
	$first_name=friendly($_REQUEST['first_name']);
	$last_name=friendly($_REQUEST['last_name']);
	$userid=friendly($_REQUEST['userid']);
	$passkey=friendly($_REQUEST['passkey']);
	$contact=friendly($_REQUEST['contact']);
	$mobile=friendly($_REQUEST['mobile']);
	$skype=friendly($_REQUEST['skype']);
	$address=friendly($_REQUEST['address']);
	$access_level=friendly($_REQUEST['access_level']);
	$status=friendly($_REQUEST['status']);
	$branch=friendly($_REQUEST['branch']);

	$result=register_staff($title,$first_name,$last_name,$userid,$passkey,$contact,$mobile,$skype,$address,$access_level,$branch,$status);
	
	if($result!=""){
	echo"<div class=ok><span class=tickIcon>Profile created successfully. Say hey to your new $global_permission->portal_name family member, $title $last_name.</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../staff/register$extension>add another</a></div></div>";
	write_log("$_SESSION[id]","registered new staff member $title $first_name $last_name","staff","50");
	
	if(isset($_FILES["image"]["tmp_name"])&& $_FILES["image"]["tmp_name"]!="")			
		{
			$dest="../media/staff/$result".".jpg";
			copy($_FILES["image"]["tmp_name"],$dest);
		}
	
	}else{
	echo"<div class=error><span class=errorIcon>Insufficient information. Please provide complete information...</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../staff/register$extension>try again</a></div></div>";
	}
	


}else{

?>
<form method="post" action=""  enctype="multipart/form-data">
	<ul id="form">
	<li class="title">Title:</li><li><select name='title'  id='title' size='1' tabindex='1'>
            <option value='Dr.'>Dr.</option>
            <option value='Mr.'>Mr.</option>
            <option value='Miss.'>Miss.</option>
            <option value='Mrs.'>Mrs. </option>
    </select></li>
	
	
	<li class="title">First Name:</li><li><input name="first_name" type="text" /></li>
	<li class="title">Last Name:</li><li><input name="last_name" type="text" /></li>
	<li class="title">User ID:</li><li><input name="userid" type="text" /></li><li>Recommended to use an email address - Can’t be changed</li>
	<li class="title">Password:</li><li><input name="passkey" type="text" /></li>
	<li class="title">Contact Number:</li><li><input name="contact" type="text" /></li>
	<li class="title">Mobile Number:</li><li><input name="mobile" type="text" ></li><li>Hidden from the staff with access level less than 4</li>
	<li class="title">SKYPE:</li><li><input name="skype" type="text" /></li>
	<li class="title">Personal Address:</li><li><input name="address" type="text"  /></li><li>Hidden from the staff with access level less than 4</li>
	<li class="title">Access Level:</li><li><select name='access_level'  id='access_level' size='1' tabindex='1'>
            <option value='1'>1 - <?php echo access_level2rank(1);?></option>
            <option value='2'>2 - <?php echo access_level2rank(2);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select></li>
	<li class="title">Status:</li><li><select name='status'  id='status' size='1' tabindex='1'>
            <option value='active'>active</option>
            <option value='blocked'>blocked</option>

    </select></li>    
	<li class="title">Branch:</li><li>
	<select name='branch'  id='branch' size='1' tabindex='1'>
	<?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 2000")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
    <option value='<?php echo $branches_dir['id']?>'><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?> - <?php echo $branches_dir['name']?></option>
	<?php }?>
    </select>
    </li><li>Assign headquarter for the staff responsible to handle global quires</li>
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