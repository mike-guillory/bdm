<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/style.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui-1.10.4.custom.min.css" />

	<script type="text/javascript" src="scripts/js/lib/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="scripts/js/lib/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="scripts/js/main.js"></script>



</head>
<body id="admin-body">
	<div id="admin-wrapper">
		<div id="admin-header">
			<div id="admin-nav">
				<a href="home">Home</a><p>|</p>
				
				<a href="edit_schedule">Edit Schedule</a>
			</div><!-- end #admin-nav -->
			<div id="admin-logout">
				<?php echo anchor("logged_out", "<input type='button' value='Log Out'>",
									array("onclick" => "return confirm('Are you sure you want to log out?')")); ?>
			</div><!-- end #admin-logout -->
			<hr />	
		</div><!-- end #admin_header -->	