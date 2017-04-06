<?php
	require_once "../includes/initiate.php";
	page_permission("global_settings");
	sns_header('Setttings');
?>

<div id="branch-global-settings" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-branches"><span class="inlineicon settings-mini">Settings</span></div>
<div class="panel-body">
<ol class="breadcrumb link-branches">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../clinics/">Clinics</a></li>
  <li class="active">Settings</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$hasError=false;
	
	$current_time=date('Y-m-d H:i:s');
	$updated_by=staff_info('id');
	
	$portal_name=friendly($_POST['portal_name']);
	$guardian_short_name=friendly($_POST['guardian_short_name']);
	$guardian_name=friendly($_POST['guardian_name']);
	$access_level_5=friendly($_POST['access_level_5']);
	$access_level_4=friendly($_POST['access_level_4']);
	$access_level_3=friendly($_POST['access_level_3']);
	$access_level_2=friendly($_POST['access_level_2']);
	$access_level_1=friendly($_POST['access_level_1']);
	$charge_mode_a=friendly($_POST['charge_mode_a']);
	$charge_mode_b=friendly($_POST['charge_mode_b']);
	$charge_mode_c=friendly($_POST['charge_mode_c']);
	$charge_mode_d=friendly($_POST['charge_mode_d']);

	$register_patient=$_POST['register_patient'];
	$prescribe_patient=$_POST['prescribe_patient'];
	$patients_directory=$_POST['patients_directory'];
	$pending_prescriptions=$_POST['pending_prescriptions'];
	$add_staff=$_POST['add_staff'];
	$staff_directory=$_POST['staff_directory'];
	$my_porfile=$_POST['my_porfile'];
	$staff_profile=$_POST['staff_profile'];
	$add_branch=$_POST['add_branch'];
	$branches_directory=$_POST['branches_directory'];
	$global_settings=$_POST['global_settings'];
	$introduce_medicine=$_POST['introduce_medicine'];
	$update_stock=$_POST['update_stock'];
	$consumed_stock_local=$_POST['consumed_stock_local'];
	$consumed_stock_global=$_POST['consumed_stock_global'];
	
	$opening_time=$_POST['opening_time'];
	$closing_time=$_POST['closing_time'];
	$during_close_time=$_POST['during_close_time'];
	$timezone=$_POST['timezone'];
	$mobile_number=$_POST['mobile_number'];
	$address=$_POST['address'];
	$medicine_directory=$_POST['medicine_directory'];
	$medicine_profile=$_POST['medicine_profile'];
	$patient_contact=$_POST['patient_contact'];
	$patient_email=$_POST['patient_email'];
	$patient_address=$_POST['patient_address'];
	$edit_patient=$_POST['edit_patient'];
	$manage_patients=$_POST['manage_patients'];
	$auto_refresh=$_POST['auto_refresh'];
	$recent_hours=$_POST['recent_hours'];
	$currency=$_POST['currency'];
	if($portal_name==""||$guardian_short_name==""||$guardian_name==""||$access_level_5==""||$access_level_4==""||$access_level_3==""||$access_level_2==""||$access_level_1==""||$charge_mode_a==""||$charge_mode_b==""||$charge_mode_c==""||$charge_mode_d==""){$hasError=true;}

		if($hasError==false){

		mysqli_query($con, "update p_global_permissions set 
		portal_name='$portal_name',
		guardian_short_name='$guardian_short_name',
		guardian_name='$guardian_name',
		access_level_5='$access_level_5',
		access_level_4='$access_level_4',
		access_level_3='$access_level_3',
		access_level_2='$access_level_2',
		access_level_1='$access_level_1',
		charge_mode_a='$charge_mode_a',
		charge_mode_b='$charge_mode_b',
		charge_mode_c='$charge_mode_c',
		charge_mode_d='$charge_mode_d',
		register_patient='$register_patient',
		prescribe_patient='$prescribe_patient',
		patients_directory='$patients_directory',
		pending_prescriptions='$pending_prescriptions',
		add_staff='$add_staff',
		staff_directory='$staff_directory',
		my_porfile='$my_porfile',
		staff_directory='$staff_directory',
		my_porfile='$my_porfile',
		staff_profile='$staff_profile',
		add_branch='$add_branch',
		branches_directory='$branches_directory',
		global_settings='$global_settings',
		introduce_medicine='$introduce_medicine',
		update_stock='$update_stock',
		consumed_stock_local='$consumed_stock_local',
		consumed_stock_global='$consumed_stock_global',
		opening_time='$opening_time',
		closing_time='$closing_time',
		during_close_time='$during_close_time',
		timezone='$timezone',
		mobile_number='$mobile_number',
		address='$address',
		medicine_directory='$medicine_directory',
		medicine_profile='$medicine_profile',
		patient_contact='$patient_contact',
		patient_address='$patient_address',
		patient_email='$patient_email',
		edit_patient='$edit_patient',
		manage_patients='$manage_patients',
		last_update='$current_time',
		auto_refresh='$auto_refresh',
		currency='$currency',
		recent_hours='$recent_hours',
		updated_by='$_SESSION[id]'
		where
		id='1'
		") or die(mysqli_error());



		write_log(staff_info('id'),"updated global settings for $global_permission->portal_name","branch","50");
	
		echo"<div class='alert alert-success' role='alert'>New Global settings has been successfully applied!</span></div>";
		echo"<a class='btn btn-default formbutton theme-branches' href=../dashboard/>Dashboard</a>";
		
		}else{
		echo"<div class='alert alert-danger' role='alert'>Insufficient information. Please provide complete information!</span></div>";
		}


	}else{
?>
<?php $global=mysqli_fetch_object(mysqli_query($con, "select * from p_global_permissions where id='1' "));?>

<form method="post" action="" enctype="multipart/form-data">

	<h3>Global Parametters</h3>
	<div class="form-group"><label>Poratl Name:</label><input class="form-control" name="portal_name" type="text" value="<?php echo $global->portal_name;?>" /><i>portal_name</i></div>
	<div class="form-group"><label>Short Name:</label><input class="form-control" name="guardian_short_name" type="text" value="<?php echo $global->guardian_short_name;?>" /><i>guardian_short_name</i></div>
	<div class="form-group"><label>Guardian Name:</label><input class="form-control" name="guardian_name" type="text" value="<?php echo $global->guardian_name;?>" /><i>guardian_name</i></div>
    <hr/>

	<h3>Permissions</h3>
	
	<div class="form-group"><label>Register Patient:</label><select class="form-control" name='register_patient'  id='register_patient' size='1' tabindex='1'>
            <option value='<?php echo "$global->register_patient";?>'><?php echo "$global->register_patient";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>register_patient</i></div>

	<div class="form-group"><label>Prescribe Patient/Sign Reports:</label><select class="form-control" name='prescribe_patient'  id='prescribe_patient' size='1' tabindex='1'>
            <option value='<?php echo "$global->prescribe_patient";?>'><?php echo "$global->prescribe_patient";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>prescribe_patient</i></div>
    
	<div class="form-group"><label>Patients Directory:</label><select class="form-control" name='patients_directory'  id='patients_directory' size='1' tabindex='1'>
            <option value='<?php echo "$global->patients_directory";?>'><?php echo "$global->patients_directory";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>patients_directory</i></div>
    
	<div class="form-group"><label>Pending Prescriptions Page:</label><select class="form-control" name='pending_prescriptions'  id='pending_prescriptions' size='1' tabindex='1'>
            <option value='<?php echo "$global->pending_prescriptions";?>'><?php echo "$global->pending_prescriptions";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>pending_prescriptions</i></div>
    
	<div class="form-group"><label>Edit/Delete Patients:</label><select class="form-control" name='edit_patient'  id='edit_patient' size='1' tabindex='1'>
            <option value='<?php echo "$global->edit_patient";?>'><?php echo "$global->edit_patient";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>edit_patient</i></div>

	<div class="form-group"><label>Manage Patients:</label><select class="form-control" name='manage_patients'  id='manage_patients' size='1' tabindex='1'>
            <option value='<?php echo "$global->manage_patients";?>'><?php echo "$global->manage_patients";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>manage_patients</i></div>    
    
	<div class="form-group"><label>Add/Edit Staff Member:</label><select class="form-control" name='add_staff'  id='add_staff' size='1' tabindex='1'>
            <option value='<?php echo "$global->add_staff";?>'><?php echo "$global->add_staff";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>add_staff</i></div>
    
	<div class="form-group"><label>Staff Directory:</label><select class="form-control" name='staff_directory'  id='staff_directory' size='1' tabindex='1'>
            <option value='<?php echo "$global->staff_directory";?>'><?php echo "$global->staff_directory";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>staff_directory</i></div>
    
	<div class="form-group"><label>My Profile:</label><select class="form-control" name='my_porfile'  id='my_porfile' size='1' tabindex='1'>
            <option value='<?php echo "$global->my_porfile";?>'><?php echo "$global->my_porfile";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>my_porfile</i></div>                    
    
	<div class="form-group"><label>Staff Profile:</label><select class="form-control" name='staff_profile'  id='staff_profile' size='1' tabindex='1'>
            <option value='<?php echo "$global->staff_profile";?>'><?php echo "$global->staff_profile";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>staff_profile</i></div>                    
    
	<div class="form-group"><label>Add/Edit Branch:</label><select class="form-control" name='add_branch'  id='add_branch' size='1' tabindex='1'>
            <option value='<?php echo "$global->add_branch";?>'><?php echo "$global->add_branch";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>add_branch</i></div>                    
    
	<div class="form-group"><label>Branches Directory:</label><select class="form-control" name='branches_directory'  id='branches_directory' size='1' tabindex='1'>
            <option value='<?php echo "$global->my_porfile";?>'><?php echo "$global->branches_directory";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>branches_directory</i></div>                    
    
	<div class="form-group"><label>Global Settings:</label><select class="form-control" name='global_settings'  id='global_settings' size='1' tabindex='1'>
            <option value='<?php echo "$global->global_settings";?>'><?php echo "$global->global_settings";?> (Current)</option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>global_settings</i></div>                    
    
	<div class="form-group"><label>Introduce Medicine:</label><select class="form-control" name='introduce_medicine'  id='introduce_medicine' size='1' tabindex='1'>
            <option value='<?php echo "$global->introduce_medicine";?>'><?php echo "$global->introduce_medicine";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>introduce_medicine</i></div>                    
    
	<div class="form-group"><label>Update Stock:</label><select class="form-control" name='update_stock'  id='update_stock' size='1' tabindex='1'>
            <option value='<?php echo "$global->update_stock";?>'><?php echo "$global->update_stock";?> (Current)</option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>update_stock</i></div>                    

    
	<div class="form-group"><label>Consumed Stock (Local):</label><select class="form-control" name='consumed_stock_local'  id='consumed_stock_local' size='1' tabindex='1'>
            <option value='<?php echo "$global->consumed_stock_local";?>'><?php echo "$global->consumed_stock_local";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>consumed_stock_local</i></div>                    

    
	<div class="form-group"><label>Consumed Stock (Global):</label><select class="form-control" name='consumed_stock_global'  id='consumed_stock_global' size='1' tabindex='1'>
            <option value='<?php echo "$global->consumed_stock_global";?>'><?php echo "$global->consumed_stock_global";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>consumed_stock_global</i></div>                    
    
	<div class="form-group"><label>Medicine Directory:</label><select class="form-control" name='medicine_directory'  id='medicine_directory' size='1' tabindex='1'>
            <option value='<?php echo "$global->medicine_directory";?>'><?php echo "$global->medicine_directory";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>medicine_directory</i></div>   
    
	<div class="form-group"><label>Medicine Profile:</label><select class="form-control" name='medicine_profile'  id='medicine_profile' size='1' tabindex='1'>
            <option value='<?php echo "$global->medicine_profile";?>'><?php echo "$global->medicine_profile";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>medicine_profile</i></div>   
    <hr/>
	<h3>Global Settings</h3>
   
	<div class="form-group"><label>Opening Time for Offices:</label><select class="form-control" name='opening_time' class="inputOne"  id='opening_time' size='1' tabindex='8'>
            <option selected value='<?php echo "$global->opening_time";?>'><?php echo "$global->opening_time";?>:00 (Current)</option>
            <option value='00'>00:00</option>
            <option value='00'>00:00</option>
            <option value='01'>01:00</option>
            <option value='02'>02:00</option>
            <option value='03'>03:00</option>
            <option value='04'>04:00</option>
            <option value='05'>05:00</option>
            <option value='06'>06:00</option>
            <option value='07'>07:00</option>
            <option value='08'>08:00</option>
            <option value='09'>09:00</option>
            <option value='10'>10:00</option>
            <option value='11'>11:00</option>
            <option value='12'>12:00</option>
            <option value='13'>13:00</option>
            <option value='14'>14:00</option>
            <option value='15'>15:00</option>
            <option value='16'>16:00</option>
            <option value='17'>17:00</option>
            <option value='18'>18:00</option>
            <option value='19'>19:00</option>
            <option value='20'>20:00</option>
            <option value='21'>21:00</option>
            <option value='22'>22:00</option>
            <option value='23'>23:00</option>
          </select><i>24 HRS Format - opening_time</i></div>                    

    
	<div class="form-group"><label>Closing Time for Offices:</label><select class="form-control" name='closing_time' class="inputOne"  id='closing_time' size='1' tabindex='8'>
            <option selected value='<?php echo "$global->closing_time";?>'><?php echo "$global->closing_time";?>:00 (Current)</option>
            <option value='00'>00:00</option>
            <option value='01'>01:00</option>
            <option value='02'>02:00</option>
            <option value='03'>03:00</option>
            <option value='04'>04:00</option>
            <option value='05'>05:00</option>
            <option value='06'>06:00</option>
            <option value='07'>07:00</option>
            <option value='08'>08:00</option>
            <option value='09'>09:00</option>
            <option value='10'>10:00</option>
            <option value='11'>11:00</option>
            <option value='12'>12:00</option>
            <option value='13'>13:00</option>
            <option value='14'>14:00</option>
            <option value='15'>15:00</option>
            <option value='16'>16:00</option>
            <option value='17'>17:00</option>
            <option value='18'>18:00</option>
            <option value='19'>19:00</option>
            <option value='20'>20:00</option>
            <option value='21'>21:00</option>
            <option value='22'>22:00</option>
            <option value='23'>23:00</option>
          </select><i>24 HRS Format - closing_time</i></div>                    

    
	<div class="form-group"><label>Required Access Level during non-active hours:</label><select class="form-control" name='during_close_time'  id='during_close_time' size='1' tabindex='1'>
            <option value='<?php echo "$global->during_close_time";?>'><?php echo "$global->during_close_time";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>during_close_time</i></div>                    

    
	<div class="form-group"><label>Time Zone:</label><select class="form-control" name='timezone'  id='timezone' size='1' tabindex='1'>
	<option value='<?php echo "$global->timezone";?>'><?php echo "$global->timezone";?> (Current)</option>
<option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
<option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
<option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
<option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
<option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
<option value="America/Anchorage">(GMT-09:00) Alaska</option>
<option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
<option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
<option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
<option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
<option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
<option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
<option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
<option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
<option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
<option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
<option value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
<option value="America/Havana">(GMT-05:00) Cuba</option>
<option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
<option value="America/Caracas">(GMT-04:30) Caracas</option>
<option value="America/Santiago">(GMT-04:00) Santiago</option>
<option value="America/La_Paz">(GMT-04:00) La Paz</option>
<option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
<option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
<option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
<option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
<option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
<option value="America/Araguaina">(GMT-03:00) UTC-3</option>
<option value="America/Montevideo">(GMT-03:00) Montevideo</option>
<option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
<option value="America/Godthab">(GMT-03:00) Greenland</option>
<option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
<option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
<option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
<option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
<option value="Atlantic/Azores">(GMT-01:00) Azores</option>
<option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
<option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
<option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
<option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
<option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
<option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
<option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
<option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
<option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
<option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
<option value="Asia/Beirut">(GMT+02:00) Beirut</option>
<option value="Africa/Cairo">(GMT+02:00) Cairo</option>
<option value="Asia/Gaza">(GMT+02:00) Gaza</option>
<option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
<option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
<option value="Europe/Minsk">(GMT+02:00) Minsk</option>
<option value="Asia/Damascus">(GMT+02:00) Syria</option>
<option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
<option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
<option value="Asia/Tehran">(GMT+03:30) Tehran</option>
<option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
<option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
<option value="Asia/Kabul">(GMT+04:30) Kabul</option>
<option value="Asia/Karachi">(GMT+5:00) Lahore, Islamabad, Karachi</option>
<option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
<option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
<option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
<option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
<option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
<option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
<option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
<option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
<option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
<option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
<option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
<option value="Australia/Perth">(GMT+08:00) Perth</option>
<option value="Australia/Eucla">(GMT+08:45) Eucla</option>
<option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
<option value="Asia/Seoul">(GMT+09:00) Seoul</option>
<option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
<option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
<option value="Australia/Darwin">(GMT+09:30) Darwin</option>
<option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
<option value="Australia/Hobart">(GMT+10:00) Hobart</option>
<option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
<option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
<option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
<option value="Asia/Magadan">(GMT+11:00) Magadan</option>
<option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
<option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
<option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
<option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
<option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
<option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
<option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
</select><i></i></div>
	<div class="form-group"><label>Auto Refresh:</label><select class="form-control" name='auto_refresh' class="inputOne"  id='auto_refresh' size='1' tabindex='8'>
            <option selected value='<?php echo "$global->auto_refresh";?>'><?php echo "$global->auto_refresh";?> (Current)</option>
            <option value='15'>15 Seconds</option>
            <option value='30'>30 Seconds</option>
            <option value='60'>1 Minute</option>
            <option value='120'>2 Minutes</option>
            <option value='180'>3 Minutes</option>
            <option value='300'>5 Minutes</option>
            <option value='600'>10 Minutes</option>
            <option value='never'>never</option>
          </select><i>Recent Activities and Pending Reports</i></div> 

	<div class="form-group"><label>Recent Activities from last:</label><select class="form-control" name='recent_hours'  id='recent_hours' size='1' tabindex='1'>
            <option value='<?php echo "$global->recent_hours";?>'><?php echo "$global->recent_hours";?> (Current)</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
            <option value='11'>11</option>
            <option value='12'>12</option>
            <option value='13'>13</option>
            <option value='14'>14</option>
            <option value='15'>15</option>
            <option value='16'>16</option>
            <option value='17'>17</option>
            <option value='18'>18</option>
            <option value='19'>19</option>
            <option value='20'>20</option>
            <option value='21'>21</option>
            <option value='22'>22</option>
            <option value='23'>23</option>
            <option value='24'>24</option>
            <option value='36'>36</option>
            <option value='48'>48</option>
            <option value='168'>168</option>
    </select><i>HOURS</i></div>                    

	<hr/>
	<h3>Define Variables</h3>
	<div class="form-group"><label>Access Level 5:</label><input class="form-control" name="access_level_5" type="text" value="<?php echo $global->access_level_5;?>" /><i>access_level_5</i></div>
	<div class="form-group"><label>Access Level 4:</label><input class="form-control" name="access_level_4" type="text" value="<?php echo $global->access_level_4;?>" /><i>access_level_4</i></div>
	<div class="form-group"><label>Access Level 3:</label><input class="form-control" name="access_level_3" type="text" value="<?php echo $global->access_level_3;?>" /><i>access_level_3</i></div>
	<div class="form-group"><label>Access Level 2:</label><input class="form-control" name="access_level_2" type="text" value="<?php echo $global->access_level_2;?>" /><i>access_level_2</i></div>
	<div class="form-group"><label>Access Level 1:</label><input class="form-control" name="access_level_1" type="text" value="<?php echo $global->access_level_1;?>" /><i>access_level_1</i></div>
	<div class="form-group"><label>Charge Mode A:</label><input class="form-control" name="charge_mode_a" type="text" value="<?php echo $global->charge_mode_a;?>" /><i>charge_mode_a</i></div>
	<div class="form-group"><label>Charge Mode B:</label><input class="form-control" name="charge_mode_b" type="text" value="<?php echo $global->charge_mode_b;?>" /><i>charge_mode_b</i></div>
	<div class="form-group"><label>Charge Mode C:</label><input class="form-control" name="charge_mode_c" type="text" value="<?php echo $global->charge_mode_c;?>" /><i>charge_mode_c</i></div>
	<div class="form-group"><label>Charge Mode D:</label><input class="form-control" name="charge_mode_d" type="text" value="<?php echo $global->charge_mode_d;?>" /><i>charge_mode_d</i></div>
	<div class="form-group"><label>Currency:</label><select class="form-control" name="currency" size="1">
						<option value="<?php echo $global->currency;?>" selected><?php echo $global->currency;?></option>
						<option value="USD">United States Dollars USD</option>
						<option value="EUR">Euro EUR</option>
						<option value="GBP">United Kingdom Pounds GBP</option>
						<option value="CAD">Canada Dollars CAD</option>
						<option value="AUD">Australia Dollars AUD</option>
						<option value="JPY">Japan Yen JPY</option>
						<option value="INR">India Rupees INR</option>
						<option value="NZD">New Zealand Dollars NZD</option>
						<option value="CHF">Switzerland Francs CHF</option>
						<option value="ZAR">South Africa Rand ZAR</option>
						<option value="EUR">-- Top 85 Currencies: --</option>
						<option value="AFA">Afghanistan Afghanis AFA</option>
						<option value="ALL">Albania Leke ALL</option>
						<option value="DZD">Algeria Dinars DZD</option>
						<option value="USD">America (United States) Dollars USD</option>
						<option value="ARS">Argentina Pesos ARS</option>
						<option value="AUD">Australia Dollars AUD</option>
						<option value="ATS">Austria Schillings ATS*</option>
						<option value="BSD">Bahamas Dollars BSD</option>
						<option value="BHD">Bahrain Dinars BHD</option>
						<option value="BDT">Bangladesh Taka BDT</option>
						<option value="BBD">Barbados Dollars BBD</option>
						<option value="BEF">Belgium Francs BEF*</option>
						<option value="BMD">Bermuda Dollars BMD</option>
						<option value="BRL">Brazil Reais BRL</option>
						<option value="BGN">Bulgaria Leva BGN</option>
						<option value="CAD">Canada Dollars CAD</option>
						<option value="XOF">CFA BCEAO Francs XOF</option>
						<option value="XAF">CFA BEAC Francs XAF</option>
						<option value="CLP">Chile Pesos CLP</option>
						<option value="CNY">China Yuan Renminbi CNY</option>
						<option value="COP">Colombia Pesos COP</option>
						<option value="XPF">Comptoirs Fran&ccedil;ais du Pacifique Francs</option>
						<option value="CRC">Costa Rica Colones CRC</option>
						<option value="HRK">Croatia Kuna HRK</option>
						<option value="CYP">Cyprus Pounds CYP</option>
						<option value="CZK">Czech Republic Koruny CZK</option>
						<option value="DKK">Denmark Kroner DKK</option>
						<option value="DEM">Deutsche (Germany) Marks DEM*</option>
						<option value="DOP">Dominican Republic Pesos DOP</option>
						<option value="NLG">Dutch (Netherlands) Guilders NLG*</option>
						<option value="XCD">Eastern Caribbean Dollars XCD</option>
						<option value="EGP">Egypt Pounds EGP</option>
						<option value="EEK">Estonia Krooni EEK</option>
						<option value="EUR">Euro EUR</option>
						<option value="FJD">Fiji Dollars FJD</option>
						<option value="FIM">Finland Markkaa FIM*</option>
						<option value="FRF">France Francs FRF*</option>
						<option value="DEM">Germany Deutsche Marks DEM*</option>
						<option value="GRD">Greece Drachmae GRD*</option>
						<option value="NLG">Holland (Netherlands) Guilders NLG*</option>
						<option value="HKD">Hong Kong Dollars HKD</option>
						<option value="HUF">Hungary Forint HUF</option>
						<option value="ISK">Iceland Kronur ISK</option>
						<option value="XDR">IMF Special Drawing Right XDR</option>
						<option value="INR">India Rupees INR</option>
						<option value="IDR">Indonesia Rupiahs IDR</option>
						<option value="IRR">Iran Rials IRR</option>
						<option value="IQD">Iraq Dinars IQD</option>
						<option value="IEP">Ireland Pounds IEP*</option>
						<option value="ILS">Israel New Shekels ILS</option>
						<option value="ITL">Italy Lire ITL*</option>
						<option value="JMD">Jamaica Dollars JMD</option>
						<option value="JPY">Japan Yen JPY</option>
						<option value="JOD">Jordan Dinars JOD</option>
						<option value="KES">Kenya Shillings KES</option>
						<option value="KRW">Korea (South) Won KRW</option>
						<option value="KWD">Kuwait Dinars KWD</option>
						<option value="LBP">Lebanon Pounds LBP</option>
						<option value="LUF">Luxembourg Francs LUF*</option>
						<option value="MYR">Malaysia Ringgits MYR</option>
						<option value="MTL">Malta Liri MTL</option>
						<option value="MUR">Mauritius Rupees MUR</option>
						<option value="MXN">Mexico Pesos MXN</option>
						<option value="MAD">Morocco Dirhams MAD</option>
						<option value="NLG">Netherlands Guilders NLG*</option>
						<option value="NZD">New Zealand Dollars NZD</option>
						<option value="NOK">Norway Kroner NOK</option>
						<option value="OMR">Oman Rials OMR</option>
						<option value="PKR">Pakistan Rupees PKR</option>
						<option value="PEN">Peru Nuevos Soles PEN</option>
						<option value="PHP">Philippines Pesos PHP</option>
						<option value="PLN">Poland Zlotych PLN</option>
						<option value="PTE">Portugal Escudos PTE*</option>
						<option value="QAR">Qatar Riyals QAR</option>
						<option value="ROL">Romania Lei ROL</option>
						<option value="RUB">Russia Rubles RUB</option>
						<option value="SAR">Saudi Arabia Riyals SAR</option>
						<option value="SGD">Singapore Dollars SGD</option>
						<option value="SKK">Slovakia Koruny SKK</option>
						<option value="SIT">Slovenia Tolars SIT</option>
						<option value="ZAR">South Africa Rand ZAR</option>
						<option value="KRW">South Korea Won KRW</option>
						<option value="ESP">Spain Pesetas ESP*</option>
						<option value="XDR">Special Drawing Rights (IMF) XDR</option>
						<option value="LKR">Sri Lanka Rupees LKR</option>
						<option value="SDD">Sudan Dinars SDD</option>
						<option value="SEK">Sweden Kronor SEK</option>
						<option value="CHF">Switzerland Francs CHF</option>
						<option value="TWD">Taiwan New Dollars TWD</option>
						<option value="THB">Thailand Baht THB</option>
						<option value="TTD">Trinidad and Tobago Dollars TTD</option>
						<option value="TND">Tunisia Dinars TND</option>
						<option value="TRY">Turkey New Lira TRY</option>
						<option value="TRL">Turkey Lira TRL*</option>
						<option value="AED">United Arab Emirates Dirhams AED</option>
						<option value="GBP">United Kingdom Pounds GBP</option>
						<option value="USD">United States Dollars USD</option>
						<option value="VEB">Venezuela Bolivares VEB</option>
						<option value="VND">Vietnam Dong VND</option>
						<option value="ZMK">Zambia Kwacha ZMK</option>
						<option value="EUR">-- Special Units: --</option>
						<option value="XAF">CFA BEAC Francs XAF</option>
						<option value="XOF">CFA BCEAO Francs XOF</option>
						<option value="XPF">Comptoirs Fran&ccedil;ais du Pacifique Francs</option>
						<option value="XCD">Eastern Caribbean Dollars XCD</option>
						<option value="EUR">Euro EUR</option>
						<option value="XDR">IMF Special Drawing Rights XDR</option>
					</select><i>currency</i></div>




    <hr/>
	<h3>Staff Privacy</h3>
	<div class="form-group"><label>Mobile# visibility:</label><select class="form-control" name='mobile_number'  id='mobile_number' size='1' tabindex='1'>
            <option value='<?php echo "$global->mobile_number";?>'><?php echo "$global->mobile_number";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
            <option value='6'>6 - <?php echo access_level2rank(6);?></option>
    </select><i>mobile_number</i></div>
	<div class="form-group"><label>Address visibility:</label><select class="form-control" name='address'  id='address' size='1' tabindex='1'>
            <option value='<?php echo "$global->address";?>'><?php echo "$global->address";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>address</i></div>
    <hr/>
	<h3>Patient Privacy</h3>
	<div class="form-group"><label>Contact# visibility:</label><select class="form-control" name='patient_contact'  id='patient_contact' size='1' tabindex='1'>
            <option value='<?php echo "$global->patient_contact";?>'><?php echo "$global->patient_contact";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>patient_contact</i></div>
	<div class="form-group"><label>Address visibility:</label><select class="form-control" name='patient_address'  id='patient_address' size='1' tabindex='1'>
            <option value='<?php echo "$global->patient_address";?>'><?php echo "$global->patient_address";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>patient_address</i></div>
	<div class="form-group"><label>Email visibility:</label><select class="form-control" name='patient_email'  id='patient_email' size='1' tabindex='1'>
            <option value='<?php echo "$global->patient_email";?>'><?php echo "$global->patient_email";?> (Current)</option>
            <option value='1'>1 - <?php echo access_level2rank(3);?></option>
            <option value='2'>2 - <?php echo access_level2rank(3);?></option>
            <option value='3'>3 - <?php echo access_level2rank(3);?></option>
            <option value='4'>4 - <?php echo access_level2rank(4);?></option>
            <option value='5'>5 - <?php echo access_level2rank(5);?></option>
    </select><i>patient_email</i></div>
    <hr/>
    <p>Last update: <?php echo display_time($global->last_update);?> by <a href="../staff/profile.php?id=<?php echo "$global->updated_by";?>"><?php echo staff_info("full_name","$global->updated_by");?></a></p>
	<input class="btn btn-default formbutton theme-branches"  name="submit" class="formbutton branches" type="submit" value="Update">
</form>

<?php }?>
</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>