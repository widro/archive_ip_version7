<?php get_header(); ?>
	<div class="content_left">
<?php //$thiscat = get_the_category();

$thiscat_name= get_cat_name( $cat );

//foreach((get_the_category()) as $category) {
//$thiscat_name .= $category->cat_name . ' ';
//$thiscatid .= $category->cat_ID . ' ';
//}
?>
<style>

.listing_cell{
	width:620px;
	padding:20px;
	margin-bottom:10px;
	border-top:1px #eeeeee solid;
}

.listing_cell_left{
	width:110px;
	float:left;
}

.listing_cell_left img{
	width:90px;
	height:90px;
	padding:10px;
}

.listing_cell_right{
	width:460px;
	padding:20px;
	padding-top:10px;
	float:right;
}

.listing_cell_right a{
	font-size:1em;
}

.listing_cell_right p{
	font-size:.8em;
}


.listing_cell_byline{
	color:#cccccc;
	font-size:.75em;
}

</style>
	<h3 class="icon2m bold" style="margin-top:2px;">Full <?php echo $thiscat_name; ?> Listing</span></h3>

<?php if (have_posts()) : ?>
<?php

while (have_posts()) : the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory500x250){
		$topstory500x250 =  "http://media.insidepulse.com/shared/images/v6/default500.jpg";
	}

	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v6/default120.jpg";
	}
	$thistitle = $post->post_title;
	$thisexcerpt = $post->post_excerpt;
	$thisexcerpt = substr($thisexcerpt, 0, 180);
	$thistitle = str_replace("\"", "", $thistitle);
	$thistitle = substr($thistitle, 0, 100);
	$clickthru=get_permalink($thispostid);
	$thisdate = mysql2date('m.d.y', $post->post_date); 
	$author = get_the_author();

$categorylisting .= "

<div class=\"listing_cell\">
	<div class=\"listing_cell_left\">

		<a href=\"$clickthru\"><img src=\"$topstory120x120\"></a>

	</div>
	<div class=\"listing_cell_right\">
		<a class=\"bold color1\" href=\"$clickthru\">$thistitle</a> ($thisdate)
		<br>
		<p>$thisexcerpt</p>
		<span class=\"listing_cell_byline\">By $author</span>
	</div>
</div>
<div class=\"clear\"></div>
";

endwhile;


echo $categorylisting;
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

<?php get_sidebar(); ?>

<?php get_footer(); ?>