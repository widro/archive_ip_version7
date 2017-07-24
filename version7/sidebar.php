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
						$create_rightauthbox = create_authbox($featured_userid, "rightauthbox", $authorslug);
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




		<div class="clear" style="height:30px;"></div>

		<div id="sidetabs" name="sidetabs2" class="sidetabs_tabs">
			<?php echo $sidelinks_tabs; ?>
		</div>

		<div class="right_container">
			<?php echo $sidelinks ?>
		</div>

		<div class="clear" style="height:40px;"></div>

		<div class="right_container">
			<?php
			$narrowcat = $rightnarrowvalues[0][1];
			$narrowfile = $overallpath.'generate/category/r-cat-narrow-' . $narrowcat . '.html';
			if(file_exists ($narrowfile)){
				include($narrowfile);
			}
			else{
				$rightnarrowvalues = createsection($rightnarrowvalues, "narrowlinks");
				$make_narrow = make_narrow($rightnarrowvalues);
				echo $make_narrow;
			}
			?>
			<div class="newsad_right">
				<img src="http://media.insidepulse.com/shared/images/v7/ad160.png">
			</div>
		</div>
<?php
if($thisurl==$insidefightsurl){
?>
		<div class="clear" style="height:30px;"></div>

		<a href="http://mmatycoon.com" target=_blank><img src="http://media.insidepulse.com/shared/images/ads/mmatycoon.jpg"></a>

<?php
}
?>
