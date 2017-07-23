
<!-- subfooter -->


<div class="subfooter">
	<div class="inner">
		<div class="subfooter_column2a">
			<img class="subscribe_newsletter" src="/wp-content/themes/version7/images/sharethistemp.png">
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
			<a href="#">About Us</a>
			<a href="#">Contact Us</a>
			<a href="#">Advertise</a>
			<a href="#">Contribute</a>
			<a href="#">Media</a>
			<a href="#">Privacy</a>
			<br>
			&copy; 2011 Inside Pulse, a division of <a href="#">Digital Grout LLC</a>

		</div>
		<div class="footer_column3b ac">
			<a href="#"><img src="/wp-content/themes/version7/images/stayconnected.png" align="left"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/facebook.png" align="left"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/twitter.png" align="left"></a>
			<a href="#"><img src="/wp-content/themes/version7/images/rss.png" align="left"></a>

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





</body>
</html>