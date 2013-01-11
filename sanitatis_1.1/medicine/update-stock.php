<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Stock</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="medicine medicine-color">update stock</h1>
	<div class="medicine-bottom-border"></div>
<div class="innertube">
<?php
if(isset($_REQUEST['submit'])){
	

	$branch=$_REQUEST['branch'];
	$code=$_REQUEST['code'];
	$addidtion=friendly($_REQUEST['addidtion']);
	$addidtion=preg_replace("/[^0-9\s]/", "", $addidtion);
	$branch_name=branch_info("name",$branch);
	if(update_stock($branch,$code,$addidtion)==true){
	echo"<div class=ok><span class=tickIcon>Stock for $branch_name has been successfully updated with $addidtion doses of $code...</span></div>";
	write_log("$_SESSION[id]","updated Stock for $branch_name with $addidtion doses of $code","stock","40");
	}else{
	echo"<div class=error><span class=errorIcon>Something went wrong. Please try again...</span></div>";
	}
	


}

?>
<form method="post" action="" enctype="multipart/form-data">

	<ul id="form">
	<li class="title">Branch:</li><li><select name='branch'  id='branch' size='1' tabindex='1'>
	<?php 
	$sql=mysql_query("select * from p_branches_dir order by last_update desc limit 2000")or die(mysql_error());
	while($branches_dir=mysql_fetch_array($sql)){
	?>
    <option value='<?php echo $branches_dir['id']?>'><?php echo "$global_permission->guardian_short_name"; echo $branches_dir['id']?> - <?php echo $branches_dir['name']?></option>
	<?php }?>
    </select></li>

	<li class="title">Medicine:</li><li><select name='code'  id='code' size='1' tabindex='1'>
	<?php 
	$sql=mysql_query("select * from p_medicine_dir order by last_update desc limit 9000")or die(mysql_error());
	while($medicine_dir=mysql_fetch_array($sql)){
	?>
	<option value='<?php echo $medicine_dir['code']?>'><?php echo $medicine_dir['code']?> (<?php echo $medicine_dir['name']?>)</option>
	<?php }?>
    </select></li>
	
	
	<li class="title">Doses:</li><li><input name="addidtion" type="text" maxlength="4" /></li>
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton medicine" type="submit" value="proceed"></div>
</form>    
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>