<div id="content">
		<div class="sizer">
			<img id="welcome" src="<? echo base_url(); ?>/imgs/welcome.png" alt="2sided Logo" width="314" height="142" /></a>

			<a href="authentication/facebookRequest"><img id="fb-login" src="<? echo base_url(); ?>/imgs/fb_login.png" alt="Login with Facebook" width="154" height="25"/></a>

			<div id="forms">

				<!-- Login Form -->
				<?php echo form_open("authentication/checkLogin"); ?>
					<h1>Log In</h1>
					<h2 class="error"></h2>

					<p>Username:</p>
					<?php echo form_input('username'); ?>
					
					<p>Password:</p>
					<?php echo form_password('password'); ?>
					
					<button type="submit">Log In</button>
				<?php echo form_close(); ?>



				<!-- New User Form -->
				<?php echo form_open("authentication/registerNewUser"); ?>
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