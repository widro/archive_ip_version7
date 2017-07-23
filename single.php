<?php get_header(); ?>


<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

		<div class="article_headline color1 bold">
			<?php the_title(); ?>
		</div>
		<div class="article_subheadline">
			<div class="article_subheadline_left">
				by <a href=<?php echo $authorlink ?>><?php echo $insider_display_name ?></a> on <?php the_time('F j, Y'); ?>  | <a href="mailto:<?php the_author_email(); ?>">Email the author</a> <?php edit_post_link('Edit Post','| ',' '); ?>	<?php if($show_twitter){echo $show_twitter_text;	}?>
			</div>
			<div class="article_subheadline_right">
				<img class="subscribe_newsletter" src="/wp-content/themes/version7/images/sharethistemp.png">
			</div>

		</div>
		<div class="article_body">
				<!-- content -->
				<?php the_content(''); ?>
				<!-- content end -->
		</div>

		<div class="article_box_header">
			<div class="article_box_header_left">
				<h3 class="icon1 font2">Related Articles</h3>

			</div>
			<div class="article_box_header_right">
				<a href="#" class="color1">more articles &raquo;</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="article_box_body">

			<div class="article_box_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"><br>incredible headline because it is all the best of what we have to offer</a>
			</div>

			<div class="article_box_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"><br>incredible headline because it is all the best of what we have to offer</a>
			</div>

			<div class="article_box_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"><br>incredible headline because it is all the best of what we have to offer</a>
			</div>

			<div class="article_box_cell">
				<a href="#"><img src="/wp-content/themes/version7/images/temp/morningbacklash500.jpg"><br>incredible headline because it is all the best of what we have to offer</a>
			</div>



		</div>
<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php get_sidebar(); ?>


<?php get_footer(); ?>