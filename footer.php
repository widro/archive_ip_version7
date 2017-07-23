	<!-- ends content_right -->
	</div>

<!-- ends overall content -->
</div>
<div class="clear"></div>

<!-- subfooter -->


<div class="subfooter">
	<div class="inner">
		<div class="subfooter_column2a">
				<div class="social_facebooklike">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=130580860308691";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="http://insidepulse.com/dinkers/" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>

				</div>
				<div class="social_twitter">
<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="insidepulse" data-related="zonehere">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
				</div>
				<div class="social_googleplus">
<!-- Place this tag in your head or just before your close body tag -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<!-- Place this tag where you want the +1 button to render -->
<g:plusone size="medium"></g:plusone>

				</div>
		</div>
		<div class="subfooter_column2b">
			<img class="subscribe_newsletter" src="/wp-content/themes/version7/images/newsletter.png">
		</div>
		<div class="subfooter_column2c">

			<input type="text" class="enter_email">
		</div>
		<div class="subfooter_column2d">
			<img src="/wp-content/themes/version7/images/signup.png">
		</div>


	</div>
</div>


<!-- footer -->


<div class="footer">

	<div class="inner">
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Movies</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">TV</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Comics</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Wrestling</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">MMA/Boxing</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Video Games</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Music</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
		<div class="footer_column8">
			<a href="#"><h4 class="font3 color1">Sports</h4></a>

			<a href="#">News</a><br>
			<a href="#">Reviews</a><br>
			<a href="#">Columns</a><br>
			<a href="#">Features</a>
		</div>
	</div>



</div>
<div class="clear"></div>
<div class="footer_line"></div>
<div class="clear"></div>

<div class="footer" style="height:120px">
	<div class="inner">
		<div class="footer_column3a">
			<a href="/about/">About Us</a> &middot;
			<a href="/contact/">Contact Us</a> &middot;
			<a href="/advertising/">Advertise</a> &middot;
			<a href="/contribute/">Contribute</a> &middot;
			<a href="/media-kit/">Media</a> &middot;
			<a href="/staff/">Staff</a> &middot;
			<a href="/privacy/">Privacy</a>
			<br><br>
			&copy; 2011 Inside Pulse, a division of <a href="#">Digital Grout LLC</a>

		</div>
		<div class="footer_column3b ac">
			<a href="#"><img src="/wp-content/themes/version7/images/stayconnected.png" align="left" style="padding-right:25px;"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/facebook.png" align="left" style="padding-right:5px;"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/twitter.png" align="left" style="padding-right:5px;"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/rss.png" align="left" style="padding-right:5px;"></a>

		</div>
		<div class="footer_column3c">
			<a href="#"><img src="/wp-content/themes/version7/images/logo.png"></a>
		</div>



	</div>
</div>





<script>
function changetab(newtab, totaltabs, cssclass){
		for(i=1;i<totaltabs+1;i++){
			$("#nav"+i).removeClass(cssclass+"_on");
			$("#nav"+i).addClass(cssclass+"_off");
		}

		var newtabdiv = "nav" + newtab;
		$("#"+newtabdiv).addClass(cssclass+"_on");

}





jQuery(document).ready(function($){ //fire on DOM ready

	$(".tab_cell_nav_on,.tab_cell_nav_off").click(function(){
		var totaltabs = parseInt($(this).closest('div').parent().attr("name").substr(1,2));
		var thistab = parseInt($(this).closest('div').attr("name").substr(3,2));
		changetab(thistab, totaltabs, "tab_cell_nav");
	});

});





</script>



	<div id="fb-root"></div>


</body>
</html>