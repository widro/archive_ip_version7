<?php get_header(); ?>
	<div class="content_left">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

		<div class="article_headline color1 bold">
			<?php the_title(); ?>
		</div>
		<div class="article_body">
				<!-- content -->
				<?php the_content(''); ?>
				<!-- content end -->


<?php
if(is_page('staff')){

	$getallauthors = getinsiders('');

	foreach($getallauthors as $eachauthorarray){
		$thisdisplay_name = $eachauthorarray['display_name'];
		$thisuser_nicename = $eachauthorarray['user_nicename'];
		$thisavatar120 = $eachauthorarray['avatar120'];
		if(!$thisavatar120){
			$thisavatar120 = $default120avatarurl;
		}
		echo "
			<div style=\"width:130px; float:left;margin-bottom:20px; overflow:hidden;\">
			<img src=\"$thisavatar120\" style=\"width:120px;height:120px;\" align=left>
			<br>
			<a href=\"/insider/$thisuser_nicename/\" title=\"Widro\">$thisdisplay_name</a>
			</div>

		";
	}
}
?>
		</div>



<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php get_sidebar(); ?>




<?php get_footer(); ?>