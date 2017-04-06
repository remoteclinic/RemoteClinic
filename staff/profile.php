<?php
    require_once "../includes/initiate.php";
    page_permission("staff_profile");

	if(isset($_GET['id'])){$id=$_GET['id'];
        //action
	}else{
	   $id=$_SESSION['id'];
	}
    $profile=mysqli_fetch_object(mysqli_query($con, "select * from p_staff_dir where id='$id' "));

    sns_header( $profile->full_name );
?>

<?php ?>
<div id="staff-profile" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-staff"><span class="inlineicon staff-mini"><?php echo $profile->full_name;?>'s Profile</span></div>
<div class="panel-body">
<ol class="breadcrumb link-staff">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../staff/">Staff Members</a></li>
  <li class="active">Profile</li>
</ol>

<div class="row">
<div class="col-md-2">
<div class="profile_page_pic text-center"><?php echo staff_img($profile->id,"128px");?></div>
</div>

<div class="col-md-10">
<table class="table table-striped link-staff"><tbody>
    <tr><td>Full Name:</td><td><a class="staff"><?php echo $profile->full_name;?></a></td></tr>
    <tr><td>Title:</td><td><?php echo $profile->title;?></td></tr>
    <tr><td>First Name:</td><td><?php echo $profile->first_name;?></td></tr>
    <tr><td>Last Name:</td><td><?php echo $profile->last_name;?></td></tr>
    <tr><td>Registration ID:</td><td><?php echo $profile->id;?></td></tr>
    <tr><td>Access Level:</td><td><?php echo $profile->access_level;?></td></tr>
    <tr><td>Rank:</td><td><?php echo access_level2rank($profile->access_level);?></td></tr>
    <tr><td>Branch ID:</td><td><?php echo "$global_permission->guardian_short_name"; echo $profile->branch;?></td></tr>
    <tr><td>Designated Branch:</td><td><?php echo branch_name($profile->branch);?></td></tr>
    <tr><td>User ID:</td><td><?php echo $profile->userid;?></td></tr>
    <tr><td>Contact Number:</td><td><?php echo $profile->contact;?></td></tr>
    <?php if(display_permission("mobile_number")==true){?><tr><td>Mobile Number:</td><td><?php echo $profile->mobile;?></td></tr><?php }?>
    <tr><td>Skype:</td><td><?php echo $profile->skype;?></td></tr>
    <?php if(display_permission("address")==true){?><tr><td>Personal Address:</td><td><?php echo $profile->address;?></td></tr><?php }?>
    <tr><td>Last Activity:</td><td><?php echo display_time($profile->last_update);?></td></tr>
    <tr><td>Log:</td><td><?php echo no_of_actions($profile->id);?> activities so far</td></tr>
    <tr><td>Registered by:</td><td><a class="staff" href="profile<?php echo $extension;?>?id=<?php echo staff_info("registered_by",$profile->id);?>"><?php echo staff_info("full_name",staff_info("registered_by",$profile->id));?></a></td></tr>
</tbody></table>
</div>
</div>
    
	<?php if(display_permission("add_staff")==true){?>
    <a class="btn btn-default formbutton theme-staff" href="edit.php?id=<?php echo "$id";?>">Edit Profile</a>
    <?php }?>

    <div class="panel panel-default push_low">
    <div class="panel-heading themde-staff">Recent Activity</div>
    <div class="panel-body panel-log">
	<?php 
    $log_count = 0;
	$sql=mysqli_query($con, "select * from p_logs where user='$profile->id' order by id desc limit 5")or die(mysqli_error());
	while($display_log=mysqli_fetch_array($sql)){ $log_count++;
	?>
    <li><?php echo $display_log['action']?> at <?php echo display_time("$display_log[at]");?></li>
    <?php }?>
    <?php if($log_count==0){ echo "<p>No recent activity!</p>"; }?>
    </div>
    </div>
    <?php if($log_count!=0){ ?>
        <a class="btn btn-default formbutton theme-stsaff norm" href="staff-log.php?id=<?php echo "$id";?>">View Log</a>
    <?php } ?>
	
</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>