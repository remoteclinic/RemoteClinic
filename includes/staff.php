<?php

function staff_info($query,$id = NULL){	
	global $con;

	if(!isset($id)){
		$id = $_SESSION['id'];
	}

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_staff_dir where id='$id'"));

	return $call->$query;
}	


function count_lstaff($branch,$hours = NULL){
	global $con;
	
	if(!isset($hours)) $hours = 24; 

		$total = 0;
		$sql=mysqli_query($con, "select * from p_logs where action='LoggedIn' and `at` > NOW() - INTERVAL $hours HOUR") or die(mysqli_error());
		$user_data = array();

		while($get_list=mysqli_fetch_array($sql)){
		 	if( in_array($get_list['user'],$user_data) ) continue;
		 	$user_data[] = $get_list['user'];
		 	if(staff_info('branch',$get_list['user'])!=$branch) continue;
		 	$total++;
		}
		
		return $total;
}



function last_update($id,$about){
	$processing = strtotime(staff_info("last_update",$id));

	$today=date("Y-m-d");
	$extract_day=(date("Y-m-d", $processing));	
	if($today==$extract_day){ $output="Today ".date("g:i a", $processing)."";
	}else{$output = date("F j, Y, g:i a", $processing);}

	return $output;
	
}


function no_of_actions($id){
	global $con;

	$result = mysqli_query($con, "SELECT * FROM p_logs WHERE user='$id'");
	$num_rows = mysqli_num_rows($result);
	return $num_rows;
}



function register_staff($title,$first_name,$last_name,$userid,$passkey,$contact,$mobile,$skype,$address,$access_level,$branch,$status){
	global $con;

	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);
	
	if (filter_var($userid, FILTER_VALIDATE_EMAIL)) {
		$userid = $userid;
	}else{
		return false;		
	}
	
	// checking if user_id already exists
	$getting_match=mysqli_query($con, "select * from p_staff_dir where userid='$userid'");
	if(mysqli_num_rows($getting_match)>0){
		return false;
	}


	if($first_name==""||$last_name==""||$passkey==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";
	
	$passkey=md5($passkey);
	
	

	mysqli_query($con, "insert into p_staff_dir set 
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
	") or die(mysqli_error());

	$get_id=mysqli_insert_id($con);

	return $get_id;

	
}




function update_my_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address){
	global $con;

	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);

	if($first_name==""||$last_name==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";

	if($passkey!==""){
	$passkey=md5($passkey);
	mysqli_query($con, "update p_staff_dir set
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
	") or die(mysqli_error());
	
	return true;
	}else{

	mysqli_query($con, "update p_staff_dir set
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
	") or die(mysqli_error());
	
	return true;
	
	}

}


function update_profile($id,$title,$first_name,$last_name,$passkey,$contact,$mobile,$skype,$address,$access_level,$status,$branch){
	global $con;

	$current_time=date('Y-m-d H:i:s');
	$contact=preg_replace("/[^0-9\s]/", "", $contact);
	$mobile=preg_replace("/[^0-9\s]/", "", $mobile);

	if($first_name==""||$last_name==""||$contact==""){return false;}
	
	$full_name= "$title $first_name $last_name";

	if($passkey!==""){
	$passkey=md5($passkey);
	mysqli_query($con, "update p_staff_dir set
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
	") or die(mysqli_error());
	
	return true;
	}else{

	mysqli_query($con, "update p_staff_dir set
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
	") or die(mysqli_error());
	
	return true;
	
	}

}


function staff_img($id,$size){

	$filename = '../media/staff/'.$id.'.png';

	if (file_exists($filename)) {
	echo"<img src=../pre-includes/timthumb.php?src=../media/staff/$id.png&h=$size&w=$size&zc=1 />";
	} else {
	echo"<img src=../media/staff/blank.png width=$size />";
	}


}

function count_local_staff($branch){
	global $con;

		$getting_total=mysqli_query($con, "select * from p_staff_dir where branch='$branch'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}

function staff_by_rank($branch,$rank){
	global $con;

		$getting_total=mysqli_query($con, "select * from p_staff_dir where branch='$branch' and access_level='$rank'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}

	$my_last_update = strtotime(staff_info("last_update",$_SESSION['id']));

function staff_delete($id){
	global $con;

	$name=staff_info("full_name",$id);
	mysqli_query($con, "delete from p_staff_dir where id='$id'") or die(mysqli_error());
	write_log("$_SESSION[id]","deleted a Staff Member $name - ID#$id","staff","50");


}


?>