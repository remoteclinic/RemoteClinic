<?php

	$extension=".php";

	$current_time=date_create('Y-m-d H:i:s');

	$global_permission=mysqli_fetch_object(mysqli_query($con,"select * from p_global_permissions where id='1'"));

function get_global($query){

	global $con;

	$get_global=mysqli_fetch_object(mysqli_query($con,"select $query from p_global_permissions where id='1' "));
	
	return $get_global->$query; 

}

	date_default_timezone_set("$global_permission->timezone");

	$timezone = new DateTimeZone("$global_permission->timezone" );
	$date = new DateTime();
	$date->setTimezone($timezone );
	$current_time  = $date->format( 'h:i A  -  l, F j, Y' );
	$date_stamp  = $date->format( 'l, F j, Y' );
	$time_stamp  = $date->format( 'h:i A' );



function soft_singout(){
	session_unset("id");
	session_unset("branch");
	session_unset("session_id");
	session_unset("today");
	session_unset("access_level");
	session_unset("last_update");
	session_unset("unique_code");
}



function if_logged_in(){
	if(empty($_SESSION['id'])) { 
		return false;
	}else if(empty($_SESSION['branch'])){
		return false;
	}else if(empty($_SESSION['session_id'])){
		return false;
	}else if(empty($_SESSION['access_level'])){
		return false;
	}else if(empty($_SESSION['unique_code'])){
		return false;
	}else {
		return true;
	}	
}



function display_time($datetime){

	$processing = strtotime($datetime);

	$today=date("Y-m-d");
	$extract_day=(date("Y-m-d", $processing));	
	if($today==$extract_day){ $output="".date("g:i a", $processing)." Today";
	}else{$output = date("F j, Y, g:i a", $processing);}

	return $output;
}



function friendly($query){
	global $con;
	
	$query=stripslashes($query);
	$query=mysqli_escape_string($con, $query);
	$query=mysqli_real_escape_string($con, $query);

	return $query;
}



function genRandomString($length) {
    $characters = "QWERTYUIOPASDFGHJKLZXCVBNMQWERTYUIOPASDFGHJKLZXCVBNMQWERTYUIOPASDFGHJKLZXCVBNMQWERTYUIOPASDFGHJKLZXCVBNMQWERTYUIOPASDFGHJKLZXCVBNMQWERTYUIOPASDFGHJKLZXCVBNM";
    $string = "";    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}



function percentage($number,$total)
{
	$percentage = round($number * 100 / $total);
	return $percentage;
}



function access_level2rank($access_level){
	global $global_permission;
	if($access_level==6){$rank="$global_permission->access_level_6";}
	else if($access_level==5){$rank="$global_permission->access_level_5";}
	else if($access_level==4){$rank="$global_permission->access_level_4";}
	else if($access_level==3){$rank="$global_permission->access_level_3";}
	else if($access_level==2){$rank="$global_permission->access_level_2";}
	else{$rank="$global_permission->access_level_1";}
	
	return $rank;
}



function charge_mode($mode){
	global $global_permission;
	if($mode=="a"){$charge="$global_permission->charge_mode_a";}
	else if($mode=="b"){$charge="$global_permission->charge_mode_b";}
	else if($mode=="c"){$charge="$global_permission->charge_mode_c";}
	else{$charge="$global_permission->charge_mode_d";}
	return $charge;
	
}



function page_permission($pagename){
	global $con;

	$access_level=$_SESSION['access_level'];

	$sql=mysqli_query($con,"select * from p_global_permissions")or die(mysqli_error());
	while($permission_for=mysqli_fetch_array($sql)){
		if($access_level>=$permission_for[$pagename]){return true;}else{
		     print "<script>";
		        print " self.location='../desktop/?denied';"; 
		      print "</script>";	
		}
	}
}



function display_permission($query,$user = NULL){
	global $con;
	
	if(isset($user)){
		$access_level=staff_info("access_level",$user);
	}else{
		$access_level=$_SESSION['access_level'];
	}

	$sql=mysqli_query($con,"select * from p_global_permissions")or die(mysqli_error());
	while($permission_for=mysqli_fetch_array($sql)){
	if($access_level>=$permission_for[$query]){return true;}else{return false;}
	}

}



?>