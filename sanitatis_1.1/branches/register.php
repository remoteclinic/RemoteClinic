<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("add_branch");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register New Branch</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="branches branches-color">register new branch</h1>
	<div class="branches-bottom-border"></div>
<div class="innertube">

<?php
if(isset($_REQUEST['submit'])){
	
	$guardian="1";
	$name=friendly($_REQUEST['name']);
	$address=friendly($_REQUEST['address']);
	$location=friendly($_REQUEST['location']);
	$contact=friendly($_REQUEST['contact']);
	$type=$_REQUEST['type'];
	
	$get_id=register_branch_profile($guardian,$name,$address,$location,$contact,$type);
	write_log("$_SESSION[id]","registered New Branch Profile for $name ($get_id)","branch","50");
	
	echo"<div class=ok><span class=tickIcon>New Profile has been registered. <strong>ID:</strong> $global_permission->guardian_short_name - $get_id </span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../branches/branches-directory$extension>branches directory</a></div></div>";

	}else{
?>
<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">

	
	<li class="title">Daughter of:</li><li><input name="name" value="<?php echo "$global_permission->guardian_name"?>" readonly="readonly" type="text" /></li>
	
	<li class="title">Branch Name:</li><li><input name="name" type="text" /></li>
	<li class="title">Branch Address:</li><li><input name="address" type="text" /></li>
	<li class="title">Branch City:</li><li><input name="location" type="text" /></li><li>Recommended to use an email address - Can’t be changed</li>
	<li class="title">Branch Contact:</li><li><input name="contact" type="text" /></li><li>Active Email Address</li>
	<li class="title">Branch Rank:</li><li><select name='type'  id='gender' size='1' tabindex='1'>
            <option value='Branch'>New Branch</option>
            <option value='Head Office'>Head Office</option></select></li>
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton branches" type="submit" value="proceed"></div>
</form>

<?php }?>
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>