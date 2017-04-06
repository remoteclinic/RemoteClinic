<?php
include "secuirty.php";
sessions_check();

	include "logs.php";
	include "staff.php";
	include "medicine.php";
	include "patients.php";
	include "branches.php";


// Template Includes
function sns_htmlhead(){
	require_once "../theme/htmlhead.php";
}
function sns_header($title){

	global $global_permission;
	global $extension;

	require_once "../theme/htmlhead.php";
	echo '<title>'.$title.' - '.get_global('portal_name').'</title>';
	require_once "../theme/header.php";

}
function sns_footer(){

	global $global_permission;

	require_once "../theme/footer-navigation.php";
	require_once "../theme/footer.php";
}

function show_recent_hours(){
	if(get_global('recent_hours') > 48):
		$total_hours = get_global('recent_hours');
		$total_hours = 3600 * $total_hours;
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$total_hours");
		return $dtF->diff($dtT)->format('%a days');
	else:
		return get_global('recent_hours').' hours';
	endif;
}

?>