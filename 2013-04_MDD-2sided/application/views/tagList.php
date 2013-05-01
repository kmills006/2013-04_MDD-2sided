<?
	$this->load->helper('isMulti.php');
	$parts = explode('/',  uri_string());
	$uri = end($parts);
?>

	<div id="content" class="userPage">
		<!-- <section id="filters">
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
		</section> -->

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