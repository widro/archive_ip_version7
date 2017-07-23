<?php get_header(); ?>


<?php

	// top story sql
	$the_query = new WP_Query('&showposts=5&category_name=top-story&orderby=post_date&order=desc');

	//top story loop
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 =  "http://media.insidepulse.com/shared/images/v6/default500.jpg";
	}

	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v6/default120.jpg";
	}
	$thistitle = $post->post_title;
	$thistitle = strip_tags($thistitle);
	$thisexcerpt = $post->post_excerpt;
	$thisexcerpt = $post->post_excerpt;

	if(!$thisexcerpt){
		$thisexcerpt = $post->post_content;

	}
	$thisexcerpt = strip_tags($thisexcerpt);
	$thisexcerpt = substr($thisexcerpt, 0, 180);
	$thistitle = str_replace("\"", "", $thistitle);
	$thistitle = substr($thistitle, 0, 100);
	$clickthru=get_permalink($thispostid);

	//build top story rotator
	if($topstory120x120&&$topstory500x250){
		if($topstoryposition==1){
			$rotatorimages .= "
				<li class=show><a href=$clickthru><img src=$topstory500x250 width=500 height=250></a></li>
			";
			$rotatortitles .= "
				<li class=show><a href=$clickthru>$thistitle</a></li>
			";
			$rotatorteasers .= "
				<li class=show>$thisexcerpt</li>
			";
			$rotatorclicks .= "
				<li class=show><a href=$clickthru>>> Read full story</a></li>
			";

			$featuredthumbrow .= "
				<a href=\"$clickthru\" title=\"$thistitle\"><img id=topstorythumb_". $topstoryposition ." class=topstorythumb_active src=". $topstory120x120 . "></a>
			";
		}
		else{
			$rotatorimages .= "
				<li><a href=$clickthru><img src=$topstory500x250 width=500 height=250></a></li>
			";
			$rotatortitles .= "
				<li><a href=$clickthru>$thistitle</a></li>
			";

			$rotatorteasers .= "
				<li>$thisexcerpt</li>
			";

			$rotatorclicks .= "
				<li><a href=$clickthru>>> Read full story</a></li>
			";

			$featuredthumbrow .= "
				<a href=\"$clickthru\" title=\"$thistitle\"><img id=topstorythumb_". $topstoryposition ." class=topstorythumb src=". $topstory120x120 . "></a>
			";
		}

		$topstoryposition++;
	}

	endwhile;








