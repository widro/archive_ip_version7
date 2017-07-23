<?php get_header(); ?>
	<div class="content_left">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

		<div class="article_headline color1 bold">
			<?php the_title(); ?>
		</div>
		<div class="article_body">
<?php
if(is_page('new-video')){
?>

<iframe name=" insidepulse_visanfl_p1" src=" http://cdn.alphabird.com/assets/iframes/insidepulse_p1/frame_insidepulse_visanfl_p1.htm" width = "640" height="880" frameborder="0" scrolling="no"></iframe>

<?php
}
elseif(is_page('the-ride-season-3-the-game-ifeadi-odenigbo')){
?>

<iframe name=" insidepulse_hss_p1" src="http://cdn.alphabird.com/assets/iframes/insidepulse_hss_p1/frame_insidepulse_hss_p1.htm" width = "640" height="880" frameborder="0" scrolling="no"></iframe>


<?php
}
?>
		</div>



<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php include('sidebar.php'); ?>




<?php include('footer.php'); ?>