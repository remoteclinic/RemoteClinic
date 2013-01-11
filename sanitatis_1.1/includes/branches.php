<?php
/////////////////////////////////
function branch_info($query,$id){	
	$call=mysql_fetch_object(mysql_query("select * from p_branches_dir where id='$id'"));
	return $call->$query;
}
//////////////////////////////////////
function branch_count_staff($id){
	$result = mysql_query("SELECT * FROM p_staff_dir WHERE id='$id'");
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}
//////////////////////////////////////
function branch_count_patients($id){
}
//////////////////////////////////////
function branch_count_pending($id){
}
//////////////////////////////////////
function branch_count_prescribed($id){
}
//////////////////////////////////////
function branch_name($code){
	$call=mysql_fetch_object(mysql_query("select * from p_branches_dir where id='$code'"));
	return $call->name;
}
//////////////////////////////////////
function update_branch_profile($guardian,$id,$name,$address,$location,$contact,$type){

	$current_time=date('Y-m-d H:i:s');

mysql_query("update p_branches_dir set name='$name',address='$address',location='$location',contact='$contact',type='$type',guardian='$guardian',last_update='$current_time' where id='$id'") or die(mysql_error());

	return true;
}
//////////////////////////////////////

function register_branch_profile($guardian,$name,$address,$location,$contact,$type){

	$current_time=date('Y-m-d H:i:s');

mysql_query("insert into p_branches_dir set name='$name',address='$address',location='$location',contact='$contact',type='$type',guardian='$guardian',last_update='$current_time'																																																							") or die(mysql_error());
	
	$id = mysql_insert_id();
	return $id;
}
/////////////////////////////////
function branch_delete($id){

	$name=branch_info("name",$id);
	mysql_query("delete from p_branches_dir where id='$id'") or die(mysql_error());
	write_log("$_SESSION[id]","deleted Brnach $name - ID#$id","branch","50");


}
/////////////////////////////////
?>