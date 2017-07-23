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
			
			
<div style="height:40px;">
	<div id="fb-root"></div>
	<div style="float:left;margin:10px;">
		<fb:like href="<?php the_permalink(); ?>" layout="button_count" show_faces="true" send="false" width="" action="like" font="arial" colorscheme="light"></fb:like> 
	</div>
	<div style="float:left;margin:10px;"><div>
		<a href="http://twitter.com/share" class="twitter-share-button" 
			data-url="<?php the_permalink(); ?>"
			data-text="<?php the_title(); ?>"
			data-count="horizontal">Tweet</a>
	</div>
	</div>
	<div style="float:left;margin:10px;"><script type="text/javascript" src="http://apis.google.com/js/plusone.js">
                     {lang: 'en-US'}
              </script><g:plusone size="medium" href="<?php the_permalink(); ?>" count="1"></g:plusone></div><div style="float:right;margin:10px;"><a name="fb_share" type="button_count" share_url="<?php the_permalink(); ?>" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=Confirmed two announcer angles, one on each show">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></div></div>

</div>
<br /><br />	        			
			
				<!--<img class="subscribe_newsletter" src="/wp-content/themes/version7/images/sharethistemp.png">-->
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