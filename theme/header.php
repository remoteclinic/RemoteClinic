<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="../theme/css/bootstrap.min.css">
<link rel="stylesheet" href="../theme/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../theme/css/main.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="../theme/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>
<?php
  $rerer = $global_permission->portal_name;
  if( if_logged_in() == true ):
?>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../dashboard">
        <div class="img-brand img-responsive"><img alt="Brand" src="../theme/images/mini-inline-logo-res.png" class="img-responsive img-brand"/></div>
        <div class="text"><?php echo get_global('portal_name');?></div>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <form class="navbar-form navbar-left"  method="GET" action="../search" >
        <div class="form-group">
          <input type="text" name="searchme" class="form-control" placeholder="Search">
        </div>
      </form>

      <ul class="nav navbar-nav">

       <li class="dropdown mini">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo get_global('guardian_short_name'); echo staff_info('branch');?> - <?php echo branch_name(staff_info('branch'));?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if(display_permission("register_patient")==true){?><li class="add"><a href="../patients/register-patient.php">New Patient</a></li><?php }?>
            <?php if(display_permission("consumed_stock_local")==true){?><li class="info"><a href="../medicines/stocks.php">Local Stock</a></li><?php }?>
            <?php if(display_permission("pending_prescriptions")==true){?><li class="peding"><a href="../patients/pending-reports.php">Pending Reports (<?php echo count_pending();?>)</a></li><?php }?>
          </ul>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right">

       <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo staff_info("full_name");?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../staff/my-profile.php">My Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../login/signout.php"><i class="glyphicon glyphicon-off"></i> Signout</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- .navbar-collapse -->
  </div><!-- .container-fluid -->
</nav>
<?php endif; ?>