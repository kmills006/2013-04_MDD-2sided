<?
	$this->load->helper('isMulti.php');
	$parts = explode('/',  uri_string());
	$uri = end($parts);
?>

	<div id="content" class="userPage">
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
						<li<?if($uri == 'top') echo ' class="selected"'?>><? echo anchor('user/viewAll/top', 'Score', 'Sort by score') ?></li>
						<li<?if($uri == 'newest') echo ' class="selected"'?>><? echo anchor('user/viewAll/newest', 'Newest Users', 'Sort by newest users') ?></li>
						<li<?if($uri == 'oldest') echo ' class=" last selected"'?> class="last"><? echo anchor('user/viewAll/oldest', 'Oldest Users', 'Sort by oldest users') ?></li>
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
						); 

						$imgPlaceholderProps = array(
											'src' => 'imgs/profile_imgs/profile-img_placeholder.png',
											'height' => '70',
											'width' => '70'
						); 

					?>
						<li class="userList" data-userid="<?echo $user["user_id"]?>">
							<? if($user['profile_img']){
								echo img($imgProperties); 
							}else{
								echo img($imgPlaceholderProps); 
							} ?>

							<h1><? echo anchor("user/profilePage/{$user["user_id"]}", $user['username'], 'title="View profile"'); ?></h1>

							<? if($user['ratingCount'] == 0){?>
								<h3 class="rating">0</h3>
							<?}else{ ?>
								<h3 class="rating"><? echo $user["ratingCount"] ?></h3>
							<? } ?>
							
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
	<script type="text/javascript">initUserSearch()</script>