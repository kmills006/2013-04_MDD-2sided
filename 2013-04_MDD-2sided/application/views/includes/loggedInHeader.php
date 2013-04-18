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

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>css/style.css" media="screen" /> 
	
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
	<header>
		<div class="sizer">
			<div id="logo"><a href="<? echo base_url(); ?>"><img src="<? echo base_url(); ?>imgs/logo.png" alt="2sided Logo" width="66" height="43" /></a></div>
			<nav>
				<ul id="navigation">
					<li class="decks active"><? echo anchor('decks', 'Decks', 'Browse all decks') ?></li>
					<li class="users"><? echo anchor('decks/users', 'Users', 'Search by users') ?></li>
					<li class="tags"><? echo anchor('decks/tags', 'Tags', 'Search by tags') ?></li>
				</ul>

				<input type="text" placeholder="search" id="searchIni"/>

				<ul id="searchResults"></ul>

				<ul id="tools">
					<li><? echo anchor("authentication/userLogout", "Log Out", 'title="User Log Out"'); ?></li>

					<li><? echo anchor("user/profilePage", $username , 'title="User Log Out"'); ?></li>

				</ul>
			</nav>
		</div>
	</header>



