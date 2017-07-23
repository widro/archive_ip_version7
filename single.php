<?php get_header(); ?>
	<div class="content_left">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
$overalldate = $post->post_date;
$overalldate = substr($overalldate, 0, 10);



//author box info
$insider_userid = $post->post_author;
$thiscurauth = get_userdata(intval($insider_userid));

$insider_aim = $thiscurauth->aim;
$insider_description = $thiscurauth->description;
$insider_description_short = substr($insider_description, 0, 160);

$insider_display_name = $thiscurauth->display_name;
$insider_first_name = $thiscurauth->first_name;
$insider_last_name = $thiscurauth->last_name;
$insider_nickname = $thiscurauth->nickname;
$insider_email = $thiscurauth->user_email;
$insider_user_login = $thiscurauth->user_login;
$insider_user_nicename = $thiscurauth->user_nicename;

$authorlink = "/" . $authorslug . "/" . $insider_user_nicename . "/";

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

//list terms in taxonomy
// go thru zones of this article
$types[0] = 'zone';
foreach ($types as $type) {
	$taxonomy = $type;
	$terms = wp_get_object_terms( $post->ID, $taxonomy, '' );
	//if zones, what?
	if ($terms) {

	}
}

// check categories for article
//left4x2
$relatedvalues = array();
foreach((get_the_category()) as $category) {
	$thiscatslug = $category->slug;
	$thiscatname = $category->name;
	if($thiscatslug){
		$relatedvalues[] = array('cat', $thiscatslug, $thiscatname, '/category/'.$thiscatslug);
	}
}

// get tags for use in auto images and related posts
$posttags = get_the_tags();
if($posttags){
	$checktagarray = array();
	$tags_count = count($posttags);

	foreach($posttags as $tag) {
		$checktagarray[] = $tag->slug;
		$thistagname = $tag->name;
		$thistagslug = $tag->slug;
		$thistagcount = $tag->count;
	}
}

else{
	$checktagarray[0] = "n";
}

//include auto images file
include_once('autoimages.php');

//set 120 and 500 images to blank
$topstory120x120 = "";
$topstory500x250 = "";

//check if there is meta data for 120 and 500
$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);

//do auto images loop
$autoimages_count = count($autoimages_cats);
for($i=0;$i<$autoimages_count;$i++){
	if (( in_category($autoimages_cats[$i]))  || (in_array($autoimages_tags[$i], $checktagarray))) {
		if(!$topstory500x250){
			$topstory500x250 = $autoimages_topstory500x250[$i];
			if($topstory500x250!=""){
				$addmeta1 = add_post_meta($post->ID, 'topstory500x250', $topstory500x250, true);
			}
		}

		if(!$topstory120x120){
			$topstory120x120 = $autoimages_topstory120x120[$i];
			if($topstory120x120!=""){
				$addmeta1 = add_post_meta($post->ID, 'topstory120x120', $topstory120x120, true);
			}
		}
	}


}


//check if there is credit link
$creditlink = get_post_meta($post->ID, 'creditlink', true);
$credittext = get_post_meta($post->ID, 'credittext', true);
$amazon_link = get_post_meta($post->ID, 'amazon_link', true);

// for movies reviews
$star_rating = get_post_meta($post->ID, 'star_rating', true);
$review_poster = get_post_meta($post->ID, 'review_poster', true);
$review_poster_link = get_post_meta($post->ID, 'review_poster_link', true);
$review_youtube = get_post_meta($post->ID, 'review_youtube', true);
//new movie reviews thangs
$content_rating = get_post_meta($post->ID, 'content_rating', true);
$extras_rating = get_post_meta($post->ID, 'extras_rating', true);
$replay_rating = get_post_meta($post->ID, 'replay_rating', true);


if($content_rating&&$extras_rating&&$replay_rating){
	$movie_review = "yes";

}

if($review_poster){
	$review_poster_image = "<img border=0 src=$review_poster>";
}


if($review_poster_link){
	$review_poster_image = "<a href=$review_poster_link>$review_poster_image</a>";
}


if($review_youtube){
	$review_youtube_embed = "
	<center><object width=\"560\" height=\"340\"><param name=\"movie\" value=\"http://www.youtube.com/v/$review_youtube&hl=en_US&fs=1&color1=0x2b405b&#038;color2=0x6b8ab6\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/$review_youtube&hl=en_US&fs=1&color1=0x2b405b&#038;color2=0x6b8ab6\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"560\" height=\"340\"></embed></object></center>
	";
}


