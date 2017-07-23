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
				<a href="#" class="fr bold">read more &raquo;</a>

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


<style>

.featured_tabs{
	background:url('/wp-content/themes/version7/images/featured_tabs3_1.png') top left no-repeat;
	width:660px;
	height:33px;
}

.featured_tabs1{
	background:url('/wp-content/themes/version7/images/featured_tabs3_1.png') top left no-repeat;
	width:660px;
	height:33px;
}

.featured_tabs2{
	background:url('/wp-content/themes/version7/images/featured_tabs3_2.png') top left no-repeat;
	width:660px;
	height:33px;
}

.featured_tabs3{
	background:url('/wp-content/themes/version7/images/featured_tabs3_3.png') top left no-repeat;
	width:660px;
	height:33px;
}


.featured_tab1{
	width:120px;
	padding:5px;
	padding-left:20px;
	font-size:.85em;
	color:#999999;
	font-weight:bold;
	float:left;
	text-align:center;
}

.featured_tab2{
	width:105px;
	padding:5px;
	font-size:.85em;
	color:#999999;
	font-weight:bold;
	float:left;
	text-align:center;
}

.featured_tab3{
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

<script>

function changetab(newtab, totaltabs){
		for(i=1;i<totaltabs+1;i++){
			$("#pagetab"+i).removeClass("tab_on");
			$("#pagecontent"+i).addClass("content_off").removeClass("content_on");
		}

		var newtabdiv = "pagetab" + newtab;
		var newcontentdiv = "pagecontent" + newtab;
		$("#"+newtabdiv).addClass("tab_on");

		$("#"+newcontentdiv).addClass("content_on").removeClass("content_off");

}

jQuery(document).ready(function($){ //fire on DOM ready

	$(".tab").click(function(){
		var totalid = $(this).closest('div').parent().attr("id");
		var totalidlength = totalid.length;

		var totaltabs = parseInt($(this).closest('div').parent().attr("name").substr(totalidlength,1));

		var thistab_text = $(this).attr("id").substr(totalidlength+1,1);
		var thistab = parseInt($(this).attr("id").substr(totalidlength+1,1));
		$(this).closest('div').parent().removeClass(totalid+'_tabs').removeClass(totalid+'_tabs1').removeClass(totalid+'_tabs2').removeClass(totalid+'_tabs3').addClass(totalid+'_tabs'+thistab);

		for(i=0;i<totaltabs;i++){
			i1 = i+1;
			var contentid = "#" + totalid + "_content" + i1;
			if(i1==thistab){
				$(contentid).show();
			}
			else{
				$(contentid).hide();
			}
		}

	});
});


</script>




			<div id="featured" name="featured3" class="featured_tabs">
				<div id="featured_1" class="tab featured_tab1 cp tab_on">NEWS</div>
				<div id="featured_2" class="tab featured_tab2 cp">POPULAR</div>
				<div id="featured_3" class="tab featured_tab3 cp">WHATS HOT</div>
			</div>


			<div class="clear"></div>


			<div id="featured_content1">
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
			<div id="featured_content2" class="hide">
				<div class="subtop_cell">
					<div class="subtop_cell_left">
						<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
					</div>
					<div class="subtop_cell_right">
						<a href="#" class="headline">2 out this incredible headline because it is all the best of what we have to offer</a>
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
			<div id="featured_content3" class="hide">
				<div class="subtop_cell">
					<div class="subtop_cell_left">
						<a href="#"><img src="/wp-content/themes/version7/images/temp/bmichaels-120x120.jpg"></a>
					</div>
					<div class="subtop_cell_right">
						<a href="#" class="headline">3 out this incredible headline because it is all the best of what we have to offer</a>
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



		</div>


		<div class="clear" style="height:20px;"></div>


		<div class="greyline650"></div>

		<div class="clear"></div>
		<div class="left4x2">

<?php
$zonearray = array();
$zonenamearray = array();
$zonearray[] = "movies";
$zonenamearray[] = "Movies";
$zonelinkarray[] = "/zone/movies/";
$zonearray[] = "tv";
$zonenamearray[] = "Television";
$zonelinkarray[] = "/zone/tv/";
$zonearray[] = "comics-nexus";
$zonenamearray[] = "Comics Nexus";
$zonelinkarray[] = "/zone/comics-nexus/";
$zonearray[] = "sports";
$zonenamearray[] = "Sports";
$zonelinkarray[] = "/zone/sports/";
$zonearray[] = "wrestling";
$zonenamearray[] = "Wrestling";
$zonelinkarray[] = "http://wrestling.insidepulse.com";
$zonearray[] = "figures";
$zonenamearray[] = "Inside Fights";
$zonelinkarray[] = "http://insidefights.com";
$zonearray[] = "movies";
$zonenamearray[] = "Diehard Gamefan";
$zonelinkarray[] = "http://diehardgamefan.com";
$zonearray[] = "music";
$zonenamearray[] = "Music";
$zonelinkarray[] = "/zone/music/";

$zonecount = count($zonearray);

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
}
?>

		</div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>