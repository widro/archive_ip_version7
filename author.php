<?php get_header(); ?>

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

AUTHOR

				<img src=<?php echo $insider_avatar120 ?>> <?php echo $insider_description ?>

<?php get_sidebar(); ?>


<?php get_footer(); ?>