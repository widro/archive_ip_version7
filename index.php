<?php get_header(); ?>
	<div class="content_left">
	<h3 class="icon2m bold" style="margin-top:2px;">Full Listing</span></h3>
<div class="listing_filter">
	<form action="/latest-updates/" method="get">

	<?php
	$regular_filtersfile = $overallpath.'generate/regular_filters.html';
	if(file_exists ($regular_filtersfile)){
		include($regular_filtersfile);
	}
	else{
		echo buildfilters("latest", $thisurl, $categoriesskiparray);
	}
	?>


	</form>
</div>
<?php if (have_posts()) : ?>
<?php


while (have_posts()) : the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 = defaultimage($thiscat_name, "topstory500x250");
	}

	if($topstory120x120==""){
		$topstory120x120 = defaultimage($thiscat_name, "topstory120x120");
	}
	$thistitle = $post->post_title;
	$thisexcerpt = $post->post_excerpt;
	$thisexcerpt = substr($thisexcerpt, 0, 180);
	if(!$thisexcerpt){
		$thisexcerpt = $post->post_content;
	}

	$thisexcerpt = strip_tags($thisexcerpt);
	$thisexcerpt = substr($thisexcerpt, 0, 100);
	$thistitle = str_replace("\"", "", $thistitle);
	$thistitle = substr($thistitle, 0, 100);
	$clickthru=get_permalink($thispostid);
	$thisdate = mysql2date('m.d.y', $post->post_date);
	$author = get_the_author();

	echo listingcell($thistitle, $thisdate, $author, $clickthru, $thisexcerpt, $topstory120x120, $topstory500x250);
endwhile;
?>


<div class="pagelinks">
	<div class="pagelinks_left">
		<?php next_posts_link('&laquo; Previous') ?>
	</div>
	<div class="pagelinks_right">
		<?php previous_posts_link('Next &raquo;') ?>
	</div>
</div>


<?php endif; ?>

<?php include('sidebar.php'); ?>

<?php include('footer.php'); ?>