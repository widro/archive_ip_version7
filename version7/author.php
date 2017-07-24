<?php get_header(); ?>
	<div class="content_left">
<?php
if(get_query_var('author_name')) :
    $curauth = get_user_by('slug', get_query_var('author_name'));
else :
    $curauth = get_userdata(get_query_var('author'));
endif;

$insider_userid = $curauth->ID;
$insider_display_name = $curauth->display_name;
$insider_user_nicename = $curauth->user_nicename;
$insider_user_email = $curauth->user_email;
$insider_description = $curauth->description;

$allusermeta = getusermetawidro($insider_userid);
$insider_authortitle = $allusermeta['authortitle'];
$insider_avatar120 = $allusermeta['avatar120'];
$insider_avatar500 = $allusermeta['avatar500'];
$insider_rss1 = $allusermeta['rss1'];
$insider_rss2 = $allusermeta['rss2'];
$insider_rss3 = $allusermeta['rss3'];
$insider_facebook = $allusermeta['facebook'];
$insider_twitter = twitterlink($allusermeta['twitter']);
$twitterrss = "http://twitter.com/statuses/user_timeline/15921201.rss";
$insider_quote = $allusermeta['quote'];
$insider_row1 = $allusermeta['row1'];
$insider_row2 = $allusermeta['row2'];
$insider_row3 = $allusermeta['row3'];
$insider_row4 = $allusermeta['row4'];
$insider_row5 = $allusermeta['row5'];
$insider_zonesuser = $allusermeta['zonesuser'];
$insider_coverimage = $allusermeta['coverimage'];


if($insider_avatar500==""){
	$insider_avatar500 = defaultimage("avatar", "insider_avatar500");
}

if($insider_avatar120==""){
	$insider_avatar120 = defaultimage("avatar", "insider_avatar120");
}


if(!$insider_coverimage){

	if($active_zone == "insidefights"){
		$insider_coverimage = "http://media.insidepulse.com/shared/images/v7/coverimagefights.jpg";
	}
	elseif($active_zone == "insidefights"){
		$insider_coverimage = "http://media.insidepulse.com/shared/images/v7/default650x325_.jpg";
	}
	else{
		$insider_coverimage = "http://media.insidepulse.com/shared/images/v7/default650x325_.jpg";
	}

}

?>

<style>
.authortop{
	background:url('<?php echo $insider_coverimage ?>') top left no-repeat;
}
</style>






<?php if (have_posts()) : ?>
<?php

	$postarray = array();
while (have_posts()) : the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if($topstory500x250==""){
		$topstory500x250 = defaultimage("top-story", "topstory500x250");
	}

	if($topstory120x120==""){
		$topstory120x120 = defaultimage("top-story", "topstory120x120");
	}

	$thistitle = $post->post_title;
	$thisexcerpt = makeexcerpt($post->post_content, $post->post_excerpt, "default");

	$thiscontent = $post->post_content;

	$thistitle = str_replace("\"", "", $thistitle);

	$clickthru=get_permalink($thispostid);

	//outputs date in wacky format
	$thisdate = mysql2date('h|m|s|m|d|Y', $post->post_date);

	//explodes date by |
	$thisdatearr = explode("|", $thisdate);

	//converts pipe exploded array into unix ts
	$unixtimestamp =  mktime((int)$thisdatearr[0], (int)$thisdatearr[1], (int)$thisdatearr[2], (int)$thisdatearr[3], (int)$thisdatearr[4], (int)$thisdatearr[5]);

	$postarray[$unixtimestamp]['title'] = $thistitle;
	$postarray[$unixtimestamp]['clickthru'] = $clickthru;
	$postarray[$unixtimestamp]['excerpt'] = $thisexcerpt;
	$postarray[$unixtimestamp]['content'] = $thiscontent;
	$postarray[$unixtimestamp]['post_date'] = $post->post_date;
	$postarray[$unixtimestamp]['topstory500x250'] = $topstory500x250;
	$postarray[$unixtimestamp]['topstory120x120'] = $topstory120x120;
endwhile;
endif; ?>





