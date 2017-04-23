<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>ShareRide.com </title>


	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>



	<link rel="stylesheet" href="css/style.css">

	

</head>
<body>
<div>
				<div class="site-header">
					<div id="main-header" class="main-header header-sticky">
						<div class="inner-header clearfix">
							<div class="logo">
								<a style="text-decoration: none !important;" href="index.php">ShareRide</a>
							</div>
						
							<nav class="main-navigation pull-right hidden-xs hidden-sm" style="float:right;">
								<ul>
									<li><a href="index.php">Home</a></li>
									<li><a href="registerride.php" class="has-submenu">Register Ride</a>
										
									</li>
									<li><a href="giveride.php" class="has-submenu">Give Ride</a>
										
									</li>
									<li><a href="availablerides.php" class="has-submenu">Available Rides</a>
									
									</li>
									<?php if(!isset($_SESSION['customerEmail'])){?>
									<li id='top-cssmenu'><a href="register.php">  LOGIN</a></li>
									<li id='top-cssmenu'><a href="register.php">  REGISTER</a></li>
									<?php }
									if(isset($_SESSION['customerEmail'])){?> 
									<li  id='top-cssmenu' style="list-style:none;  border-right: none;"> <a href="logout.php">LOGOUT</a></li>
									<li  id='top-cssmenu' style="color: #EFFF00; border-right:none; font-style: italic; padding-left:5px !important; "> Welcome <?php echo $_SESSION['customerNames']; ?> </li>
									<?php } ?>
								</ul>
							</nav>
						</div>
					</div>
					
				</div>
				
</div>

<div style="height:85px;"></div>
<div class="full_container" >

				<div class="container1">. </div>
