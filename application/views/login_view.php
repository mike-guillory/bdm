<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.min.css" />
</head>
<body style="margin: 0 auto">
<h3 style="text-align: center; margin-top: 100px; margin-bottom: -150px">BDM Website Adminstration</h3>

	<div class="grad1" style="height: 300px; width: 400px; margin: 200px auto; color: #fff; box-shadow: 5px 5px 10px 1px #555; border-radius: 5px">
		<div style="width: 260px; margin: 0 auto; padding-top: 20px">

			<h1>Login</h1>

			<?php echo form_open('admin'); ?>
				<div>

					<p style="text-align: right; margin-right: -11px">
						<?php 

						$autoFocus = array(
			              'autofocus'   => 'autofocus',
			              'name'		=> 'userName',
			              'id'			=> 'userName'
			            );
							echo form_label('User Name: ', 'userName');
							echo form_input($autoFocus, set_value('userName'));
						?>
					</p>

					<p style="text-align: right">
						<?php 
							echo form_label('Password: ', 'password');
							echo form_password('password', '', 'id="password"');
						?>
					</p>

					<p style="text-align: right">
						<?php 
							echo form_submit('submit', 'Login'); 
							echo "<span style='padding: 0 10px 0 10px'>". anchor('home', '<input type="button" value="Cancel">'). "</span>";
						?>
					</p>
				</div>
			<?php echo form_close(); ?>

			
		</div>
	</div>

	<div class="loginErrors"><?php 

							// Show validation_errors() if form doesn't validate.
							echo validation_errors();

							// Show $loginFailed if form validates, but login information is incorrect.
							if(isset($loginFailed))
							{
								echo $loginFailed;
							} 

						?>
		<div style="color: #fff">
			<p>admin</p>
			<p>van...</p>
		</div>
	</div>
</body>
</html>