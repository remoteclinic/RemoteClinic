<?php
	require_once "../pre-includes/all.php"; 
	include "../includes/logs.php";

write_log("$_SESSION[id]","LoggedOut","staff","10");

session_unset("id");
session_unset("branch");
session_unset("session_id");
session_unset("today");
session_unset("access_level");
session_unset("last_update");
session_unset("unique_code");

$current_time=date('Y-m-d H:i:s');

     print "<script>";
	        print " self.location='../login/?status=signout';"; 
          print "</script>";

?>