<?php

function medicine_info($query,$id){	
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_medicine_dir where id='$id'"));
	return $call->$query;
}


function medicine_by_code($query,$code){	
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_medicine_dir where code='$code'"));
	return $call->$query;
}


function introduce_medicine($category,$code,$name,$price,$added_by){
	global $con;

	$current_time=date('Y-m-d H:i:s');

	$getting_match=mysqli_query($con, "select * from p_medicine_dir where code='$code'");
	 if(mysqli_num_rows($getting_match)>0){
			
		return false;
 
	 }else if($code==''||$name==''){
	
		return false;

	}else{
		mysqli_query($con, "insert into p_medicine_dir set category='$category',code='$code',name='$name',price='$price',added_by='$added_by',last_update='$current_time' ") 
		or die(mysqli_error());
		return true;
	 }
}


function edit_medicine($id,$category,$code,$name,$price,$added_by){
	global $con;

	$current_time=date('Y-m-d H:i:s');

	$getting_match=mysqli_query($con, "select * from p_medicine_dir where code='$code' and id!='$id'");
	 if(mysqli_num_rows($getting_match)>0){
			
		return false;
 
	 }else if($code==''||$name==''){
	
		return false;

	}else{
		mysqli_query($con, "update p_medicine_dir set category='$category',code='$code',name='$name',price='$price',added_by='$added_by',last_update='$current_time' where id='$id' ") 
		or die(mysqli_error());
		return true;
	 }
}


function update_stock($branch,$code,$addidtion){
	global $con;

	$current_time=date('Y-m-d H:i:s');

	if($addidtion==''){return false;}

	$getting_match=mysqli_query($con, "select * from p_stock where code='$code' and branch='$branch' ");
	 if(mysqli_num_rows($getting_match)>0){

	$getting_match=mysqli_fetch_object($getting_match);
	$pre_qunatity = $getting_match->remaining;
	$post_qunatity=$addidtion+$pre_qunatity;

	mysqli_query($con, "update p_stock set 
		total='$post_qunatity',
		remaining='$post_qunatity',
		added_by='$_SESSION[id]',
		last_update='$current_time'
		where
		code='$code' and branch='$branch'
	") or die(mysqli_error());
	
	return true;

	}else{

	mysqli_query($con, "insert into p_stock set 
		total='$addidtion',
		remaining='$addidtion',
		added_by='$_SESSION[id]',
		code='$code',		
		branch='$branch',
		last_update='$current_time'
	") or die(mysqli_error());

	return true;

	}
}


function medicine_delete($id){
	global $con;

	$name=medicine_info("name",$id);
	$code=medicine_info("code",$id);
	mysqli_query($con, "delete from p_medicine_dir where id='$id'") or die(mysqli_error());
	write_log("$_SESSION[id]","deleted Medicine $name - $code","medicine","30");

}


function prescribe_count($code, $hours){
	global $con;

	$getting_match=mysqli_query($con, "select * from p_med_record where medicine='$code' and last_update > NOW() - INTERVAL $hours HOUR");
	return mysqli_num_rows($getting_match);

}



function delete_single_stock($id){
	global $con;

	mysqli_query($con, "delete from p_stock where id='$id'") or die(mysqli_error());
	write_log("$_SESSION[id]","deleted stock id $id","stock","30");


}



?>