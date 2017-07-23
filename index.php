<?php get_header(); ?>
	<div class="content_left">

<?php

	//arrays

	//home
	$featuredarray = array('news', '10-thoughts', 'reviews');

	//array
	$left4x2array = array($type, '', '', '')
	$left4x2array[] = array('zone', 'movies', 'Television', '/zone/movies/')
	$left4x2array[] = array('zone', 'tv', 'Movies', '/zone/tv/')
	$left4x2array[] = array('zone', 'comics-nexus', 'Comics Nexus', '/zone/comics-nexus/')
	$left4x2array[] = array('zone', 'sports', 'Sports', '/zone/sports/')
	$left4x2array[] = array('rss', 'wrestling', 'Wrestling', 'http://wrestling.insidepulse.com/')
	$left4x2array[] = array('rss', 'insidefights', 'Inside Fights', 'http://insidefights.com')
	$left4x2array[] = array('rss', 'diehardgamefan', 'Diehard Gamefan', 'http://diehardgamefan.com')
	$left4x2array[] = array('zone', 'music', 'Music', '/zone/movies/')




	$zonecount = count($zonearray);







	//top story vars
	$showcheck = false;
	$topstoryposition = 1;

	// top story sql
	$the_query = new WP_Query('&showposts=4&category_name=top-story&orderby=post_date&order=desc');

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
				<li class=\"show\"><a href=\"$clickthru\"><img src=\"$topstory500x250\"></a></li>
			";
			$rotatorclicks .= "
				<li class=\"show\">
					<a href=\"$clickthru\" class=\"topstory_headline color1 bold\">$thistitle</a>
					<br><br>
					$thisexcerpt
					<br><br>
					<a href=\"$clickthru\" class=\"fr bold\">read more &raquo;</a>
				</li>
			";

			$featuredthumbrow .= "
				<div class=\"topstory_scroll_cell\">
					<a href=\"$clickthru\"><img src=\"$topstory500x250\"></a>
				</div>
			";
		}
		else{
			$rotatorimages .= "
				<li><a href=\"$clickthru\"><img src=\"$topstory500x250\"></a></li>
			";
			$rotatorclicks .= "
				<li>
					<a href=\"$clickthru\" class=\"topstory_headline color1 bold\">$thistitle</a>
					<br><br>
					$thisexcerpt
					<br><br>
					<a href=\"$clickthru\" class=\"fr bold\">read more &raquo;</a>
				</li>
			";

			$featuredthumbrow .= "
				<div class=\"topstory_scroll_cell\">
					<a href=\"$clickthru\"><img src=\"$topstory500x250\"></a>
				</div>
			";
		}

		$topstoryposition++;
	}

	endwhile;

?>




		<div class="topstory">
			<div class="topstory_left">
				<?php echo $rotatorimages; ?>
			</div>
			<div class="topstory_right">
				<?php echo $rotatorclicks; ?>
			</div>
		</div>


		<div class="clear"></div>


		<div class="topstory_scroll">
			<div class="topstory_scroll_arrow">
				<a href="#"><img src="/wp-content/themes/version7/images/topstoryscrollarrow_left.png"></a>
			</div>
			<?php echo $featuredthumbrow; ?>

			<div class="topstory_scroll_arrow">
				<a href="#"><img src="/wp-content/themes/version7/images/topstoryscrollarrow_right.png"></a>
			</div>


		</div>

		<div class="clear"></div>
		<div id="featured" name="featured3" class="featured_tabs">
			<div id="featured_1" class="tab featured_tab1 cp tab_on">NEWS</div>
			<div id="featured_2" class="tab featured_tab2 cp">POPULAR</div>
			<div id="featured_3" class="tab featured_tab3 cp">WHATS HOT</div>
		</div>


		<div class="clear"></div>


<?php

$featuredposition = 1;
foreach($featuredarray as $featuredcat){

	//featured vars
	$showcheck = false;
	$featuredcells = "";

	// top story sql
	$the_query = new WP_Query('&showposts=4&category_name='.$featuredcat.'&orderby=post_date&order=desc');

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

	if($featuredposition>1){
		$hidecss = "class=\"hide\"";
	}

	//featured
	$featuredcells .= "
			<div id=\"featured_content$featuredposition\" $hidecss>
				<div class=\"subtop_cell\">
					<div class=\"subtop_cell_left\">
						<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>
					</div>
					<div class=\"subtop_cell_right\">
						<a href=\"$clickthru\" class=\"headline\">$thistitle</a>
						<br><br>
						<span class=\"subtop_byline\">by <a href=\"#\" class=\"color1\">John Doe</a> | <img src=\"/wp-content/themes/version7/images/commentbubble.png\"> <a href=\"#\" class=\"color1\">33</a></span>
					</div>
				</div>
			</div>
	";


	endwhile;

?>




			<?php echo $featuredcells; ?>

<?php
$featuredposition++;
}
?>



		<div class="clear" style="height:20px;"></div>


		<div class="greyline650"></div>

		<div class="clear"></div>
		<div class="left4x2">

<?php


for($i=0;$i<$zonecount;$i++){

	//grab zone
	$thiszone = $zonearray[$i];
	$thiszonename = $zonenamearray[$i];

	// zone sql
	$the_query = new WP_Query('&showposts=3&zone='.$thiszone.'&orderby=post_date&order=desc');

	$zonecounter=0;
	$otherlinks = "";
	$post = "";
	//top story loop
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;
	$thispostid = $post->ID;

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
				<a href=\"$clickthru\"><img src=\"$topstory500x250\"></a>
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


			<div class="left4x2_column">
				<a href="<?php echo $zonelinkarray[$i]; ?>"><h3 class="icon1 font2 color1"><?php echo $thiszonename; ?></h3></a>
				<div class="greyline150"></div>
				<?php echo $toplink ?>
				<ul>
				<?php echo $otherlinks ?>
				</ul>
				<div class="left4x2_more ar">
					<a href="#" class="left4x2_more color1">more news &raquo;</a>
				</div>
			</div>


<?php

//check for every four for clear
if(($i==3)||($i==7)||($i==11)){
?>

		<div class="clear"></div>


<?php
}
}
?>

		</div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>