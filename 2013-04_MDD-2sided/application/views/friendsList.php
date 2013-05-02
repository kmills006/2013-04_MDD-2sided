<?
	$this->load->helper('isMulti.php');
	$parts = explode('/',  uri_string());
	$uri = end($parts);

	$userInfo = $profileInfo['userInfo'];
?>

	<div id="content" class="userPage">
		<div id="info" class="decksPage">
			<div class="sizer">
			
				<section id="picture">

					<? if($userInfo['profile_img'] == null){
						echo img('imgs/profile_imgs/profile-img_placeholder.png');
					}else{
						echo img('imgs/profile_imgs/'.$userInfo['profile_img']); 
					} ?>

				</section>
				
				<section id="profileInfo">
					<h1><? echo $userInfo['username'] ?></h1>
					
					<h2>Joined: <? echo $userInfo['date_of_reg']; ?></h2>

					<? if($profileInfo['profileViews'] == 0){
						// Noone has viewed this profile yet, do not include profile count
					}else{ ?>
						<h2><? echo $profileInfo['profileViews']; ?> Profile Views</h2>
					<? } ?>

					<h3 class="rating"><? echo $profileInfo['ratingCount'] ?></h3>
				</section>

			</div> <!-- end of sizer -->
		</div> <!-- end of info -->

		<section id="users">
			<div class="sizer">
				<? 
					if(isset($friendsList) == ""){ ?>
						<h2>No friends yet</h2>
					<? }else{ ?> 
						<ul>
							<? foreach($friendsList as $friend){

								$imgProperties  = array(
													'src' => 'imgs/profile_imgs/'.$friend[0]['profile_img'],
													'height' => '70',
													'width' => '70'
								); ?>

									<li class="userList" data-userid="<?echo $friend[0]["user_id"]?>">
										<? if($friend[0]['profile_img']){
											echo img($imgProperties); 
										}else{
											echo img('imgs/profile_imgs/70x70_profile.png'); 
										} ?>

										<h1><? echo $friend[0]["username"] ?></h1>
										<div class="space"></div>

										<div class="button"><? echo anchor("user/profilePage/{$friend[0]["user_id"]}", "Visit Profile", 'title="View all of users decks"'); ?></div>
									</li>
							<? } ?>

						</ul>

					<? } ?>
				
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