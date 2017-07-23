<?php

	// category sql
	$the_query = new WP_Query('&showposts=5&category_name=reviews&orderby=post_date&order=desc');

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

	$sidelinks .= "
			<div class=\"right_cell\">
				<div class=\"right_cell_left\">
					<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>
				</div>
				<div class=\"right_cell_right\">
					<a href=\"$clickthru\">$thistitle</a>
					<br><br>
					<span class=\"right_cell_byline\">by <a href=\"#\" class=\"color1\">John Doe</a> | <img src=\"/wp-content/themes/version7/images/commentbubble.png\"> <a href=\"#\" class=\"color1\">33</span>
				</div>
			</div>
			<div class=\"clear\"></div>

	";

	$zonecounter++;
	endwhile;
?>



<?php

	// category sql
	$the_query = new WP_Query('&showposts=3&category_name=news&orderby=post_date&order=desc');

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

	$narrowlinks .= "
				<div class=\"newsad_left_cell\">
					<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>
					<a href=\"$clickthru\">$thistitle <span class=\"color1\">&raquo;</span></a>
				</div>
	";

	$zonecounter++;
	endwhile;
?>



	</div>
	<div class="content_right">

		<div class="right_container" style="margin-top:20px;">
			<a href="#"><img src="/wp-content/themes/version7/images/ad300.png"></a>
		</div>

		<div class="clear" style="height:30px;"></div>

<style>

.sidetabs_tabs{
	background:url('/wp-content/themes/version7/images/featured_tabs2_1.png') top left no-repeat;
	width:320px;
	height:33px;
}

.sidetabs_tabs1{
	background:url('/wp-content/themes/version7/images/featured_tabs2_1.png') top left no-repeat;
	width:320px;
	height:33px;
}

.sidetabs_tabs2{
	background:url('/wp-content/themes/version7/images/featured_tabs2_2.png') top left no-repeat;
	width:320px;
	height:33px;
}


.sidetabs_tab1{
	width:120px;
	padding:5px;
	padding-left:20px;
	font-size:.85em;
	color:#999999;
	font-weight:bold;
	float:left;
	text-align:center;
}

.sidetabs_tab2{
	width:105px;
	padding:5px;
	font-size:.85em;
	color:#999999;
	font-weight:bold;
	float:left;
	text-align:center;
}



.tab_on{
	color:#ff0000;
}

</style>

		<div id="sidetabs" name="sidetabs2" class="sidetabs_tabs">
			<div id="sidetabs_1" class="tab sidetabs_tab1 cp tab_on">REVIEWS</div>
			<div id="sidetabs_2" class="tab sidetabs_tab2 cp">POPULAR</div>
		</div>


		<div class="right_container">
			<div id="sidetabs_content1">
			<?php echo $sidelinks ?>
			</div>
			<div id="sidetabs_content2">
			<?php echo $sidelinks ?>
			</div>
		</div>

		<div class="clear" style="height:40px;"></div>

		<div class="right_container">
			<div class="newsad_left">
				<div class="newsad_left_cell ar">
					<a href="#" class="color1">more news &raquo;</a>
				</div>
				<?php echo $narrowlinks ?>
			</div>
			<div class="newsad_right">
				<a href="#"><img src="/wp-content/themes/version7/images/ad160.png"></a>
			</div>
		</div>

	</div>


</div>


