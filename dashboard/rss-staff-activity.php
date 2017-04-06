<?php 
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
?>

<?php 
$display_logins_count=0;
$sql=mysqli_query($con, "select * from p_logs where action='LoggedIn' OR action='LoggedOut' order by id desc limit 5")or die(mysqli_error());
while($display_logins=mysqli_fetch_array($sql)){
	if( staff_info('branch',$display_logins['user']) != staff_info('branch') ) continue;
$display_logins_count++;
?>
<div class="list-stagg-logins">
<div class="<?php echo $display_logins['action'];?>"><?php echo staff_info('full_name', $display_logins['user']);?> <?php echo $display_logins['action'];?>
<br><span class="minitime">(<?php echo display_time($display_logins['at']);?>)</span>
</div> 
</div>
<?php }?>
<?php if($display_logins_count==0){?>
<br><br><h4 class="text-center">No recent activity!</h4>
<?php }?>