?>




		<div class="topstory">
			<div class="topstory_left">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"></a>
			</div>
			<div class="topstory_right">
				<a href="#" class="topstory_headline color1 bold">Check out this incredible headline because it is all the best of what we have to offer</a>
				<br><br>
				Check out this incredible teaser because it is all the best of what we have to offer
				<br><br>
				<a href="#" class="color1">read more &raquo;</a>

			</div>
		</div>


		<div class="clear"></div>


		<div class="topstory_scroll">
			<div class="topstory_scroll_arrow">
				<a href="#"><img src="/wp-content/themes/version7/images/topstoryscrollarrow_left.png"></a>
			</div>
			<div class="topstory_scroll_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"></a>
			</div>
			<div class="topstory_scroll_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"></a>
			</div>
			<div class="topstory_scroll_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"></a>
			</div>
			<div class="topstory_scroll_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"></a>
			</div>

			<div class="topstory_scroll_arrow">
				<a href="#"><img src="/wp-content/themes/version7/images/topstoryscrollarrow_right.png"></a>
			</div>


		</div>

		<div class="clear"></div>



		<div class="subtop">
			<div class="subtop_tabs">
				<div class="subtop_tab_on">NEWS</div>
				<div class="subtop_tab_off">POPULAR</div>
				<div class="subtop_tab_off">WHATS HOT</div>
			</div>
			<div class="clear"></div>


			<div class="subtop_cell">
				<div class="subtop_cell_left">
					<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
				</div>
				<div class="subtop_cell_right">
					<a href="#" class="headline">Check out this incredible headline because it is all the best of what we have to offer</a>
					<br><br>
					<span class="subtop_byline">by <a href="#" class="color1">John Doe</a> | <img src="/wp-content/themes/version7/images/commentbubble.png"> <a href="#" class="color1">33</span>
				</div>
			</div>
			<div class="subtop_cell">
				<div class="subtop_cell_left">
					<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
				</div>
				<div class="subtop_cell_right">
					<a href="#" class="headline">Check out this incredible headline because it is all the best of what we have to offer</a>
					<br><br>
					<span class="subtop_byline">by <a href="#" class="color1">John Doe</a> | <img src="/wp-content/themes/version7/images/commentbubble.png"> <a href="#" class="color1">33</span>
				</div>
			</div>
			<div class="subtop_cell">
				<div class="subtop_cell_left">
					<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
				</div>
				<div class="subtop_cell_right">
					<a href="#" class="headline">Check out this incredible headline because it is all the best of what we have to offer</a>
					<br><br>
					<span class="subtop_byline">by <a href="#" class="color1">John Doe</a> | <img src="/wp-content/themes/version7/images/commentbubble.png"> <a href="#" class="color1">33</span>
				</div>
			</div>
			<div class="subtop_cell">
				<div class="subtop_cell_left">
					<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
				</div>
				<div class="subtop_cell_right">
					<a href="#" class="headline">Check out this incredible headline because it is all the best of what we have to offer</a>
					<br><br>
					<span class="subtop_byline">by <a href="#" class="color1">John Doe</a> | <img src="/wp-content/themes/version7/images/commentbubble.png"> <a href="#" class="color1">33</span>
				</div>
			</div>



		</div>


		<div class="clear" style="height:20px;"></div>


		<div class="greyline650"></div>

		<div class="clear"></div>


<?php

	//$zones = array('movies', 'tv', '', '', '', '', '', '');


	// zone sql
	$the_query = new WP_Query('&showposts=3&zone=movies&orderby=post_date&order=desc');

	$zonecounter=0;

	//top story loop
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 =  "http://media.insidepulse.com/shared/images/v6/default500.jpg";
	}

	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v6/default120.jpg";
	}
	$thistitle = $post->post_title;
	$thistitle = strip_tags($thistitle);
	$thisexcerpt = $post->post_excerpt;
	$thisexcerpt = $post->post_excerpt;

	if(!$thisexcerpt){
		$thisexcerpt = $post->post_content;

	}
	$thisexcerpt = strip_tags($thisexcerpt);
	$thisexcerpt = substr($thisexcerpt, 0, 180);
	$thistitle = str_replace("\"", "", $thistitle);
	$thistitle = substr($thistitle, 0, 100);
	$clickthru=get_permalink($thispostid);

	if($zonecounter==0){
		$toplink = "
				<a href=\"$clickthru\"><img src=\"$topstory500x250\" width=150></a>
				<a href=\"$clickthru\" class=\"left4x2_headline\">$thistitle</a>
		";

	}
	else{
		$otherlinks .= "
					<li><a href=\"$clickthru\">$thistitle</a></li>
		";
	}

	$zonecounter++;
	endwhile;
?>


		<div class="left4x2">
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">MOVIES</h3>
				<div class="greyline150"></div>
				<?php echo $toplink ?>
				<ul>
				<?php echo $otherlinks ?>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">TV</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">COMICS</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">WRESTLING</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
		</div>
		<div class="left4x2">
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">MMA/BOXING</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">GAMES</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">MUSIC</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
			<div class="left4x2_column">
				<h3 class="icon1 font2 color1">SPORTS</h3>
				<div class="greyline150"></div>
				<a href="#"><img src="/wp-content/themes/version7/images/temp/rugby_front.jpg" width=150></a>
				<a href="#" class="left4x2_headline">Some Kind Of title that goes here Some Kind Of title that goes here</a>
				<ul>
					<li><a href="#">Some Kind Of title that goes here</a></li>
					<li><a href="#">Some Kind Of title that goes here</a></li>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>
		</div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>