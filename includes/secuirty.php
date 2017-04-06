<?php

function sessions_check(){
	$keepRooming = true;
	if(empty($_SESSION['id'])) { 
		$keepRooming = false;
	}else if(empty($_SESSION['branch'])){
		$keepRooming = false;
	}else if(empty($_SESSION['session_id'])){
		$keepRooming = false;
	}else if(empty($_SESSION['access_level'])){
		$keepRooming = false;
	}else if(empty($_SESSION['unique_code'])){
		$keepRooming = false;
	}else {
		$keepRooming = true;
	}

	$today=date('Y-m-d');
	if(isset($_SESSION['today'])!=$today){$keepRooming = false;}
		
	if($keepRooming==false){
		print "<script>";
			print " self.location='../login/?status=expired';"; 
		print "</script>";
		exit;
	}

}

function backoff(){
		print "<script>";
			print " self.location='../dashboard/?denied;"; 
		print "</script>";
}




?>