<?

	$profileInfo = $profileInfo[0];
?>


<div id="info" class="decksPage">
			<div class="sizer">
			
			<section id="picture">

				<? if($profileInfo['profile_img'] == null){
					echo img('imgs/profile_imgs/profile-img_placeholder.png');
				}else{
					echo img('imgs/profile_imgs/'.$profileInfo['profile_img']); 
				} ?>

			</section>
			
			<section id="profileInfo">
				<h1><? echo $profileInfo['username'] ?></h1>
				
				<h2>Joined <? echo $profileInfo['date_of_reg']; ?></h2>

				<? if($profileInfo['profileCount'] == 0){
					// Noone has viewed this profile yet, do not include profile count
				}else{ ?>
					<h2><? echo $profileInfo['profileCount']; ?> Profile Views</h2>
				<? } ?>

				<h3 class="rating"><? echo $profileInfo['ratingsCount'] ?></h3>
			</section>

		</div> <!-- end of sizer -->
	</div> <!-- end of info -->