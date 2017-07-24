<?php
	$rightsidetabs = createsection($rightfeaturedvalues, "rightsidetabs");
	$sidelinks_tabs = $rightsidetabs['header'];
	$sidelinks = $rightsidetabs['body'];

?>

	</div>
	<div class="content_right">

		<div class="clear" style="height:30px;"></div>

		<div id="sidetabs" name="sidetabs2" class="sidetabs_tabs">
			<?php echo $sidelinks_tabs; ?>
		</div>

		<div class="right_container">
			<?php echo $sidelinks ?>
		</div>

		<div class="clear" style="height:30px;"></div>

		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Recent <span class="color1">Comments</span></h3>

			<script type="text/javascript" src="http://<?php echo $disqusslug ?>.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=0&avatar_size=32&excerpt_length=100"></script>

		</div>

		<div class="clear" style="height:30px;"></div>


		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Search <span class="color1">Pulse</span></h3>

			<form action="/latest-updates/" method="get">

				<?php
				$right_filtersfile = $overallpath.'generate/right_filters.html';
				if(file_exists ($right_filtersfile)){
					include($right_filtersfile);
				}
				else{
					echo buildfilters("latest", $thisurl, $categoriesskiparray, true);
				}
				?>

			</form>

		</div>

