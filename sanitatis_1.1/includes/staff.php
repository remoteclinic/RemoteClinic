<?php
/////////////////////////////////
function staff_info($query,$id){	
$call=mysql_fetch_object(mysql_query("select * from p_staff_dir where id='$id'"));
return $call->$query;
}
/////////////////////////////////

function last_update($id,$about){
	$processing = strtotime(staff_info("last_update",$id));

	$today=date("Y-m-d");
	$extract_day=(date("Y-m-d", $processing));	
	if($today==$extract_day){ $output="Today ".date("g:i a", $processing)."";
	}else{$output = date("F j, Y, g:i a", $processing);}

	return $output;
	
}
/////////////////////////////////
function no_of_actions($id){

	$result = mysql_query("SELECT * FROM p_logs WHERE user='$id'");
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}
/////////////////////////////////
function register_staff($title,$first_name,$last_name,$userid,$passkey,$contact,$mobile,$skype,$address,$access_level,$branch,$status){
	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);
	
	if($userid == '')  {
		return false;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $userid)) {
		return false;
	} else {
		$userid = $userid;
	}
	
	
	////////////////////////////////////////////////////////////
	// checking if user_id already exists
	$getting_match=mysql_query("select * from p_staff_dir where userid='$userid'");
	if(mysql_num_rows($getting_match)>0){
		return false;
	}
	////////////////////////////////////////////////////////////	
	if($first_name==""||$last_name==""||$passkey==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";
	
	$passkey=md5($passkey);
	
	

	mysql_query("insert into p_staff_dir set 
		title='$title',
		first_name='$first_name',
		last_name='$last_name',
		full_name='$full_name',
		userid='$userid',
		passkey='$passkey',
		contact='$contact',
		mobile='$mobile',
		skype='$skype',
		address='$address',
		branch='$branch',
		access_level='$access_level',
		status='$status',
		last_update='$current_time',
		registered_by='$_SESSION[id]'
	") or die(mysql_error());

	$get_id=mysql_insert_id();

	return $get_id;

	
}

/////////////////////////////////
function update_my_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address){
	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);

	if($first_name==""||$last_name==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";

	if($passkey!==""){
	$passkey=md5($passkey);
	mysql_query("update p_staff_dir set
	title='$title',
	first_name='$first_name',
	last_name='$last_name',
	full_name='$full_name',
	passkey='$passkey',
	contact='$contact',
	mobile='$mobile',
	skype='$skype',
	address='$address'
	where
	id='$id'
	") or die(mysql_error());
	
	return true;
	}else{

	mysql_query("update p_staff_dir set
	title='$title',
	first_name='$first_name',
	last_name='$last_name',
	full_name='$full_name',
	contact='$contact',
	mobile='$mobile',
	skype='$skype',
	address='$address'
	where
	id='$id'
	") or die(mysql_error());
	
	return true;
	
	}

}
/////////////////////////////////
function update_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address,$access_level,$status,$branch){
	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);

	if($first_name==""||$last_name==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";

	if($passkey!==""){
	$passkey=md5($passkey);
	mysql_query("update p_staff_dir set
	title='$title',
	first_name='$first_name',
	last_name='$last_name',
	full_name='$full_name',
	passkey='$passkey',
	contact='$contact',
	mobile='$mobile',
	skype='$skype',
	address='$address',
	access_level='$access_level',
	status='$status',
	branch='$branch'
	where
	id='$id'
	") or die(mysql_error());
	
	return true;
	}else{

	mysql_query("update p_staff_dir set
	title='$title',
	first_name='$first_name',
	last_name='$last_name',
	full_name='$full_name',
	contact='$contact',
	mobile='$mobile',
	skype='$skype',
	address='$address',
	access_level='$access_level',
	status='$status',
	branch='$branch'
	where
	id='$id'
	") or die(mysql_error());
	
	return true;
	
	}

}
/////////////////////////////////
function staff_img($id,$size){

	$filename = '../media/staff/'.$id.'.jpg';

	if (file_exists($filename)) {
	echo"<img src=../pre-includes/timthumb.php?src=../media/staff/$id.jpg&h=$size&w=$size&zc=1 />";
	} else {
	echo"<img src=../media/staff/blank.png width=$size />";
	}


}
/////////////////////////////////
function count_local_staff($branch){
		$getting_total=mysql_query("select * from p_staff_dir where branch='$branch'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
	$my_last_update = strtotime(staff_info("last_update",$_SESSION['id']));
/////////////////////////////////
function staff_delete($id){

	$name=staff_info("full_name",$id);
	mysql_query("delete from p_staff_dir where id='$id'") or die(mysql_error());
	write_log("$_SESSION[id]","deleted Staff Member $name - ID#$id","staff","50");


}
/////////////////////////////////

?>