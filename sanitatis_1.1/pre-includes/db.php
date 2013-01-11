<?php
// DATABASE CONNECTION //
@session_start();
$con=mysql_connect("localhost","root","") or die(mysql_error());
$db=mysql_select_db("sns_sanitatis",$con) or die(mysql_error());

?>