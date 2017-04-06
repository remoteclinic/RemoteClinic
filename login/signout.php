<?php
	require_once "../pre-includes/all.php"; 
	include "../includes/logs.php";

	write_log("$_SESSION[id]","LoggedOut","staff","10");
	
    print "<script>";
	        print " self.location='../login/?status=signout';"; 
	print "</script>";

?>