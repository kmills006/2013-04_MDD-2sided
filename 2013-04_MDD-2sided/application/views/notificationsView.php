<?

	$userID = $this->session->userdata('userID');
?>
	 


	<div id="content" class="userPage">
		<!-- <div id="info" class="decksPage">
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

			</div> 
		</div>  -->

		<section id="notifications">
			<ul class="sizer">
			<?if(isset($friendRequests)){
				foreach($friendRequests as $requester){ ?>
					<li class="notilist">
						<? if($requester['profile_img'] == null){
						echo img('imgs/profile_imgs/profile-img_placeholder.png');
						}else{
							echo img('imgs/profile_imgs/'.$requester['profile_img']); 
						} ?>
						<h1><? echo anchor("user/profilePage/{$requester["user_id"]}", $requester['username'], 'View users profile');?></h1>
						<h2>wants to be your friend!</h2>
						<div class="button"><? echo anchor("friends/acceptRequest/{$requester["user_id"]}/{$userID}", 'Accept', 'Accept friend request') ?></div>
						<div class="button"><? echo anchor("friends/rejectRequest/{$requester["user_id"]}/{$userID}", 'Decline', 'Accept friend request') ?></div>
					</li>
				<? }
			}else{
				echo "No notifications";
			}?>
			</ul>
		</section>
	</div>




	<!-- Jquery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo base_url(); ?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- Scripts -->
	<script type="text/javascript" src="<? echo base_url(); ?>js/main.js"></script>

	<!-- Inits -->
	<script type="text/javascript">initUserSearch()</script>