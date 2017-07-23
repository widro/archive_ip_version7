<?php get_header(); ?>


<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
$overalldate = $post->post_date;
$overalldate = substr($overalldate, 0, 10);

//check if there is meta data for randoms
$showdigg = get_post_meta($post->ID, 'showdigg', true);
$livecoverageslug = get_post_meta($post->ID, 'livecoverage', true);
$digest_limit = get_post_meta($post->ID, 'digest_limit', true);
$digest_date = get_post_meta($post->ID, 'digest_date', true);


//author box info
$insider_userid = $post->post_author;
$thiscurauth = get_userdata(intval($insider_userid));

$insider_aim = $thiscurauth->aim;
$insider_description = $thiscurauth->description;
$insider_display_name = $thiscurauth->display_name;
$insider_first_name = $thiscurauth->first_name;
$insider_last_name = $thiscurauth->last_name;
$insider_nickname = $thiscurauth->nickname;
$insider_email = $thiscurauth->user_email;
$insider_user_login = $thiscurauth->user_login;
$insider_user_nicename = $thiscurauth->user_nicename;

if($thisurl=="diehardgamefan.com"){
	$slugvar = "diehard";
}
else{
	$slugvar = "insider";

}

$authorlink = "/" . $slugvar . "/" . $insider_user_nicename . "/";

$allusermeta = getusermetawidro($insider_userid);
$insider_avatar120 = $allusermeta['avatar120'];
$insider_avatar500 = $allusermeta['avatar500'];
$insider_rss1 = $allusermeta['rss1'];
$insider_rss2 = $allusermeta['rss2'];
$insider_rss3 = $allusermeta['rss3'];
$insider_description = $allusermeta['description'];
$insider_facebook = $allusermeta['facebook'];
$insider_twitter = $allusermeta['twitter'];
$insider_twitterrss = $allusermeta['twitterrss'];
$insider_quote = $allusermeta['quote'];
$insider_row1 = $allusermeta['row1'];
$insider_row2 = $allusermeta['row2'];
$insider_row3 = $allusermeta['row3'];

if(!$insider_avatar120){
	$insider_avatar120 = $default120avatarurl;
}

?>




		<div class="article_headline color1 bold">
			<?php the_title(); ?>
		</div>
		<div class="article_subheadline">
			<div class="article_subheadline_left">
				by <a href="<?php echo $authorlink ?>" class="color1"><?php echo $insider_display_name ?></a> on <?php the_time('F j, Y'); ?>  | <a href="mailto:<?php the_author_email(); ?>" class="color1">Email the author</a> <?php edit_post_link('Edit Post','| ',' '); ?>	<?php if($show_twitter){echo $show_twitter_text;	}?>
			</div>
			<div class="article_subheadline_right">

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
<g:plusone></g:plusone>

				</div>

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



<style>
.article_authorbox_body{
	width:660px;
	height:150px;
	background:#f4f4f4;
	border-top:1px #d7d7d7 solid;
	border-bottom:1px #d7d7d7 solid;
	margin-top:10px;
	margin-bottom:10px;
}


.article_authorbox_left{
	width:100px;
	padding-left:30px;
	padding-right:30px;
	padding-top:10px;
	float:left;
}

.article_authorbox_left img{
	width:80px;
	height:80px;
}

.article_authorbox_right{
	width:440px;
	float:left;
	padding-right:40px;
	font-size:.825em;
	background:url('/wp-content/themes/version7/images/greybg.png') top right no-repeat;
}

.article_authorbox_right h3{
	font-size:1.1em;
	font-weight:bold;
}

.comments_cell{
	width:660px;
}

.comments_cell_left{
	width:100px;
	float:left;
}

.comments_cell_left img{
	width:90px;
	height:90px;
	padding:5px;
}

.comments_cell_right{
	width:560px;
	border-bottom:1px solid #eeeeee;
	float:right;
	font-size:.825em;
}






</style>

		<div class="clear" style="height:30px;"></div>

		<div class="article_box_header">
			<div class="article_box_header_left">
				<h3 class="icon1 font2">Insider</h3>

			</div>
			<div class="article_box_header_right">
				<a href="#" class="color1">view profile &raquo;</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="article_authorbox_body">
			<div class="article_authorbox_left">
				<a href=<?php echo $authorlink ?>><img class="avatar" border="0" src=<?php echo $insider_avatar120 ?>></a>
			</div>
			<div class="article_authorbox_right">
				<h3><?php echo $insider_display_name ?></h3>

				<?php echo $insider_description ?>
				<br><br>
				<a href=$insider_twitter target=_blank><img class="icon"  src=http://media.insidepulse.com/shared/images/v6/icon_twitter.jpg border=0></a>
				<a href=mailto:$insider_email target=_blank><img class="icon" src=http://media.insidepulse.com/shared/images/v6/icon_email.jpg border=0></a>

			</div>


		</div>

		<div class="clear" style="height:30px;"></div>


		<div class="article_authorbox_header">
			<div class="article_box_header_left">
				<h3 class="icon1 font2">Comments</h3>

			</div>
			<div class="article_box_header_right">
				<a href="#" class="color1">view profile &raquo;</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="comments_cell">
			<div class="comments_cell_left">
				<a href=<?php echo $authorlink ?>><img class="avatar" border="0" src=<?php echo $insider_avatar120 ?>></a>

			</div>
			<div class="comments_cell_right">
				<a href="">Widro</a><br>
				Commentgoes here and the yadda to the yadda to that dinkers in that stinkers up in that dirnk
				<br><br>
				<a href="">Like</a> &middot; <a href="">Reply</a> &middot; 9 minutes ago
			</div>
		</div>






<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php get_sidebar(); ?>


<?php get_footer(); ?>