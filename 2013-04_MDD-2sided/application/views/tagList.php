<?
	$this->load->helper('isMulti.php');
	$parts = explode('/',  uri_string());
	$uri = end($parts);

	$profileInfo = $profileInfo[0];
?>

	<div id="content" class="userPage">
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

		<section id="tags">
			<div class="sizer">
				<ul>
					<? foreach($tags as $tag){ ?>
						<li class="tagList" data-userid="<?echo $tag["tagName"]?>">

							<h1><? echo anchor("tags/viewTags/{$tag["user_id"]}/{$tag["tagName"]}", $tag['tagName'], 'title="View all tags with this name"'); ?></h1>
							<h2>x <? echo $tag['numberOfTags']; ?> </h2>
			
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