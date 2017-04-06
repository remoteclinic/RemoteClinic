<?php

function patient_info($query,$id){	
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_patients_dir where id='$id'"));
	return $call->$query;
}


function report_info($query,$id){
	global $con;

	$call=mysqli_fetch_object(mysqli_query($con, "select * from p_reports where id='$id'"));
	return $call->$query;	
}


function register_patient($gender,$age,$serial,$name,$contact,$email,$weight,$profession,$ref_contact,$address){
	global $con;

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

	mysqli_query($con, "insert into p_patients_dir set 
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
	") or die(mysqli_error());
	
	$get_id=mysqli_insert_id($con);
	
	return $get_id;

	
}


function edit_patient($id,$gender,$age,$serial,$name,$contact,$email,$weight,$profession,$ref_contact,$address){
	global $con;

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

	mysqli_query($con, "update p_patients_dir set 
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
	") or die(mysqli_error());
		
	return true;

	
}


function compose_report($patient,$charge,$fever,$blood_pressure,$symptoms,$engaged_by){
	global $con;
	global $global_permission;

	$current_time=date('Y-m-d H:i:s');
	$composed_by=$_SESSION['id'];
	$branch=$_SESSION['branch'];
	$patient_name=patient_info("name",$patient);

	if($symptoms==""){return false;}
	$symptoms=stripslashes(trim($symptoms));
	mysqli_query($con, "insert into p_reports set 
		patient='$patient',
		charge='$charge',
		fever='$fever',		
		blood_pressure='$blood_pressure',		
		symptoms='$symptoms',
		composed_by='$composed_by',
		engaged_by='$engaged_by',
		branch='$branch',
		last_update='$current_time'
	") or die(mysqli_error());
	$get_id=mysqli_insert_id($con);

	write_log("$_SESSION[id]","created a report for $patient_name at $global_permission->guardian_short_name$branch","report","20");

	return $get_id;

}


function engage_the_report($id){
	global $con;

	$current_time=date('Y-m-d H:i:s');
	$engaged_by=$_SESSION['id'];

	mysqli_query($con, "update p_reports set
	engaged_by='$engaged_by',
	last_update='$current_time'
	where
	id='$id'
	") or die(mysqli_error());

	write_log("$_SESSION[id]","opened the report $id","report","10");
	return $engaged_by;

}



function report_attachment($query,$id){
	
	if($query=="exist"){
		$filename = '../media/reports/'.$id.'.zip';
		if (file_exists($filename)) {return true;} 
	}

}


function prescribe($report_id,$medicine,$doses,$timings,$days,$reply,$notes,$medicine_charge){
	global $con;

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

		$medicine_price = medicine_by_code('price', $medicine);
		$total_checkout_charges = report_info("checkout_charges",$report_id);

		$medicine_price_charged = 0;
		$total_charge = 0;		

		if($medicine_charge=='yes'){
			$total_charge = $medicine_price * $total;
			$total_checkout_charges = $total_charge + $total_checkout_charges;
		}
		//$total_charge = $total_checkout_charges;
		
		//check if there is enough medicine in branch's stock
		$getme=mysqli_fetch_object(mysqli_query($con, "select * from p_stock where code='$medicine' and branch='$branch_code'"));
		$remaining_were=$getme->remaining; 
		if($remaining_were<=$total){return false;}
	
		//if available, then continue
			mysqli_query($con, "insert into p_med_record set 
				medicine='$medicine',
				doses='$doses',
				timings='$timings',		
				days='$days',		
				total='$total',
				physician_id='$physician_id',
				report_id='$report_id',
				total_charge='$total_charge',
				last_update='$current_time'
			") or die(mysqli_error());

		//deduct the medicine from the branch’s stock
		$new_amount=$remaining_were-$total;
			mysqli_query($con, "update p_stock set
				remaining='$new_amount',
				last_update='$current_time'
				where
				code='$medicine'
			") or die(mysqli_error());

			$notes .="$medicine - $doses ($timings) for $days days<br>";


	}
	mysqli_query($con, "update p_reports set
	signed_by='$physician_id',
	reply='$reply',
	notes='$notes',
	checkout_charges='$total_checkout_charges',
	last_update='$current_time'
	where
	id='$report_id'
	") or die(mysqli_error());
		return true;	

}


function count_pending(){
	global $con;

		$getting_total=mysqli_query($con, "select * from p_reports where signed_by=''");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_local_registered($branch){	
	global $con;

		$getting_total=mysqli_query($con, "select * from p_patients_dir where branch='$branch' and last_update > NOW() - INTERVAL 1 DAY ");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_patients($branch,$hours = NULL){
	global $con;
	
	if(!isset($hours)) $hours = 24; 

	if($branch=='global'){
		$getting_total=mysqli_query($con, "select * from p_patients_dir where last_update > NOW() - INTERVAL $hours HOUR");
	}else{
		$getting_total=mysqli_query($con, "select * from p_patients_dir where branch='$branch' and last_update > NOW() - INTERVAL $hours HOUR");
	}

	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_reports($branch,$hours = NULL){
	global $con;
	
	if(!isset($hours)) $hours = 24; 

	if($branch=='global'){
		$getting_total=mysqli_query($con, "select * from p_reports where last_update > NOW() - INTERVAL $hours HOUR");
	}else{		
		$getting_total=mysqli_query($con, "select * from p_reports where branch='$branch' and last_update > NOW() - INTERVAL $hours HOUR");
	}

	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_reg_patients_staff($staff){
	global $con;

		$getting_total=mysqli_query($con, "select * from p_patients_dir where physician='$staff'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_signed_reports_staff($staff){
	global $con;

		$getting_total=mysqli_query($con, "select * from p_reports where signed_by='$staff'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function delete_single_patient($id){
	global $con;

	$name=patient_info("name",$id);
	mysqli_query($con, "delete from p_patients_dir where id='$id'") or die(mysqli_error());
	mysqli_query($con, "delete from p_reports where patient='$id'") or die(mysqli_error());
	write_log("$_SESSION[id]","deleted a Patient profile for $name","patient","30");
}


function count_today_patients($branch,$hours = NULL){
	global $con;

		if(!isset($hours)) $hours = 24; 
		$getting_total=mysqli_query($con, "select * from p_patients_dir where last_update > NOW() - INTERVAL $hours HOUR and branch='$branch'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_today_reports($branch,$hours = NULL){
	global $con;

		if(!isset($hours)) $hours = 24; 
		$getting_total=mysqli_query($con, "select * from p_reports where last_update > NOW() - INTERVAL $hours HOUR  and branch='$branch'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_today_preports($branch,$hours = NULL){
	global $con;

		if(!isset($hours)) $hours = 24; 
		$getting_total=mysqli_query($con, "select * from p_reports where signed_by='' and last_update > NOW() - INTERVAL $hours HOUR  and branch='$branch'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}


function count_today_sales($branch,$hours = NULL){
	global $con;

		if(!isset($hours)) $hours = 24; 
	$sales=0;

	$sql=mysqli_query($con, "select * from p_reports where last_update > NOW() - INTERVAL $hours HOUR and branch='$branch' and signed_by!='' ")or die(mysqli_error());
	while($display_reports=mysqli_fetch_array($sql)){
		$sales = $sales + $display_reports['checkout_charges'];
	}
	
	return $sales;

}


function count_reports_charge_mode($charge,$branch,$hours = NULL){
	global $con;

		if(!isset($hours)) $hours = 24; 

		$getting_total=mysqli_query($con, "select * from p_reports where last_update > NOW() - INTERVAL $hours HOUR and charge='$charge' and branch='$branch'");
	 	$getting_total=mysqli_num_rows($getting_total);
		return $getting_total;
}



?>