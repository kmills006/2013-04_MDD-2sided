<?

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

		<section id="badges">
			<ul class="sizer">
				<? if(isset($friendsList) == ""){ ?>
					<h2>No Badges yet</h2>
				<? }else{ ?>
					<? foreach($badges as $badge){ ?>
						<li class="badgeList" data-badgeid="<?echo $badge["badge_id"]?>">
							<?echo img('imgs/' . $badge["badge_img"]);?>
							<h1><? echo $badge["badge_name"]; ?></h1>
							<h2><? echo $badge["badge_descrip"]; ?></h2>
						</li>
					<? } ?>
				<? } ?>
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