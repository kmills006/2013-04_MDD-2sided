<?php 
	$this->load->helper("html");
	$this->load->helper("url");
?>

<!DOCTYPE HTML>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>2sided - The Social Way to Study</title>
	<meta name="description" content="A social way to study using flashcards.">
	<meta name="author" content="Kristy Miller, Kolby Sisk">
	
	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>css/main.css" media="screen" /> 
	
	<!-- Favicon -->
	<?php echo link_tag("favicon.ico", "shortcut icon", "image/ico");?>

	<script>
		var base = "<?php echo base_url(); ?>"
	</script>
</head>	

<body>
	<header>
		<div class="sizer">
			<a href="<? echo base_url(); ?>"><img src="<? echo base_url(); ?>imgs/logo.png" alt="2sided Logo" width="66" height="43" /></a>
			<nav>
				<ul id="navigation">
					<li class="yourdecks"><? echo anchor("login", "Your Decks", "Your personal decks"); ?></li>
					<li class="browse"><? echo anchor("browse", "Browse", "Browse decks on 2sided"); ?></li>
					<li class="about"><? echo anchor("browse/about", "About", "About 2sided"); ?></li>
				</ul>

				<input type="text" placeholder="search" id="searchIni"/>

				<ul id="searchResults"></ul>
				
				<ul id="tools">
					<li><? echo anchor("login", "Log In", 'title="User Login"'); ?></li>
					<li><? echo anchor("login", "Sign Up", 'title="New User Registration"'); ?></li>
				</ul>
			</nav>
		</div>
	</header>



