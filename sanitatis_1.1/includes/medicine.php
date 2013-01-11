<?php
/////////////////////////////////
function medicine_info($query,$id){	
	$call=mysql_fetch_object(mysql_query("select * from p_medicine_dir where id='$id'"));
	return $call->$query;
}
/////////////////////////////////
function introduce_medicine($category,$code,$name,$price,$added_by){
	$current_time=date('Y-m-d H:i:s');

	$getting_match=mysql_query("select * from p_medicine_dir where code='$code'");
	 if(mysql_num_rows($getting_match)>0){
			
		return false;
 
	 }else if($code==''||$name==''){
	
		return false;

	}else{
		mysql_query("insert into p_medicine_dir set category='$category',code='$code',name='$name',price='$price',added_by='$added_by',last_update='$current_time' ") 
		or die(mysql_error());
		return true;
	 }
}
/////////////////////////////////
function edit_medicine($id,$category,$code,$name,$price,$added_by){
	$current_time=date('Y-m-d H:i:s');

	$getting_match=mysql_query("select * from p_medicine_dir where code='$code' and id!='$id'");
	 if(mysql_num_rows($getting_match)>0){
			
		return false;
 
	 }else if($code==''||$name==''){
	
		return false;

	}else{
		mysql_query("update p_medicine_dir set category='$category',code='$code',name='$name',price='$price',added_by='$added_by',last_update='$current_time' where id='$id' ") 
		or die(mysql_error());
		return true;
	 }
}
/////////////////////////////////
function update_stock($branch,$code,$addidtion){
	$current_time=date('Y-m-d H:i:s');

	if($addidtion==''){return false;}

	$getting_match=mysql_query("select * from p_stock where code='$code' and branch='$branch' ");
	 if(mysql_num_rows($getting_match)>0){

	$getting_match=mysql_fetch_object($getting_match);
	$pre_qunatity = $getting_match->remaining;
	$post_qunatity=$addidtion+$pre_qunatity;

	mysql_query("update p_stock set 
		total='$post_qunatity',
		remaining='$post_qunatity',
		added_by='$_SESSION[id]',
		last_update='$current_time'
		where
		code='$code' and branch='$branch'
	") or die(mysql_error());
	
	return true;

	}else{

	mysql_query("insert into p_stock set 
		total='$addidtion',
		remaining='$addidtion',
		added_by='$_SESSION[id]',
		code='$code',		
		branch='$branch',
		last_update='$current_time'
	") or die(mysql_error());

	return true;

	}
}
/////////////////////////////////
function medicine_delete($id){

	$name=medicine_info("name",$id);
	$code=medicine_info("code",$id);
	mysql_query("delete from p_medicine_dir where id='$id'") or die(mysql_error());
	write_log("$_SESSION[id]","deleted Medicine $name - $code","medicine","30");


}

/////////////////////////////////
?>