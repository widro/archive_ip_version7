<?php
	$rightsidetabs = createsection($rightfeaturedvalues, "rightsidetabs");
	$sidelinks_tabs = $rightsidetabs['header'];
	$sidelinks = $rightsidetabs['body'];

?>

	</div>
	<div class="content_right">

		<div class="right_container" style="margin-top:20px;">
			<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad300.png"></a>-->
			<!--- start of insidepulse.sportsfanlive.com/default_companion_Position2_(300x250.1) --->
			<script LANGUAGE="JavaScript1.1">
			document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/default/jx/comp/1'+OAS_rns+'@Position2,Left,x06!Position2?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/jx/comp&XE" type="text/javascript"><\/script>');
			</script>
			<NOSCRIPT>
			<A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Position2?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/nx/comp&XE" target="_blank">
			<IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Position2?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.300x250.1.default/nx/comp&XE" border=0>
			</A>
			</NOSCRIPT>
			<!--- end of insidepulse.sportsfanlive.com/default_companion_Position2_(300x250.1) --->

		</div>


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

