<? 
	if($this->session->userdata('isLoggedIn') == 1){
		$isLoggedIn = true;
	}else{
		$isLoggedIn = false;
	} 
?>	

	<div class="bgPoint"></div>
	<footer>
		<div class="sizer">
			<section id="newsletter">
				<h1>Newsletter</h1>
				<p>Sign up for our newsletter to hear about 2sided’s future updates.</p>
				<input type="text" placeholder="example@domain.com"></input>
			</section>

			<div class="buttonbg"></div>
			<?if($this->session->userdata('userID')){ ?>
				<div class="button"><? echo anchor("decks/addNewDeck", 'Add Deck', 'Add New Deck');?></div>
			<? }else{?>
				<div class="button"><? echo anchor("authentication", 'Add Deck', 'Add New Deck');?></div>
			<?}?>

			<section id="footerNav">
				<h1>Site Navigation</h1>
				<ul>
					<li><? echo anchor('decks', 'Decks', 'Browse all decks') ?></li>
					<li><? echo anchor('user/viewAll/top', 'Users', 'Search by users') ?></li>
					<li><? echo anchor('about', 'About', 'About 2sided') ?></li>

					<? if(!$isLoggedIn){ ?>
						<li><? echo anchor('authentication', "Log In", 'title="User Login"'); ?></li>
					<? }else{ ?>
						<li><? echo anchor('authentication/userLogout', "Log Out", 'title="User Logout"'); ?></li>
					<? } ?>

					<li><? echo anchor('', "Support", 'title="Support"'); ?></li>
					<li><? echo anchor('about/contact', "Contact Us", 'title="Contact the designer and developer"'); ?></li>
				</ul>
			</section>
		</div>
		<section id="bottomFooter">
			<p>Copyright &copy; 2013 Kolby Sisk & Kristy Miller.</p>
		</section>
	</footer>	
	<script type="text/javascript" src="<? echo base_url(); ?>js/responsive.js"></script>
</body>
</html>