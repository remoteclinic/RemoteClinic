<?php


function branch_info($query,$id){	
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_branches_dir where id='$id'"));
	return $call->$query;
}



function branch_count_staff($id){
	global $con;

	$result = mysqli_query($con, "SELECT * FROM p_staff_dir WHERE id='$id'");
	$num_rows = mysqli_num_rows($result);
	return $num_rows;
}



function branch_name($code){
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_branches_dir where id='$code'"));
	return $call->name;
}



function update_branch_profile($guardian,$id,$name,$address,$location,$contact,$type){

	global $con;

	$current_time=date('Y-m-d H:i:s');

	mysqli_query($con, "update p_branches_dir set name='$name',address='$address',location='$location',contact='$contact',type='$type',guardian='$guardian',last_update='$current_time' where id='$id'") or die(mysqli_error());

	return true;
}



function register_branch_profile($guardian,$name,$address,$location,$contact,$type){

	global $con;

	$current_time=date('Y-m-d H:i:s');

mysqli_query($con, "insert into p_branches_dir set name='$name',address='$address',location='$location',contact='$contact',type='$type',guardian='$guardian',last_update='$current_time'																																																							") or die(mysqli_error());
	
	$id = mysqli_insert_id($con);
	return $id;
}



function branch_delete($id){

	global $con;

	$name=branch_info("name",$id);
	mysqli_query($con, "delete from p_branches_dir where id='$id'") or die(mysqli_error());
	write_log("$_SESSION[id]","deleted Brnach $name - ID#$id","branch","50");

}


?>