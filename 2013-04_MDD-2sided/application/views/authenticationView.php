<?php
	$loginForm = array('id' => 'loginForm');
	$registerForm = array('id' => 'registerForm');
?>
	<div id="content">
		<div class="sizer">
			<img id="welcome" src="<? echo base_url(); ?>/imgs/welcome.png" alt="2sided Logo" width="314" height="142" /></a>
			
			<a id="facebook" href="authentication/facebookRequest"><img id="fb-login" src="<? echo base_url(); ?>/imgs/fb_login.png" alt="Login with Facebook" width="154" height="25"/></a>

			<div id="forms">

				<!-- Login Form -->
				<?php echo form_open("authentication/checkLogin", $loginForm); ?>
					<h1>Log In</h1>
					<h2 class="error"></h2>

					<p>Username:</p>
					<?php echo form_input('username'); ?>
					
					<p>Password:</p>
					<?php echo form_password('password'); ?>
					
					<button type="submit">Log In</button>
					<? echo anchor('forgotpass', 'Forgot Password?', 'Recover Lost Password') ?>
				<?php echo form_close(); ?>

				<div class="divider"></div>
				
				<!-- New User Form -->
				<?php echo form_open("authentication/registerNewUser", $registerForm); ?>
					<h1>Register</h1>
					<h2 class="regError"></h2>

					<p>Username:</p>
					<?php echo form_input('username'); ?>
					
					<p>Email Address:</p>
					<?php echo form_input('r-email'); ?>

					<p>Password:</p>
					<?php echo form_password('password'); ?>

					<button type="submit">Register</button>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

	<!-- Inits -->
	<script type="text/javascript">initNav();</script>
	<script type="text/javascript">initValidation();</script>