<?php
	$rightsidetabs = createsection($rightfeaturedvalues, "rightsidetabs");
	$sidelinks_tabs = $rightsidetabs['header'];
	$sidelinks = $rightsidetabs['body'];

?>

	</div>
	<div class="content_right">

		<div class="right_container" style="margin-top:20px;min-height:300px;">
			<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad300.png"></a>-->

			<!--- start of insidepulse.sportsfanlive.com_Middle_(300x250) --->
			<script LANGUAGE="JavaScript1.1">OAS_rn = new String (Math.random());OAS_rns = OAS_rn.substring (2, 11);document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/jx/1'+OAS_rns+'@Middle?RM_HTML_CLICK=" type="text/javascript"><\/script>');</script><NOSCRIPT><A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com@Middle?&?RM_HTML_CLICK=" target="_blank"><IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com@Middle?&?RM_HTML_CLICK=" border=0></A></NOSCRIPT><!--- end of insidepulse.sportsfanlive.com_Middle_(300x250) --->
		</div>

			<?php
			// diehardgamefan
			if($zone=='wrestling'){
			?>
			
		<a href="http://insidepulse.com/2015/07/07/ever-wanted-to-write-about-wrestling-join-the-pulse-wrestling-crew-2/"><img src="http://media.insidepulse.com/zones/wrestling/uploads/2015/01/template1600_hiring-500x250.jpg" width=300>
		<h3 style="color:#ff0000;">Join our team of writers!</h1></a>

			<?php
			}

			else{
			}
			?>



		<div class="right_container">
			<div class="fb-like-box" data-href="<?php echo $zonefacebookurl; ?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
		</div>
		<div class="clear"></div>

		<div class="right_container">
			<?php echo $zonetwitterwidget; ?>
		</div>
		<div class="clear"></div>


		<div class="right_container">
			<h3 class="icon2m bold">Featured <span class="color1">Poll</span></h3>
			<?php
			// diehardgamefan
			if($thisurl==$diehardgamefanurl){
				get_poll();
			}

			else{
				if($zonepoll){
					get_poll($zonepoll);
				}
				else{
					get_poll();
				}
			}
			?>


		</div>
		<div class="clear"></div>

		<div class="clear" style="height:30px;"></div>
		<div class="right_container">

		Our very own <a href="http://diehardgamefan.com/latest-updates/?authorid=296&zone=">ML Kennedy</a> has an all-new book!<br>

		<a href="http://www.amazon.com/gp/product/B00UIZPZ52/ref=x_gr_mw_bb_t1_sout_a?ie=UTF8&tag=x_gr_mw_bb_t1_sout_a-20&linkCode=as2&camp=1789&creative=9325&creativeASIN=B00UIZPZ52&SubscriptionId=1MGPYB6YW3HWK55XCGG2"><img src="http://insidepulse.com/wp-content/uploads/2015/03/thanksgivingforwerewolves.jpg"></a>
		<a href="http://www.amazon.com/gp/product/B00UIZPZ52/ref=x_gr_mw_bb_t1_sout_a?ie=UTF8&tag=x_gr_mw_bb_t1_sout_a-20&linkCode=as2&camp=1789&creative=9325&creativeASIN=B00UIZPZ52&SubscriptionId=1MGPYB6YW3HWK55XCGG2"><h3>Check out Thanksgiving for Werewolves and Other Monstrous Tales today!</h3></a>



		</div>

		<div class="clear" style="height:30px;"></div>


		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Recent <span class="color1">Comments</span></h3>

			<script type="text/javascript" src="http://<?php echo $disqusslug ?>.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=1&avatar_size=32&excerpt_length=100"></script>
			<a href="/more-comments">&raquo; more comments</a>
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


		<div class="clear" style="height:40px;"></div>

		<div class="right_container">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Inside Pulse 2014 300 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:250px"
				 data-ad-client="ca-pub-9381773425456350"
				 data-ad-slot="6175499002"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>



		<div class="clear" style="height:40px;"></div>

		<div class="right_container">

		</div>




		<div class="clear" style="height:40px;"></div>

		<div class="right_container">
			<?php
			//$narrowcat = $rightnarrowvalues[0][1];
			//$narrowfile = $overallpath.'generate/category/r-cat-narrow-' . $narrowcat . '.html';
			//if(file_exists ($narrowfile)){
			//	include($narrowfile);
			//}
			//else{
			//	$rightnarrowvalues = createsection($rightnarrowvalues, "narrowlinks");
			//	$make_narrow = make_narrow($rightnarrowvalues);
			//	echo $make_narrow;
			//}
			?>






			<div class="newsad_right">

				<!--- start of insidepulse.sportsfanlive.com_Left_(160x600) --->
				<script LANGUAGE="JavaScript1.1">OAS_rn = new String (Math.random());OAS_rns = OAS_rn.substring (2, 11);document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/jx/1'+OAS_rns+’@Left?RM_HTML_CLICK=" type="text/javascript"><\/script>');</script><NOSCRIPT><A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com@Left?&?RM_HTML_CLICK=" target="_blank"><IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com@Left?&?RM_HTML_CLICK=" border=0></A></NOSCRIPT><!--- end of insidepulse.sportsfanlive.com_Left_(160x600) --->

			</div>
		</div>