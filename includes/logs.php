<?php

function write_log($user,$action,$type,$priority){
	global $con;
$current_time=date('Y-m-d H:i:s');
mysqli_query($con, "insert into p_logs set user='$user',at='$current_time',action='$action',type='$type',priority='$priority'") or die(mysqli_error());

}


function priority_level($number){
	if($number==50){ $means="critical";}
	else if($number==40){ $means="vital";}
	else if($number==30){ $means="important";}
	else if($number==20){ $means="regular";}
	else if($number==10){ $means="normal";}
	else {$means="normal";}
	return $means;
}
?>