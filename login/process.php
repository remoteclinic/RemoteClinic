<?php
require_once "../pre-includes/all.php"; 
include "../includes/logs.php";
$hasError=false;
	
/* -------------------------- */
	$starting_time="$global_permission->opening_time";
	$closing_time="$global_permission->closing_time";
	$req_rank_during_closing="$global_permission->during_close_time";
	$this_hour= date('H');
	if($this_hour>=$starting_time&&$this_hour<=$closing_time){$office_closed=false; }else{$office_closed=true;}
/* -------------------------- */
	
	$starting_time="$global_permission->opening_time";
	$closing_time="$global_permission->closing_time";

// Just to make sure
session_unset("id");
session_unset("branch");
session_unset("session_id");
session_unset("today");
session_unset("access_level");
session_unset("last_update");
session_unset("unique_code");

// grabbing some values
$input_email = $_POST['user_id'];
$input_password = $_POST['password'];
$input_key = $_POST['extra_key'];


// Filtering
$input_email=stripslashes($input_email);
$input_email=mysqli_escape_string($con, $input_email);
$input_email=mysqli_real_escape_string($con, $input_email);

$input_password=stripslashes($input_password);
$input_password=mysqli_escape_string($con, $input_password);
$input_password=mysqli_real_escape_string($con, $input_password);


//Verifying input_key
	$key_should_be = md5(date( 'A  D, M jS, Y' ));
	if($key_should_be!=$input_key){
		$hasError = true;
	}

//Checking Email ID
	if(trim($input_email) == '')  {
		$hasError = true;
	} else {
		$input_email = trim($input_email);
	}

//Check Password
	if(trim($input_password == '')) {
		$hasError = true;
	} else {
		$input_password = trim($input_password);
	}


/* -------------------------- */
// If having any error, transport back...
if($hasError==true){
    is_invalid();
}else{
	$hasError = false;
	$shouldContinue = true;
}

/* -------------------------- */

// LETS MATCH Input with DB
$input_password=md5($input_password);

if($rec=mysqli_fetch_object(mysqli_query($con, "SELECT * FROM p_staff_dir WHERE userid='$input_email' limit 1"))){
	if(($rec->passkey!=$input_password)){
		is_invalid();
	}
}
/* -------------------------- */


if($rec=mysqli_fetch_object(mysqli_query($con, "SELECT * FROM p_staff_dir WHERE userid='$input_email' AND passkey='$input_password'"))){

	if(($rec->userid==$input_email)&&($rec->passkey=$input_password)){
		/* -------------------------- */
		if($rec->status=="blocked"){
				print "<script>";
			        print " self.location='../login/?status=blocked';"; 
				print "</script>";
			exit();
		}
		/* -------------------------- */
		if($office_closed==true){
			if($rec->access_level >= "$req_rank_during_closing"){
				$permission = true;
			}else{
				$permission = false;
			print "<script>";
			   print " self.location='../login/?status=revoked';"; 
			print "</script>";
			exit();
			}
		}
		/* -------------------------- */

		$_SESSION['session_id']=session_id();
		$_SESSION['id']=$rec->id;
		$_SESSION['branch']=$rec->branch;
		$_SESSION['access_level']=$rec->access_level;
		$_SESSION['last_update']=date('Y-m-d H:i:s');
		$_SESSION['today']=date('Y-m-d');
		$_SESSION['unique_code']=md5(date('Y-m-d H:i:s'));
		$current_time=date('Y-m-d H:i:s');


		mysqli_query($con, "update p_staff_dir set last_update='$current_time' where id=$_SESSION[id] ") or die(mysql_error());

		write_log("$_SESSION[id]","LoggedIn","staff","10");

			print "<script>";
		        print " self.location='../dashboard/';"; 
			print "</script>";

		
	}else{

			is_invalid();
	}

}

	is_invalid();

function is_invalid(){
	print "<script>";
        print " self.location='../login/?status=invalid';"; 
	print "</script>";	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Please wait...</title>
</head>
<body>
</body>
</html>