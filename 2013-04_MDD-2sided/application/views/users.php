<?
	$this->load->helper('isMulti.php');

	// echo '<pre>';
	// print_r($users);
	// echo '</pre>';
?>

	<div id="content">
		<section id="filters">
			<div class="sizer">
				<div class="usearch">
					<h1>Search for users by username</h1>
					<input type="text" id="user-search"/>
					<ul id="searchResults"></ul>
				</div>
				<div class="sortby">
					<h1>Sort By</h1>
					<ul>
						<li class="selected"><? echo anchor('user/viewAll/top', 'Score', 'Sort by score') ?></li>
						<li><? echo anchor('user/viewAll/newest', 'Newest Users', 'Sort by newest users') ?></li>
						<li class="last"><? echo anchor('user/viewAll/oldest', 'Oldest Users', 'Sort by oldest users') ?></li>
					</ul>
				</div>
			</div>
		</section>

		<section id="users">
			<div class="sizer">
				<ul>
					<? foreach($users as $user){

						$imgProperties  = array(
											'src' => 'imgs/profile_imgs/'.$user['profile_img'],
											'height' => '70',
											'width' => '70'
						); ?>

						<li>
							<? if($user['profile_img']){
								echo img($imgProperties); 
							}else{
								echo img('imgs/profile_imgs/70x70_profile.png'); 
							} ?>

							<h1><? echo $user["username"] ?></h1>
							<h3><? echo $user["ratingCount"] ?>Checks</h3>
							
							<div class="button"><? echo anchor("user/profilePage/{$user["user_id"]}", "Visit Profile", 'title="View all of users decks"'); ?></div>
						</li>
					
					<? } ?>
				</ul>
			
			</div>
		</section>
	</div> <!-- End Content -->

	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

	<!-- Inits -->
	<script type="text/javascript">initNav();</script>
	<script type="text/javascript">initUserSearch()</script>