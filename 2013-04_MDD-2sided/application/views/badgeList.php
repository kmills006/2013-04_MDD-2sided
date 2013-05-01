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