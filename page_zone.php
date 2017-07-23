<?php get_header(); ?>
	<div class="content_left">

<?php

	//top story vars
	$showcheck = false;
	$topstoryposition = 1;

	// top story sql
	$the_query = new WP_Query('&showposts=4' . $topstorysqladd . '&category_name=top-story&orderby=post_date&order=desc');

	//top story loop
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 = defaultimage("top-story", "topstory500x250");
	}

	if($topstory120x120==""){
		$topstory120x120 = defaultimage("top-story", "topstory120x120");
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
					<a href=\"$clickthru\"><img id=\"topstorythumb_$topstoryposition\" name=\"topstorythumb_$topstoryposition\" src=\"$topstory500x250\" class=\"on\"></a>
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
				<div class=\"topstory_scroll_cell \">
					<a href=\"$clickthru\"><img id=\"topstorythumb_$topstoryposition\" name=\"topstorythumb_$topstoryposition\" src=\"$topstory500x250\"></a>
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
			<div id="topstoryarrowleft" class="topstory_scroll_arrow">
				<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/topstoryscrollarrow_left.png"></a>
			</div>
			<?php echo $featuredthumbrow; ?>

			<div id="topstoryarrowright" class="topstory_scroll_arrow">
				<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/topstoryscrollarrow_right.png"></a>
			</div>


		</div>

		<div class="clear"></div>

<?php
$featuredcount = count($featuredvalues);
	$featuredcells = "";
	$featuredtabs = "";

for($i=0;$i<$featuredcount;$i++){
	//grab zone
	$type = $featuredvalues[$i][0];
	$slug = $featuredvalues[$i][1];
	$name = $featuredvalues[$i][2];
	$masterclickthru = $featuredvalues[$i][3];

	$featuredposition = $i+1;

	//featured vars
	$showcheck = false;

	//build tabs
	if($featuredposition==1){
		$featuredtabs .= "<div id=\"featured_$featuredposition\" class=\"tab featured_tab$featuredposition cp tab_on\">$name</div>";
	}
	else{
		$featuredtabs .= "<div id=\"featured_$featuredposition\" class=\"tab featured_tab$featuredposition cp tab_off\">$name</div>";
	}

	if($featuredposition>1){
		$hidecss = "class=\"hide\"";
	}

	//featured divs
	$featuredcells .= "
			<div id=\"featured_content$featuredposition\" $hidecss>
	";

	// featured sql
	$sqladd = makesql($type, $slug);
	$the_query = new WP_Query('&showposts=4'.$sqladd.'&orderby=post_date&order=desc');

	//featured loop
	$thisfeaturedcount = 0;
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 = defaultimage("top-story", "topstory500x250");
	}

	if($topstory120x120==""){
		$topstory120x120 = defaultimage("top-story", "topstory120x120");
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

    $thisuserinfo = get_userdata($post->post_author);
	$thisuser = $thisuserinfo->display_name;
	$thisuserclick = "/" . $authorslug . "/" . $thisuserinfo->user_nicename . "/";

	//featured
	$featuredcells .= "
				<div class=\"subtop_cell\">
					<div class=\"subtop_cell_left\">
						<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>
					</div>
					<div class=\"subtop_cell_right\">
						<a href=\"$clickthru\" class=\"headline\">$thistitle</a>
						<br>
						<span class=\"subtop_byline\">by <a href=\"$thisuserclick\" class=\"color1\">$thisuser</a> <img src=\"http://media.insidepulse.com/shared/images/v7/commentbubble.png\" class=\"hide\"> <a href=\"#\" class=\"color1 hide\">33</a></span>
					</div>
				</div>
	";

	if($thisfeaturedcount>0&&($thisfeaturedcount%2==1)){
	$featuredcells .= "
				<div class=\"clear\"></div>
	";
	}


	$thisfeaturedcount++;
	endwhile;

	//featured divs
	$featuredcells .= "
				<div class=\"subtop_more\">
					<a href=\"$masterclickthru\" class=\"color1 bold\">&raquo; more $name</a>
				</div>
			</div>
	";


	//$featuredposition++;
}

?>

		<div id="featured" name="featured3" class="featured_tabs">
			<?php echo $featuredtabs; ?>
		</div>
		<div class="clear"></div>
			<?php echo $featuredcells; ?>

		<div class="clear" style="height:20px;"></div>

		<div class="left4x2">

<?php

$left4x2count = count($left4x2values);
for($i=0;$i<$left4x2count;$i++){
	//grab zone
	$type = $left4x2values[$i][0];
	$slug = $left4x2values[$i][1];
	$name = $left4x2values[$i][2];
	$masterclickthru = $left4x2values[$i][3];

	$zonecounter=0;
	$otherlinks = "";
	$post = "";

	$sqladd = makesql($type, $slug);
	//top story loop

	if($type=="rss"){

	//	$left4x2values[] = array('rss', 'http://wrestling.insidepulse.com/feed/', 'Wrestling', 'http://wrestling.insidepulse.com/');

		$postsarrayall = getrsslinks($slug, $name, 4, "array");
		foreach($postsarrayall as $postsarray){
			$topstory120x120 = $postsarray['topstory120x120'];
			$topstory500x250 = $postsarray['topstory500x250'];
			$thistitle = $postsarray['title'];
			$thistitle = strip_tags($thistitle);
			$thisexcerpt = $postsarray['excerpt'];
			$clickthru = $postsarray['clickthru'];
			$post_date = $postsarray['post_date'];

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
		}
	}
	else{
		// zone sql
		$the_query = new WP_Query('&showposts=4'.$sqladd.'&orderby=post_date&order=desc');

		while ($the_query->have_posts()) : $the_query->the_post();
			$do_not_duplicate = $post->ID;
			$thispostid = $post->ID;

			$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
			$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);

			if($topstory500x250==""){
				$topstory500x250 = defaultimage($active_zone, "topstory500x250");
			}

			if($topstory120x120==""){
				$topstory120x120 = defaultimage($active_zone, "topstory120x120");
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
	}
?>


			<div class="left4x2_column">
				<a href="<?php echo $masterclickthru; ?>"><h3 class="icon1 font2 color1"><?php echo $name; ?></h3></a>
				<div class="greyline150"></div>
				<?php echo $toplink ?>
				<ul>
				<?php echo $otherlinks ?>
				</ul>
				<div class="left4x2_more ar">
					<a href="<?php echo $masterclickthru; ?>" class="left4x2_more color1">more &raquo;</a>
				</div>
			</div>

<?php

		//check for every four for clear
		if(($i==3)||($i==7)||($i==11)){
			echo "<div class=\"clear\"></div>";
		}
}
?>

		</div>


<?php include('sidebar.php'); ?>


<?php include('footer.php'); ?>
