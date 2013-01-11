<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("introduce_medicine");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Introduce New Medicine</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="medicine medicine-color">introduce new medicine</h1>
	<div class="medicine-bottom-border"></div>
<div class="innertube">
<?php
if(isset($_REQUEST['submit'])){
	
	$category=$_REQUEST['category'];
	$code=friendly(strtoupper($_REQUEST['code']));
	$name=friendly($_REQUEST['name']);
	$price=friendly($_REQUEST['price']);
	$price=preg_replace("/[^0-9\s]/", "", $price);
 	$added_by=$_SESSION['id'];

	if(introduce_medicine($category,$code,$name,$price,$added_by)==true){
	write_log("$_SESSION[id]","introduced new Medicine with the name of $name and code $code","medicine","30");
	echo"<div class=ok><span class=tickIcon>New Medicine has been introduced witht the name of $name. The code given to this medicine is $code.</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../medicine/medicine-directory$extension>medicine directory</a></div></div>";
	}else{
	echo"<div class=error><span class=errorIcon>It seems like we have already a medicine available with this code. Please try different code.</span></div>";
	echo"<div id=page-clear align=center><div id=editButton><a href=../medicine/introduce-medicine$extension>try again</a></div></div>";
	}
	


}else{

?>
<form method="post" action="" enctype="multipart/form-data">
	<ul id="form">
	<li class="title">Category:</li><li><select name='category'  id='category' size='1' tabindex='1'>
            <option value='Bottle'>Bottle</option>
            <option value='Syrup'>Syrup</option>
            <option value='Tablets'>Tablets</option>
    </select></li>
	<li class="title">Medicine Code:</li><li><input name="code" type="text" maxlength="10" /></li>
	<li class="title">Medicine Name:</li><li><input name="name" type="text" maxlength="30" /></li>
	<li class="title">Price:</li><li><input name="price" type="text" maxlength="10" /></li><li>e.g: RS.5 Per tablet</li>
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton medicine" type="submit" value="proceed"></div>
</form>
<?php }?>

</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>