<?php include('header_forum.php'); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<!-- content -->
				<?php the_content(''); ?>
				<!-- content end -->
<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>

<div class="clear"></div>

<?php include('footer_forum.php'); ?>