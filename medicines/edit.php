<?php
	require_once "../includes/initiate.php";
	page_permission("introduce_medicine");	
	if(isset($_GET['id'])){$id=$_GET['id'];}
	sns_header('Edit Medicine');
?>

<div id="edit-medicine" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-medicines"><span class="inlineicon edit-mini">Edit Medicine</span></div>
<div class="panel-body">
<ol class="breadcrumb link-medicines">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../medicines/">Medicine Directory</a></li>
  <li class="active">Edit Medicine</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$id=$_POST['id'];
	$category=$_POST['category'];
	$code=friendly(strtoupper($_POST['code']));
	$name=friendly($_POST['name']);
	$price=friendly($_POST['price']);
	$price=preg_replace("/[^0-9\s]/", "", $price);
 	$added_by=staff_info('id');

	if(edit_medicine($id,$category,$code,$name,$price,$added_by)==true){
	write_log(staff_info('id'),"edit profile for Medicine $name with code $code","medicine","30");
	echo"<div class='alert alert-success' role='alert'>Profile Updated Successfully. The code given to this medicine is $code.</div>";
	echo"<a class='btn btn-default formbutton theme-medicines' href=../medicines/>Show All</a>";
	}else{
	echo"<div class='alert alert-danger' role='alert'>Please try different code.</div>";
	echo"<a class='btn btn-default formbutton theme-medicines' href=../medicines/new.php>try again</a>";
	}
	
}else{
	
	$medicine=mysqli_fetch_object(mysqli_query($con, "select * from p_medicine_dir where id='$id' "));?>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Category:</label><select class="form-control"  name='category'  id='category' size='1' tabindex='1'>
            <option value='<?php echo $medicine->category;?>'><?php echo $medicine->category;?> (Current)</option>
            <option value='Bottle'>Bottle</option>
            <option value='Syrup'>Syrup</option>
            <option value='Tablets'>Tablets</option>
    </select></div>
	<div class="form-group"><label>Medicine Code:</label><input  class="form-control" name="code" type="text" maxlength="10" value="<?php echo $medicine->code;?>" /></div>
	<div class="form-group"><label>Medicine Name:</label><input  class="form-control" name="name" type="text" maxlength="30" value="<?php echo $medicine->name;?>" /></div>
	<div class="form-group"><label>Price:</label><input  class="form-control" name="price" type="text" maxlength="10" value="<?php echo $medicine->price;?>" /><i>e.g: RS.5 Per tablet</i></div>
    <input type="hidden" name="id" value="<?php echo $id;?>"/>
	<input name="submit" class="btn btn-default formbutton theme-medicines" type="submit" value="Update">
</form>
<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->
<?php sns_footer();?>