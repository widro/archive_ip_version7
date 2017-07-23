<?php
$rightfeaturedcount = count($rightfeaturedvalues);

$sidelinks_tabs = "";
for($i=0;$i<$rightfeaturedcount;$i++){
	//grab zone
	$type = $rightfeaturedvalues[$i][0];
	$slug = $rightfeaturedvalues[$i][1];
	$name = $rightfeaturedvalues[$i][2];
	$masterclickthru = $rightfeaturedvalues[$i][3];

	$rightfeaturedposition = $i+1;

	//featured vars
	$showcheck = false;
	$featuredcells = "";

	// top story sql
	$sqladd = makesql($type, $slug);
	$the_query = new WP_Query('&showposts=5'.$sqladd.'&orderby=post_date&order=desc');

	$zonecounter=0;

	//check for which cols to hide
	if($rightfeaturedposition>1){
		$classadd = " class=\"hide\"";
	}
	else{
		$classadd = "tab_on";
	}


	//tab divs
	$sidelinks_tabs .= "<div id=\"sidetabs_$rightfeaturedposition\" class=\"tab sidetabs_tab$rightfeaturedposition cp $classadd\">$name</div>";

	//new div
	$sidelinks .= "<div id=\"sidetabs_content$rightfeaturedposition\" $classadd>";

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
	$thispostid = $post->ID;
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

	$thisdate = mysql2date('m.d.y', $post->post_date);

    $thisuserinfo = get_userdata($post->post_author);
	$thisuser = $thisuserinfo->display_name;
	$thisuserclick = "/" . $authorslug . "/" . $thisuserinfo->user_nicename . "/";

	$sidelinks .= "
			<div class=\"right_cell\">
				<div class=\"right_cell_left\">
					<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>
				</div>
				<div class=\"right_cell_right\">
					<a href=\"$clickthru\">$thistitle</a> <span class=\"date\">($thisdate)</span>
					<br><br>
					<span class=\"right_cell_byline\">by <a href=\"$thisuserclick\" class=\"color1\">$thisuser</a> <img src=\"http://media.insidepulse.com/shared/images/v7/commentbubble.png\" class=\"hide\"> <a href=\"#\" class=\"color1 hide\">33</a></span>
				</div>
			</div>
			<div class=\"clear\"></div>

	";

	$zonecounter++;
	endwhile;
	$sidelinks .= "
		<div class=\"right_cell_more\">
			<a href=\"$masterclickthru\" class=\"color1 bold\">&raquo; more $name</a>
		</div>
	</div>

	";
	}
?>



<?php

	$i=0;
	//grab zone
	$type = $rightnarrowvalues[$i][0];
	$slug = $rightnarrowvalues[$i][1];
	$name = $rightnarrowvalues[$i][2];
	$masterclickthru = $rightnarrowvalues[$i][3];

	// category sql
	$the_query = new WP_Query('&showposts=3&category_name=' . $slug . '&orderby=post_date&order=desc');

	$zonecounter=0;

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
	$thispostid = $post->ID;
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
			<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad300.png"></a>-->
			<!--- start of insidepulse.sportsfanlive.com/default_companion_Position2_(300x250.1) --->
			<script LANGUAGE="JavaScript1.1">
			document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/default/jx/comp/1'+OAS_rns+'@Position2,Left,x06!Position2?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/jx/comp&XE" type="text/javascript"><\/script>');
			</script>
			<NOSCRIPT>
			<A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Position2?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/nx/comp&XE" target="_blank">
			<IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Position2?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/nx/comp&XE" border=0>
			</A>
			</NOSCRIPT>
			<!--- end of insidepulse.sportsfanlive.com/default_companion_Position2_(300x250.1) --->

		</div>

		<div class="clear" style="height:30px;"></div>

		<div id="sidetabs" name="sidetabs2" class="sidetabs_tabs">
			<?php echo $sidelinks_tabs; ?>
		</div>


		<div class="right_container">
			<?php echo $sidelinks ?>
		</div>

		<div class="clear" style="height:40px;"></div>

		<div class="right_container">
			<div class="newsad_left">
				<div class="newsad_left_cell ar">
					<a href="<?php echo $masterclickthru; ?>" class="color1">more <?php echo $name; ?> &raquo;</a>
				</div>
				<?php echo $narrowlinks ?>
			</div>
			<div class="newsad_right">
				<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad160.png"></a>-->

				<!--- start of insidepulse.sportsfanlive.com/default_companion_Left_(160x600.1) --->
				<script LANGUAGE="JavaScript1.1">
				document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/default/jx/comp/1'+OAS_rns+'@Position2,Left,x06!Left?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/jx/comp&XE" type="text/javascript"><\/script>');
				</script>
				<NOSCRIPT>
				<A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Left?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/nx/comp&XE" target="_blank">
				<IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Left?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/nx/comp&XE" border=0>
				</A>
				</NOSCRIPT>
				<!--- end of insidepulse.sportsfanlive.com/default_companion_Left_(160x600.1) --->

			</div>
		</div>

<!--
	<div class="clear" style="height:30px;"></div>
		<div class="right_container greybox">
			<h3 class="icon2m bold">Featured <span class="color1">Writers</span></h3>


			<div class="right_greybox_author">
				<div class="right_greybox_authorleft">
					<h3 class="font2 color2">Jonathan Widro</h3>
					<li><a href="#">The first link on the sidebar with the author is a dinkers</a></li>
					<li><a href="#">The first link on the sidebar with the author is a dinkers</a></li>
				</div>
				<div class="right_greybox_authorright">
					<a href="#"><img src="http://diehardgamefan.com/wordpress/wp-content/uploads/2008/12/widro-150x150.png" class="right_greybox_avatar120"></a>
				</div>
			</div>
		</div>
-->