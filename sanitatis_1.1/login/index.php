<?php 
require_once "../pre-includes/all.php"; 

	$invalid=false; $expired=false; $error=false; $blocked=false; $revoked=false; $password=false; $signout=false;

	if(isset($_GET['status'])){
		$show_status=$_GET['status'];
		
		if($show_status=="invalid"){$invalid=true;}
		else if($show_status=="error"){$error=true;}
		else if($show_status=="expired"){$expired=true;}
		else if($show_status=="blocked"){$blocked=true;}
		else if($show_status=="revoked"){$revoked=true;}
		else if($show_status=="password"){$password=true;}
		else if($show_status=="signout"){$signout=true;}
		else{echo"";}
		
	} //if isset
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$global_permission->portal_name";?></title>
<?php include "../theme/skin.php";?>
</head>

<body>
<div id="container">
	<div id="page">
	<h1 class="login_heading"><?php echo "$global_permission->portal_name";?><span>please login to proceed...</span></h1>
<div id="snfBstrip">&nbsp;</div>


	<div class="innertube">	

<ul id="tocMini">
<li>Once signed in, you will be redirected to your designated branch.</li>
<li>You can always switch in between the branches network, depending on your access level.</li>
<li>Your all actions are being recorded on portal, so always follow Rules and Regulations to avoid any trouble.</li>
<li>Any misuse of the portal will block your account.</li>
<li>In case of any problem, please do contact head office representatives.</li>
<li>You are required to Signout you account, each time you are done with the portal.</li>
</ul>
&nbsp;
<div class="hr"></div>
<?php $b = $_SERVER['HTTP_USER_AGENT'];
if(!strstr(strtolower($b),"chrome")){ ?>
<p></p>
<div class="error"><span class="errorIcon">Please use <strong>Google Chrome</strong>  to enjoy full features of the <?php echo "$global_permission->portal_name";?>… <a href="http://www.google.com/chrome" target="_blank">Download here...</a></span></div>
<?php }?>
<?php 
$starting_time="$global_permission->opening_time";
$closing_time="$global_permission->closing_time";
$this_hour= date('H');
if($this_hour>=$starting_time&&$this_hour<=$closing_time){	
echo "";
}else{
?>
<div align="center" class="alert"><span class="alertIcon">All Offices are closed. Senior Staff and System Administrators may enter in case of need.</span></div>
<?php 
	}
	if($invalid==true){?><div align="center" class="error"><span class="errorIcon">Invalid User/Password. Try Again.</span></div>
<?php 
	}
	if($expired==true){?><div align="center" class="alert"><span class="alertIcon">Your session seems to be expired. To protect your data, Panacea has logged you out. Please SignIn again.</span></div>
<?php 
	}
	if($error==true){?><div align="center" class="error"><span class="errorIcon">Sorry, Panacea could not log you in. Please try again.</span></div>
<?php 
	}
	if($blocked==true){?><div align="center" class="error"><span class="errorIcon">Your account seems to be temporarily blocked. Please contact Head Office Staff for the activation.</span></div>
<?php 
	}
	if($revoked==true){?><div align="center" class="error"><span class="errorIcon">Permission revoked. You don’t have enough clearance to access Panacea at this time.</span></div>
<?php 
	}
	if($password==true){?><div align="center" class="alert"><span class="alertIcon">Your Password has been changed. Please SignIn with new Password.</span></div>
<?php 
	}
	if($signout==true){?><div align="center" class="ok"><span class="tickIcon">You have successfully logged out.</span></div>
<?php }?>
<form method="post" action="../transport/">
    <ul id="form_login">
	<li class="title">User ID:</li><li><input name="user_id" type="text" /></li><li><strong>&nbsp;</strong></li>
	<li class="title">Passowrd:</li><li><input name="password" type="password"/></li><li><strong>&nbsp;</strong></li>
<input id="extra_key"  name="extra_key" type="hidden" value="<?php echo md5(date( 'A  D, M jS, Y' ));?>">

<p>&nbsp;</p>
    </ul>
    	<div id="page-clear" align="center"><input name="submit" class="formbutton submit" type="submit" value="login"></div>

    </form>
    &nbsp;
	</div>
    </div>
</div>
<?php include "../sections/footer.php";?>

</body>
</html>