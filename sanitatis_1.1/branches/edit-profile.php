<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("add_branch");

	if(isset($_GET['id'])){$branch_id=$_GET['id'];}
	if(isset($_GET['delete'])){ branch_delete($branch_id); 	
	print "<script>";
	print "self.location='../branches/branches-directory$extension?deleted';"; 
    print "</script>";
 	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Branch Profile</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="branches branches-color">update branch profile</h1>
	<div class="branches-bottom-border"></div>
<div class="innertube">
<?php
if(isset($_REQUEST['submit'])){
	
	$guardian="1";
	$id=$_REQUEST['id'];
	$name=friendly($_REQUEST['name']);
	$address=friendly($_REQUEST['address']);
	$location=friendly($_REQUEST['location']);
	$contact=friendly($_REQUEST['contact']);
	$type=$_REQUEST['type'];
	
	if(update_branch_profile($guardian,$id,$name,$address,$location,$contact,$type)==true){
	echo"<div class=ok><span class=tickIcon>Profile for $name has been successfully updated...</span></div>";
	write_log("$_SESSION[id]","updated Branch Profile for $name ($id)","branch","40");
	}else{
	echo"<div class=error><span class=errorIcon>Something went wrong. Please try again...</span></div>";
	}
	


}

?>
<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">
<?php $profile=mysql_fetch_object(mysql_query("select * from p_branches_dir where id='$branch_id' "));?>

	
	<li class="title">Daughter of:</li><li><input name="guardian" value="<?php echo "$global_permission->guardian_name"?>" readonly="readonly" type="text" /></li><li>readonly</li>
	<li class="title">Daughter ID:</li><li><input name="id" value="<?php echo "$global_permission->guardian_short_name"?><?php echo "$profile->id";?>" readonly="readonly" type="text" /></li><li>readonly</li>
	
	<li class="title">Branch Name:</li><li><input name="name" id="name" type="text" value="<?php echo "$profile->name";?>" maxlength="30"/></li>
	<li class="title">Branch Address:</li><li><input name="address" id="address" type="text" value="<?php echo "$profile->address";?>" maxlength="20" /></li>
	<li class="title">Branch City:</li><li><input name="location" id="location" type="text"  value="<?php echo "$profile->location";?>" maxlength="20"/></li>
	<li class="title">Branch Contact:</li><li><input name="contact" id="contact" type="text"  value="<?php echo "$profile->contact";?>" maxlength="20"/></li>
	<li class="title">Branch Rank:</li><li><select name='type'  name="type" id='type' size='1' tabindex='1'>
            <option value='<?php echo "$profile->type";?>'><?php echo "$profile->type";?> (Current)</option>
            <option value='Branch'>Branch</option>
            <option value='Head Office'>Head Office</option></select></li>
            <input type="hidden" name="id" id="id" value="<?php echo "$profile->id";?>"/>
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton branches" type="submit" value="proceed"></div>
</form>
<div id="page-clear" align="center"><div id="deleteButton"><a href="edit-profile<?php echo "$extension";?>?id=<?php echo "$branch_id";?>&delete">delete profile</a></div></div>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>