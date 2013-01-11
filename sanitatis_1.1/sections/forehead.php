<div id="forehead">

	<div class="left">
		<ul id="left-forehead-blocks">
        <li class="panacea"><a class="block" href="../desktop"><strong><?php echo "$global_permission->portal_name";?></strong></a></li>
        <li class="searchTop"><form method="get" action="../search/">
<input name="searchme" value="Search here..." onfocus="if (this.value == 'Search here...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search here...';}"/>
</form></li>
        <li class="mini"><?php echo "$global_permission->guardian_short_name"; echo $_SESSION['branch'];?> - <?php echo branch_name($_SESSION['branch']);?></li>
        </ul>    
    
    </div>
	
    <div class="right">
		<ul id="right-forehead-blocks">
        <li><a class="signout" href="../signout/" title="signout">&nbsp;</a></li>
        <li><span class="rank <?php echo access_level2rank(staff_info("access_level",$_SESSION['id']));?>"><?php echo access_level2rank(staff_info("access_level",$_SESSION['id']));?></span></li>
        <li class="profile"><a class="tooltip block" href="../staff/profile<?php echo $extension;?>?id=<?php echo $_SESSION['id'];?>"><?php echo staff_info("full_name",$_SESSION['id']);?><span class="classic"><strong><?php echo staff_info("full_name",$_SESSION['id']);?></strong><br/><hr/><div class="left-card"><?php echo staff_img("$_SESSION[id]","60px");?></div><div class="right-card"><?php echo access_level2rank(staff_info("access_level",$_SESSION['id']));?><br/><strong><?php echo "$global_permission->guardian_short_name"; echo $_SESSION['branch'];?></strong><br/><?php echo branch_name($_SESSION['branch']);?></div></span></a></li>
        <li><div class="thumbProfile"><?php echo staff_img("$_SESSION[id]","29px");?></div></li>
        </ul>
    </div>
</div>

<div id="header-navi">
   	<ul id="buttons">
        <?php if(display_permission("register_patient")==true){?><a href="../patients/register<?php echo $extension;?>"><li class="add">register new patient</li></a><?php }?>
        <?php if(display_permission("consumed_stock_local")==true){?><a href="../medicine/consumed-local-stock<?php echo $extension;?>"><li class="info">consumed stock</li></a><?php }?>
        <?php if(display_permission("pending_prescriptions")==true){?><a href="../patients/pending<?php echo $extension;?>"><li class="peding">pending reports (<?php echo count_pending();?>)</li></a><?php }?>
	</ul>
</div>