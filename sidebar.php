<?php
	$rightsidetabs = createsection($rightfeaturedvalues, "rightsidetabs");
	$sidelinks_tabs = $rightsidetabs['header'];
	$sidelinks = $rightsidetabs['body'];

	$rightsidetabs = createsection($rightnarrowvalues, "narrowlinks");
	$narrowlinks_tabs = $rightsidetabs['header'];
	$narrowlinks = $rightsidetabs['body'];



	//$featuredauthors

	//featuredauthor
	$featuredauthorvalues = array();
	$featuredauthorvalues[] = array('author', '1', 'Jonathan Widro', 'http://diehardgamefan.com/wordpress/wp-content/uploads/2008/12/widro-150x150.png');

	$featuredauthor = createsection($featuredauthorvalues, "featuredauthor");
	$featuredauthor_left = $featuredauthor['header'];
	$featuredauthor_right = $featuredauthor['body'];


?>

	</div>
	<div class="content_right">
<!--

	<div class="clear" style="height:30px;"></div>
		<div class="right_container greybox">
			<h3 class="icon2m bold">Featured <span class="color1">Writers</span></h3>


			<div class="right_greybox_author">
				<div class="right_greybox_authorleft">
					<?php echo $featuredauthor_left; ?>
				</div>
				<div class="right_greybox_authorright">
					<?php echo $featuredauthor_right; ?>
				</div>
			</div>








		</div>




-->










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

		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Recent <span class="color1">Comments</span></h3>

			<script type="text/javascript" src="http://<?php echo $disqusslug ?>.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=0&avatar_size=32&excerpt_length=100"></script>

		</div>

		<div class="clear" style="height:30px;"></div>


		<div id="recentcomments" class="right_container dsq-widget">
			<h3 class="icon2m bold">Search <span class="color1">Pulse</span></h3>

			<form action="/latest-updates/" method="get">
			<?php echo buildfilters("latest", $thisurl, $categoriesskiparray, true); ?>
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
			<div class="newsad_left">
				<div class="newsad_left_cell ar">
				<?php echo $narrowlinks_tabs; ?>
				</div>
				<?php echo $narrowlinks ?>
			</div>
			<div class="newsad_right">
				<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad160.png"></a>-->

				<!--- start of insidepulse.sportsfanlive.com/default_companion_Left_(160x600.1) --->
				<script LANGUAGE="JavaScript1.1">
				document.write('<script LANGUAGE="JavaScript1.1" SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_jx.ads/insidepulse.sportsfanlive.com/default/jx/comp/1'+OAS_rns+'@Position2,Left,x06!Left?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/jx/comp&XE" type="text/javascript"><\/script>');
				</script>
				<NOSCRIPT>
				<A HREF="http://oascentral.sportsfanlive.com/RealMedia/ads/click_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Left?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/nx/comp&XE" target="_blank">
				<IMG SRC="http://oascentral.sportsfanlive.com/RealMedia/ads/adstream_nx.ads/insidepulse.sportsfanlive.com/default/nx/comp@Position2,Left,x06!Left?x?XE&Partner=insidepulse&PartnerUnit=insidepulse.160x600.1.default/nx/comp&XE" border=0>
				</A>
				</NOSCRIPT>
				<!--- end of insidepulse.sportsfanlive.com/default_companion_Left_(160x600.1) --->

			</div>
		</div>
