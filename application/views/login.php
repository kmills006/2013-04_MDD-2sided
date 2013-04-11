<?php
	$this->load->helper('form');
	$this->load->helper('html');

	$att1 = array('id' => 'loginForm');
	$att2 = array('id' => 'registerForm');
?>


	<div id="content">
		<div class="sizer">
			<img id="welcome" src="<? echo base_url(); ?>/imgs/welcome.png" alt="2sided Logo" width="314" height="142" /></a>

			<a href="login/facebookRequest"><img id="fb-login" src="<? echo base_url(); ?>/imgs/fb_login.png" alt="Login with Facebook" width="154" height="25"/></a>

			<div id="forms">

				<!-- Login Form -->
				<?php echo form_open("login/process", $att1); ?>
					<h1>Log In</h1>
					<h2 class="error"></h2>

					<p>Username:</p>
					<?php echo form_input('username'); ?>
					
					<p>Password:</p>
					<?php echo form_password('password'); ?>
					
					<button type="submit">Log In</button>
				<?php echo form_close(); ?>



				<!-- New User Form -->
				<?php echo form_open("newuser/register", $att2); ?>
					<h1>Register</h1>
					<h2 class="regError"></h2>
					<div class="regLeft">
						<p>Username:</p>
						<?php echo form_input('username'); ?>
						
						<p>Email Address:</p>
						<?php echo form_input('r-email'); ?>
					</div>
					<div class="regRight">
						<p>Password:</p>
						<?php echo form_password('password'); ?>
						
						<p>Confirm Password:</p>
						<?php echo form_password('r-c-password'); ?>
					</div>
					<button type="submit">Register</button>
				<?php echo form_close(); ?>


			</div>
		</div>
