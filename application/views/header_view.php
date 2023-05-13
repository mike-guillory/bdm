<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />

	<script type="text/javascript" src="scripts/js/lib/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="scripts/js/lib/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="scripts/js/main.js"></script>
	<script src="audiojs/audio.min.js"></script>

</head>
<body class="">
	<div id="wrapper">
	<div id="main-header-container">
		<div id="main-header">
			<div id="main-banner" class="float-left text-left">
				<h1 id="bdm">Brian Dorsey Music</h1>
				<h2 id="ccm">Contemporary Christian Music</h2>
			</div><!-- end main-banner -->
			<div id="main-nav-div" class="float-right">
				<ul class="main-nav-list">
					<li id="home-li"><a id="home" href="home">HOME</a></li>
					<li id="about-li"><a id="about" href="about">ABOUT</a></li>
					<li id="gallery-li"><a id="gallery" href="gallery">GALLERY</a></li>
					<li id="buy-li"><a id="buy" href="buy">MUSIC</a></li>
				</ul>
				<?php 
					session_start();
					if(isset($_SESSION['userName']))
					{
						echo "<ul><li id='edit_schedule-li'><a id='edit_scheduleLink' href='edit_schedule'>EDIT SCHEDULE</a></li>".
						      "<li id='edit_cds-li'><a id='edit_cdsLink'";

						echo anchor("logged_out", "<li><input type='button' value='Log Out'></li></ul>",
									array("onclick" => "return confirm('Are you sure you want to log out?')"));
					}
				?>
				<!-- <div id="location-indicator"></div> -->
			</div><!-- end main-nav -->
		</div><!-- end main-header -->
	</div><!-- end main-header-container -->	

	
	
