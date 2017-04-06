 <?php
    require_once "../includes/initiate.php";
    page_permission("my_porfile");
    sns_header('My Profile');
?>

<div id="branch-profile" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-staff"><span class="inlineicon my-profile-mini">My Profile</span></div>
<div class="panel-body">
<ol class="breadcrumb link-staff">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../staff/">Staff Members</a></li>
  <li class="active">My Profile</li>
</ol>

<div class="row">
<div class="col-md-2">
<div class="profile_page_pic text-center"><?php echo staff_img("$_SESSION[id]","128px");?></div>
</div>

<div class="col-md-10">
<table class="table table-striped link-staff"><tbody>
    <tr><td>Full Name:</td><td><a class="staff"><?php echo staff_info("full_name",$_SESSION['id']);?></a></td></tr>
    <tr><td>Title:</td><td><?php echo staff_info("title",$_SESSION['id']);?></td></tr>
    <tr><td>First Name:</td><td><?php echo staff_info("first_name",$_SESSION['id']);?></td></tr>
    <tr><td>Last Name:</td><td><?php echo staff_info("last_name",$_SESSION['id']);?></td></tr>
    <tr><td>Registration ID:</td><td><?php echo staff_info("id",$_SESSION['id']);?></td></tr>
    <tr><td>Access Level:</td><td><?php echo staff_info("access_level",$_SESSION['id']);?></td></tr>
    <tr><td>Rank:</td><td><?php echo access_level2rank(staff_info("access_level",$_SESSION['id']));?></td></tr>
    <tr><td>Branch ID:</td><td><?php echo "$global_permission->guardian_short_name"; echo staff_info("branch",$_SESSION['id']);?></td></tr>
    <tr><td>Designated Branch:</td><td><?php echo branch_name(staff_info("branch",$_SESSION['id']));?></td></tr>
    <tr><td>User ID:</td><td><?php echo staff_info("userid",$_SESSION['id']);?></td></tr>
    <tr><td>Password:</td><td>*******</td></tr>
    <tr><td>Contact Number:</td><td><?php echo staff_info("contact",$_SESSION['id']);?></td></tr>
    <tr><td>Mobile Number:</td><td><?php echo staff_info("mobile",$_SESSION['id']);?></td></tr>
    <tr><td>Skype:</td><td><?php echo staff_info("skype",$_SESSION['id']);?></td></tr>
    <tr><td>Personal Address:</td><td><?php echo staff_info("address",$_SESSION['id']);?></td></tr>
    <tr><td>Last Activity:</td><td><?php echo last_update(1,"staff_info");?></td></tr>
    <tr><td>Log:</td><td><?php echo no_of_actions($_SESSION['id']);?> activities so far.</td></tr>
</tbody></table>
</div>
</div>

    <a class="btn btn-default formbutton theme-staff" href="edit-my-profile<?php echo "$extension";?>">edit profile</a>

    <div class="panel panel-default push_low">
    <div class="panel-heading themde-staff">Recent Activity</div>
    <div class="panel-body panel-log">
    <?php 
    $sql=mysqli_query($con, "select * from p_logs where user='$_SESSION[id]' order by id desc limit 5")or die(mysqli_error());
    while($display_log=mysqli_fetch_array($sql)){
    ?>
    <li><?php echo $display_log['action']?> at <?php echo display_time("$display_log[at]");?></li>
    <?php }?>
    </div>
    </div>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>