<?php
/*

$wrestlingposts = getrsslinks('http://wrestling.insidepulse.com/insider/widro/feed/', 'Wrestling', 10, "array");
$diehardgamefanposts = getrsslinks('http://diehardgamefan.com/diehard/widro/feed/', 'diehardgamefan', 10, "array");
$insidefightsposts = getrsslinks('http://insidefights.com/insider/widro/feed/', 'insidefights', 10, "array");

$outsideposts = array();
foreach($wrestlingposts as $eachpost){
	$unixtimestamp = mktime($eachpost['post_date']);
	$postarray[$unixtimestamp]['title'] = $eachpost['title'];
	$postarray[$unixtimestamp]['clickthru'] = $eachpost['clickthru'];
	$postarray[$unixtimestamp]['excerpt'] = $eachpost['excerpt'];
	$postarray[$unixtimestamp]['content'] = $eachpost['content'];
	$postarray[$unixtimestamp]['post_date'] = $eachpost['post_date'];
	$postarray[$unixtimestamp]['topstory500x250'] = $eachpost['topstory500x250'];
	$postarray[$unixtimestamp]['topstory120x120'] = $eachpost['topstory120x120'];
}

foreach($diehardgamefanposts as $eachpost){
	$unixtimestamp = mktime($eachpost['post_date']);
	$postarray[$unixtimestamp]['title'] = $eachpost['title'];
	$postarray[$unixtimestamp]['clickthru'] = $eachpost['clickthru'];
	$postarray[$unixtimestamp]['excerpt'] = $eachpost['excerpt'];
	$postarray[$unixtimestamp]['content'] = $eachpost['content'];
	$postarray[$unixtimestamp]['post_date'] = $eachpost['post_date'];
	$postarray[$unixtimestamp]['topstory500x250'] = $eachpost['topstory500x250'];
	$postarray[$unixtimestamp]['topstory120x120'] = $eachpost['topstory120x120'];
}

foreach($insidefightsposts as $eachpost){
	$unixtimestamp = mktime($eachpost['post_date']);
	$postarray[$unixtimestamp]['title'] = $eachpost['title'];
	$postarray[$unixtimestamp]['clickthru'] = $eachpost['clickthru'];
	$postarray[$unixtimestamp]['excerpt'] = $eachpost['excerpt'];
	$postarray[$unixtimestamp]['content'] = $eachpost['content'];
	$postarray[$unixtimestamp]['post_date'] = $eachpost['post_date'];
	$postarray[$unixtimestamp]['topstory500x250'] = $eachpost['topstory500x250'];
	$postarray[$unixtimestamp]['topstory120x120'] = $eachpost['topstory120x120'];
}

//merge outside array and insidepulse array
$postarray2 = ksort($postarray);
$postarray3 = array_reverse($postarray);
//print_r($postarray);
*/
$currentpost =0;
//foreach($postarray3 as $key => $outsidepost){
foreach($postarray as $key => $outsidepost){
	//echo $key . "<br>";

	//vars
	$thisexcerpt = $outsidepost['excerpt'];
	$thisexcerpt = substr($thisexcerpt, 0, 180);

	$thiscontent = $outsidepost['content'];
	$thiscontent = substr(strip_tags($thiscontent), 0, 300);
	$thistitle = $outsidepost['title'];
	$thistitle = str_replace("\"", "", $thistitle);
//	//$thistitle = substr($thistitle, 0, 100);

	$clickthru = $outsidepost['clickthru'];

	if($currentpost%3==1){
		$authorcellcolor = "";
	}
	elseif($currentpost%3==2){
		$authorcellcolor = "fafafa";
	}
	elseif($currentpost%3==0){
		$authorcellcolor = "eeeeee";
	}


	$authorlisting = "
	<div class=\"author_cell\" style=\"background:#$authorcellcolor\">
		<a class=\"bold color1\" href=\"$clickthru\">$thistitle</a> <span class=\"date\">$post_date</span>
		<br>
		<p>$thiscontent <a class=\"bold color1 author_cell_readmore\" href=\"$clickthru\">&raquo;&raquo;</a></p>

	</div>
	<div class=\"clear\"></div>
	";


	if($currentpost%2==0){
		$authorlisting_left .= $authorlisting;
	}

	else{
		$authorlisting_right .= $authorlisting;
	}

	$currentpost++;


}
?>














<div class="authortop">

</div>
<img class="authorbottomimg" src="<?php echo $insider_avatar120 ?>">
<div class="authorbottom">
	<h3 class="icon2m bold" style="margin-top:2px;"><span class="color1"><?php echo $insider_display_name ?></span></h3>
	 <?php echo $insider_description ?>

</div>

<div class="clear" style="height:20px;"></div>

	<h3 class="icon1m bold" style="margin-top:2px;">Full Archive</span></h3>

<div class="author_column fl">
	<?php echo $authorlisting_left ?>
</div>
<div class="author_column fr">
	<?php echo $authorlisting_right ?>
</div>

<div class="clear" style="height:20px;"></div>



<div class="pagelinks">
	<div class="pagelinks_left">
		<?php next_posts_link('&laquo; Previous') ?>
	</div>
	<div class="pagelinks_right">
		<?php previous_posts_link('Next &raquo;') ?>
	</div>
</div>


	</div>
	<div class="content_right">

		<div class="right_container" style="margin-top:20px;">
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
			<h3 class="icon2m bold">Social <span class="color1">Pulse</span></h3>

<?php
if($insider_facebook){
?>
			<div class="right_greybox_row">
				<img class="right_greybox_icon" src="http://media.insidepulse.com/shared/images/v7/icon_greybox_facebook.png">
				<a href="<?php echo $insider_facebook ?>">Facebook</a><br>
				Check me out on facebook and subscribe!
			</div>
<?php
}
?>
<?php
if($insider_twitter){
?>
			<div class="right_greybox_row">
				<img class="right_greybox_icon" src="http://media.insidepulse.com/shared/images/v7/icon_greybox_twitter.png">
				<a href="<?php echo $insider_twitter ?>">Follow on Twitter</a><br>
				Follow me on Twitter
			</div>
<?php
}
?>

			<div class="right_greybox_row">
				<img class="right_greybox_icon" src="http://media.insidepulse.com/shared/images/v7/icon_greybox_rss.png">
				<a href="feed/">Subscribe</a><br>
				Subscribe to all posts via RSS
			</div>


		</div>

		<div class="clear" style="height:30px;"></div>

		<div class="right_container greybox">
			<h3 class="icon1m bold">Stats <span class="color1">Pulse</span></h3>
			<div class="right_greybox_row">
				Some interesting stats:



			</div>



		</div>


<!--
		<div class="clear" style="height:30px;"></div>
		<div class="right_container greybox">
			<h3 class="icon2m bold">Another <span class="color1">Pulse</span></h3>

			<div class="right_greybox_row">
				tasty
			</div>


		</div>

		<div class="clear" style="height:30px;"></div>

		<div class="right_container greybox">
			<h3 class="icon1m bold">Personal <span class="color1">Pulse</span></h3>
			<div class="right_greybox_row">
				Dinkers
			</div>



		</div>

		<div class="right_container" style="margin-top:20px;">
			<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad300.png"></a>
		</div>

-->

<?php include('footer.php'); ?>