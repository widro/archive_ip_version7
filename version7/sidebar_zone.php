<?php
	$rightsidetabs = createsection($rightfeaturedvalues, "rightsidetabs");
	$sidelinks_tabs = $rightsidetabs['header'];
	$sidelinks = $rightsidetabs['body'];

?>

	</div>
	<div class="content_right">
		<div class="clear" style="height:30px;"></div>
			<div class="right_container greybox">
				<h3 class="icon2m bold">Featured <span class="color1">Writers</span></h3>

				<?php
					$featuredauthorsarray = explode("|", $featuredauthors);
					foreach($featuredauthorsarray as $featured_userid){
						//include($overallpath.'generate/author/r-author-' . $featured_userid . '.html');
						$featuredauthorfile = $overallpath.'generate/author/r-author-' . $featured_userid . '.html';
						if(file_exists ($featuredauthorfile)){
							include($featuredauthorfile);
						}
						else{
							$create_rightauthbox = create_authbox($featured_userid, "rightauthbox");
							echo $create_rightauthbox;
						}
					}
				?>

			</div>

		<div class="clear" style="height:30px;"></div>

		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Recent <span class="color1">Comments</span></h3>

			<script type="text/javascript" src="http://<?php echo $disqusslug ?>.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=0&avatar_size=32&excerpt_length=100"></script>

		</div>

