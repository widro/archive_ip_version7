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
$insider_twitter = $allusermeta['twitter'];
$twitterrss = "http://twitter.com/statuses/user_timeline/15921201.rss";
$insider_quote = $allusermeta['quote'];
$insider_row1 = $allusermeta['row1'];
$insider_row2 = $allusermeta['row2'];
$insider_row3 = $allusermeta['row3'];
$insider_row4 = $allusermeta['row4'];
$insider_row5 = $allusermeta['row5'];
$insider_zonesuser = $allusermeta['zonesuser'];

if(!$insider_avatar120){
	$insider_avatar120 .= $default120avatarurl;
}

if(!$insider_avatar500){
	$insider_avatar500 .= $default500avatarurl;
}


?>




<style>
.authortop{
	background:url('/wp-content/themes/version7/images/authorlarge.jpg') top left no-repeat;
	width:650px;
	height:325px;
	border: 3px #333333 solid;
	margin-top:-2px;
}

.authorbottom{
	width:360px;
	height:120px;
	padding:20px;
	padding-top:1px;
	background:#ffffff;
	border: 1px #666666 solid;
	margin-top:-80px;
	margin-left:50px;
	font-size:.7em;
	color:#333333;
	opacity: .8;
	filter: alpha(opacity=80);
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
	float:left;

}


.authorbottomimg{
	float:left;
	height:120px;
	width:120px;
	margin-top:-60px;
	margin-left:50px;
	border: 3px #333333 solid;
}




.author_column{
	width:330px;
}
.author_column p{
	font-size:.875em;
}

.author_cell{
	width:320px;
	padding:5px;
	border-top:1px #999999 solid;
	padding-top:10px;
	padding-bottom:10px;
}

.author_cell img{
	width:250px;
	height:125px;
}


.author_cell a{
	font-size:1em;
}

.author_cell p{
	font-size:.8em;
}

.author_cell_readmore{
	text-align:right;
	font-size:.6em;
}

</style>

<?php if (have_posts()) : ?>
<?php

$currentpost =0;
while (have_posts()) : the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory500x250){
		$topstory500x250 =  "http://media.insidepulse.com/shared/images/v6/default500.jpg";
	}

	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v6/default120.jpg";
	}
	$thistitle = $post->post_title;
	$thisexcerpt = $post->post_excerpt;
	$thisexcerpt = substr($thisexcerpt, 0, 180);
	$thiscontent = $post->post_content;
	$thiscontent = substr(strip_tags($thiscontent), 0, 300);
	$thistitle = str_replace("\"", "", $thistitle);
	$thistitle = substr($thistitle, 0, 100);
	$clickthru=get_permalink($thispostid);

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
		<a class=\"bold color1\" href=\"$clickthru\">$thistitle</a>
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
endwhile;

?>



<?php endif; ?>



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






<?php include('sidebar_author.php'); ?>


<?php get_footer(); ?>