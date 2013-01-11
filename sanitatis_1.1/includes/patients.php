<?php
/////////////////////////////////
function patient_info($query,$id){	
$call=mysql_fetch_object(mysql_query("select * from p_patients_dir where id='$id'"));
return $call->$query;
}
/////////////////////////////////

function report_info($query,$id){
$call=mysql_fetch_object(mysql_query("select * from p_reports where id='$id'"));
return $call->$query;	
}
/////////////////////////////////
function register_patient($gender,$age,$serial,$name,$contact,$email,$weight,$profession,$ref_contact,$address){
	$current_time=date('Y-m-d H:i:s');
	$branch=$_SESSION['branch'];
	$physician=$_SESSION['id'];

	$friendly_name= str_replace("",", ",$name);

	if($name==""){return false;}
	if($contact==""){$contact="n/a";}
	if($email==""){$email="n/a";}
	if($weight==""){$weight="n/a";}
	if($profession==""){$profession="n/a";}
	if($ref_contact==""){$ref_contact="n/a";}
	if($address==""){$address="n/a";}

	mysql_query("insert into p_patients_dir set 
		gender='$gender',
		age='$age',
		serial='$serial',		
		name='$name',		
		contact='$contact',		
		email='$email',		
		weight='$weight',		
		profession='$profession',		
		ref_contact='$ref_contact',		
		address='$address',		
		branch='$branch',
		physician='$physician',
		friendly_name='$friendly_name',
		last_update='$current_time'
	") or die(mysql_error());
	
	$get_id=mysql_insert_id();
	
	return $get_id;

	
}
/////////////////////////////////
function edit_patient($id,$gender,$age,$serial,$name,$contact,$email,$weight,$profession,$ref_contact,$address){
	$current_time=date('Y-m-d H:i:s');
	$branch=$_SESSION['branch'];
	$physician=$_SESSION['id'];

	$friendly_name= str_replace("",", ",$name);

	if($name==""){return false;}
	if($contact==""){$contact="n/a";}
	if($email==""){$email="n/a";}
	if($weight==""){$weight="n/a";}
	if($profession==""){$profession="n/a";}
	if($ref_contact==""){$ref_contact="n/a";}
	if($address==""){$address="n/a";}

	mysql_query("update p_patients_dir set 
		gender='$gender',
		age='$age',
		serial='$serial',		
		name='$name',		
		contact='$contact',		
		email='$email',		
		weight='$weight',		
		profession='$profession',		
		ref_contact='$ref_contact',		
		address='$address',		
		branch='$branch',
		physician='$physician',
		friendly_name='$friendly_name',
		last_update='$current_time'
		where
		id='$id'
	") or die(mysql_error());
		
	return true;

	
}
/////////////////////////////////
function compose_report($patient,$charge,$fever,$blood_pressure,$symptoms){
	global $global_permission;
	$current_time=date('Y-m-d H:i:s');
	$composed_by=$_SESSION['id'];
	$branch=$_SESSION['branch'];
	$patient_name=patient_info("name",$patient);

	if($symptoms==""){return false;}
	$symptoms=stripslashes(trim($symptoms));
	mysql_query("insert into p_reports set 
		patient='$patient',
		charge='$charge',
		fever='$fever',		
		blood_pressure='$blood_pressure',		
		symptoms='$symptoms',
		composed_by='$composed_by',
		branch='$branch',
		last_update='$current_time'
	") or die(mysql_error());
	$get_id=mysql_insert_id();

	write_log("$_SESSION[id]","composed the report for $patient_name at $global_permission->guardian_short_name$branch","report","20");

	return $get_id;

}
/////////////////////////////////
function engage_the_report($id){
	$current_time=date('Y-m-d H:i:s');
	$engaged_by=$_SESSION['id'];

	mysql_query("update p_reports set
	engaged_by='$engaged_by',
	last_update='$current_time'
	where
	id='$id'
	") or die(mysql_error());

	write_log("$_SESSION[id]","has engaged the report $id","report","10");
	return $engaged_by;

}

/////////////////////////////////
function report_attachment($query,$id){
	
	if($query=="exist"){
		$filename = '../media/reports/'.$id.'.zip';
		if (file_exists($filename)) {return true;} 
	}



}
/////////////////////////////////
function prescribe($report_id,$medicine,$doses,$timings,$days,$reply,$notes,$charging_for){
	$current_time=date('Y-m-d H:i:s');
	$physician_id=$_SESSION['id'];
	$branch_code=staff_info("branch",report_info("composed_by",$report_id));
	


	
	//check if medicine should be updated or not
	if($days!=0){
		
		// calculate the total medicine
		if($doses=="1+0+0"){$total=1;}else if($doses=="1+1+0"){$total=2;}else if($doses=="1+1+1"){$total=3;}
		else if($doses=="0+1+0"){$total=1;}else if($doses=="1+0+1"){$total=2;}else if($doses=="0+1+1"){$total=2;}
		else{$total=0;}
		$total=$total*$days;
		
		//check if there is enough medicine in branch's stock
		$getme=mysql_fetch_object(mysql_query("select * from p_stock where code='$medicine' and branch='$branch_code'"));
		$remaining_were=$getme->remaining; 
		if($remaining_were<=$total){return false;}
	
		//if available, then continue
			mysql_query("insert into p_med_record set 
				medicine='$medicine',
				doses='$doses',
				timings='$timings',		
				days='$days',		
				total='$total',
				physician_id='$physician_id',
				report_id='$report_id',
				last_update='$current_time'
			") or die(mysql_error());

		//deduct the medicine from the branch’s stock
		$new_amount=$remaining_were-$total;
			mysql_query("update p_stock set
				remaining='$new_amount',
				last_update='$current_time'
				where
				code='$medicine'
			") or die(mysql_error());



			$notes .="$medicine - $doses ($timings) for $days days<br>";


	}
	mysql_query("update p_reports set
	signed_by='$physician_id',
	reply='$reply',
	notes='$notes',
	charging_for='$charging_for',
	last_update='$current_time'
	where
	id='$report_id'
	") or die(mysql_error());
		return true;	

}
/////////////////////////////////
function count_pending(){
		$getting_total=mysql_query("select * from p_reports where signed_by=''");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function count_local_registered($branch){	
		$getting_total=mysql_query("select * from p_patients_dir where branch='$branch'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function count_reg_patients_staff($staff){
		$getting_total=mysql_query("select * from p_patients_dir where physician='$staff'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function count_signed_reports_staff($staff){
		$getting_total=mysql_query("select * from p_reports where signed_by='$staff'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function delete_single_patient($id){
	$name=patient_info("name",$id);
	mysql_query("delete from p_patients_dir where id='$id'") or die(mysql_error());
	mysql_query("delete from p_reports where patient='$id'") or die(mysql_error());
	write_log("$_SESSION[id]","deleted Patient profile and reports for $name","patient","30");
}
/////////////////////////////////
function count_today_patients($branch){
	$today=date('Y-m-d 0:0:0');
		$getting_total=mysql_query("select * from p_patients_dir where last_update>'$today' and branch='$branch'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function count_today_reports($branch){
	$today=date('Y-m-d 0:0:0');
		$getting_total=mysql_query("select * from p_reports where last_update>'$today' and branch='$branch'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
function count_today_sales($branch){
	$today=date('Y-m-d 0:0:0');
	$sales=0;

	$sql=mysql_query("select * from p_reports where last_update>'$today' and branch='$branch' and signed_by!='' ")or die(mysql_error());
	while($display_reports=mysql_fetch_array($sql)){
		$charge_mode=charge_mode($display_reports['charge']);
		$sales=$display_reports['charging_for']*$charge_mode+$sales;
	}
	
	return $sales;

}
/////////////////////////////////
function count_reports_charge_mode($charge,$branch){
	$today=date('Y-m-d 0:0:0');
		$getting_total=mysql_query("select * from p_reports where last_update>'$today' and charge='$charge' and branch='$branch'");
	 	$getting_total=mysql_num_rows($getting_total);
		return $getting_total;
}
/////////////////////////////////
?>