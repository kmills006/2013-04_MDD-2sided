<? 
	$username = $this->session->userdata('username');
?>

<!DOCTYPE HTML>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="A social way to study using flashcards.">
	<meta name="author" content="Kristy Miller, Kolby Sisk">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>2sided - The Social Way to Study</title>

	<!-- Desktop -->
	<link rel="stylesheet" href="<? echo base_url(); ?>css/style.css" media="only screen and (min-width: 768px)" > 
	<!-- Tablet -->
	<link rel="stylesheet" href="<? echo base_url(); ?>css/tablet-style.css" media="only screen and (min-width: 606px) and (max-width: 768px)" > 
	<!-- Mobile -->
	<link rel="stylesheet" href="<? echo base_url(); ?>css/mobile-style.css" media="only screen and (max-width: 605px)" > 

	<!-- Favicon -->
	<?php echo link_tag("favicon.ico", "shortcut icon", "image/ico");?>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script>
		var base = "<?php echo base_url(); ?>"
	</script>
</head>	

<body>
	<div class="shade"></div>
	<header>
		<div class="sizer">
			<div id="logo"><a href="<? echo base_url(); ?>"><img src="<? echo base_url(); ?>imgs/logo.png" alt="2sided Logo" width="66" height="43" /></a></div>
			<nav>
				<ul id="navigation">
					<li class="decks"><? echo anchor('decks', 'Decks', 'Browse all decks') ?></li>
					<li class="users"><? echo anchor('user/viewAll/top', 'Users', 'Search by users') ?></li>
					<li class="about"><? echo anchor('about', 'About', 'About 2sided') ?></li>
				</ul>

				<input type="text" id="search"/>

				<ul id="searchResults"></ul>

				<ul id="tools">
					<li class="user"><? echo anchor("user/profilePage", $username , 'title="User Log Out"'); ?></li>
					<li class="login"><? echo anchor("authentication/userLogout", "Log Out", 'title="User Log Out"'); ?></li>
				</ul>
			</nav>
		</div>
	</header>