//Zero Stars:
if($star_rating=="0"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}


//Half Star:
if($star_rating==".5"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/half.gif\" alt=\"half\" title=\"half\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179302\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//One Star:
if($star_rating=="1"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//One and Half Star:
if($star_rating=="1.5"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/half.gif\" alt=\"half\" title=\"half\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179302\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//Two Stars:
if($star_rating=="2"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//Two and a Half Stars:
if($star_rating=="2.5"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/half.gif\" alt=\"half\" title=\"half\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179302\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//Three Stars:
if($star_rating=="3"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/blank.gif\" alt=\"blank\" title=\"blank\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179300\" />
";
}

//Three and a Half Stars:
if($star_rating=="3.5"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/half.gif\" alt=\"half\" title=\"half\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179302\" />
";
}

//Four Stars:
if($star_rating=="4"){
$star_image = "
<img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" /><img src=\"http://media.insidepulse.com/zones/movies/uploads/2009/10/star.gif\" alt=\"star\" title=\"star\" width=\"17\" height=\"16\" class=\"aligncenter size-full wp-image-179303\" />
";
}




?>




		<div class="article_headline color1 bold">
			<?php the_title(); ?> <?php edit_post_link('(edit)','',' '); ?>
		</div>
		<div class="article_subheadline">
			<div class="article_subheadline_left">
				by <a href="<?php echo $authorlink ?>" class="color1"><?php echo $insider_display_name ?></a> on <?php the_time('F j, Y'); ?>
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

<div class="fb-like" data-href="<?php echo $currenturlencoded; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>

				</div>
				<div class="social_twitter">
<a href="https://twitter.com/share" class="twitter-share-button" data-text='<?php the_title(); ?>' data-url='<?php echo $currenturl; ?>' data-count="horizontal" data-via="insidepulse" data-related="zonehere">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
				</div>
				<div class="social_googleplus">
<!-- Place this tag in your head or just before your close body tag -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<!-- Place this tag where you want the +1 button to render -->
<g:plusone size="medium"></g:plusone>

				</div>

			</div>

		</div>

<?php
if (in_category('age-gate')){
$articlebodyhide = "hide";
?>
<script>
jQuery(document).ready(function($){ //fire on DOM ready

// age form submit
	$("#ageform_button").click(function(){
		age_check();
		return false;
	});

	//$(".article_body").hide();


});

</script>


<?php
	echo "
			<div name=ageform id=ageform style=\"color:#000000; font-size:16px;\">
					This content is for ages 18 and over only, please verify your birthday before viewing:<br><br>

		";
		echo agegateform();
		echo "
				<br><br><br>

				<div name=ageform_error id=ageform_error style=\"color:#ff0000; font-weight:bold;\">
				</div>
			</div>
	";

}
?>
<div class="article_body <?php echo $articlebodyhide; ?>">
				<center>
				<?php if($review_poster_image){
					echo $review_poster_image;
					echo "<br><br>";
					}
				?>

				<?php

				if($movie_review){

				?>

<img src="<?php echo $topstory500x250; ?>" alt="" title="the-hustler-original" width="620" height="348" class="alignnone size-full wp-image-248092" />
<img src="http://media.insidepulse.com/shared/images/reviews/movies_content.gif" alt="" title="IP Movie Reviews Content" width="113" height="34" class="alignnone size-full wp-image-248093" /><img src="http://media.insidepulse.com/shared/images/reviews/score_<?php echo $content_rating; ?>.gif" alt="" title="IP Movies Review - Score <?php echo $topstory500x250; ?>" width="32" height="34" class="alignnone size-full wp-image-248098" /><img src="http://media.insidepulse.com/shared/images/reviews/movies_extras.gif" alt="" title="IP Movies Review Extras" width="88" height="34" class="alignnone size-full wp-image-248101" /><img src="http://media.insidepulse.com/shared/images/reviews/score_<?php echo $extras_rating; ?>.gif" alt="" title="IP Movies Review - Score <?php echo $topstory500x250; ?>" width="32" height="34" class="alignnone size-full wp-image-248098" /><img src="http://media.insidepulse.com/shared/images/reviews/movies_replay.gif" alt="" title="IP Movies Review Replay" width="84" height="34" class="alignnone size-full wp-image-248104" /><img src="http://media.insidepulse.com/shared/images/reviews/score_<?php echo $replay_rating; ?>.gif" alt="" title="IP Movies Review - Score <?php echo $topstory500x250; ?>" width="32" height="34" class="alignnone size-full wp-image-248098" /><img src="http://media.insidepulse.com/shared/images/reviews/movies_overall.gif" alt="" title="IP Movies Review Overall" width="102" height="34" class="alignnone size-full wp-image-248103" /><img src="http://media.insidepulse.com/shared/images/reviews/score_<?php echo $star_rating; ?>.gif" alt="" title="IP Movies Review - Score <?php echo $topstory500x250; ?>" width="32" height="34" class="alignnone size-full wp-image-248098" /><a href="<?php echo $amazon_link; ?>"><img style="border:none;" src="http://media.insidepulse.com/shared/images/reviews/movies_amazonlogo.gif" alt="" title="IP Movies Review Amazon Logo" width="103" height="34" class="alignnone size-full wp-image-248099" border=0></a>







<center><img src=http://media.insidepulse.com/shared/images/reviews/movies_break.gif></center>

				<?php

				}

				elseif($star_image){
					echo $star_image;
					echo "<br><br>";
					}
				?>
				</center>




				<!-- content -->
				<?php the_content(''); ?>
				<!-- content end -->
				<?php
				echo get_the_tag_list('<p>Tags: ',', ','</p>');
				?>



				<?php if($creditlink){
					echo "<br><br>Source: <a href=";
					echo $creditlink;
					echo " rel=noindex target=_blank>";
					echo $credittext;
					echo "</a>";
					echo "<br><br>";
					}
				?>


				<?php if($star_image){
					echo "<center>";
					echo "<br><br>";
					echo $review_youtube_embed;
					echo "<br><br>";
					echo "</center>";
					}
				?>



		</div>

		<div class="clear" style="height:20px;"></div>

		<?php
		$relatedcat = $relatedvalues[0][1];
		$relatedfile = $overallpath.'generate/category/l-cat-' . $relatedcat . '.html';
		if(file_exists ($relatedfile)){
			include($relatedfile);
		}
		else{
			$create_related = createsection($relatedvalues, "related");
			$relatedoutput = $create_related['header'];
			$relatedoutput .= $create_related['body'];
			echo $relatedoutput;
		}
		?>

		<div class="clear" style="height:30px;"></div>



		<?php
		$authorboxfile = $overallpath.'generate/author/l-author-' . $insider_userid . '.html';
		if(file_exists ($authorboxfile)){
			include($authorboxfile);
		}
		else{
			$create_singleauthbox = create_authbox($insider_userid, "singleauthbox", $authorslug);
			echo $create_singleauthbox;
		}
		?>
		<div class="clear" style="height:30px;"></div>

		<!-- include comments -->
		<?php comments_template(); ?>



<?php
$thisrand = rand(1,2);

if($thisrand==1){
?>
<script type='text/javascript'>
var _CI = _CI || {};
(function() {
var script = document.createElement('script');
ref = document.getElementsByTagName('script')[0];
_CI.counter = (_CI.counter) ? _CI.counter + 1 : 1;
document.write('<div id="_CI_widget_');
document.write(_CI.counter+'"></div>');
script.type = 'text/javascript';
script.src = 'http://widget.crowdignite.com/widgets/1599?_ci_wid=_CI_widget_'+_CI.counter;
script.async = true;
ref.parentNode.insertBefore(script, ref);
})(); </script>
<div style='width: 300px; background-color: #FFFFFF'><a href='http://crowdignite.com/account/1203' style='font: Arial; color:#000000;' target=_blank>Blowing Up Blogs</a></div>

<?php
}else{
?>

<!-- MGID News Widget Start -->
<div id="MarketGid863"><center>
<a href="http://mgid.com/" target="_blank">Loading...</a>
</center></div>
<!-- MGID News Widget End -->
<!-- before </body> tag -->
<script type="text/javascript">
    var MarketGidDate = new Date();
    document.write('<scr'+'ipt type="text/javascript" '+'src="http://jsn.dt07.net/i/n/insidepulse.com.863.js?t='+MarketGidDate.getYear()+MarketGidDate.getMonth()+ '" charset="utf-8" ></scr'+'ipt>');
    </script>


<?php
}
?>



<?php endwhile; else: ?>
	<p>Lost? Go back to the <a href="<?php echo get_option('home'); ?>/">home page</a>.</p>
<?php endif; ?>


<?php include('sidebar.php'); ?>

<?php include('footer.php'); ?>