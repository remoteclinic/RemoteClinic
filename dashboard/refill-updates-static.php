<?php 
$update_counts=0;
$my_branch = staff_info('branch');
$sql=mysqli_query($con, "select * from p_stock where branch='$my_branch' order by last_update desc limit 5")or die(mysqli_error());
while($stock=mysqli_fetch_array($sql)){
$update_counts++;
?>
<div class="med-refill-updates mru_<?php echo $update_counts;?>">
    <div class="row">
    <div class="mru-count">+<?php echo $stock['total']?></div>
    <div class="mru-txt"><?php echo $stock['code']?> <?php if(display_permission("medicine_profile")==true){ echo " - ".medicine_by_code('name',$stock['code']);} ?>
        <br><span class="minitime sm"><?php echo display_time($stock['last_update']);?></span>
    </div>
    </div>
</div>
<?php }?>   
<?php if($update_counts==0){?>Please contact your Head Office to assign you a Stock.<?php }?>
