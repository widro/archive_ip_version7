<?php


// include wordpress crap
//require_once(getenv("DOCUMENT_ROOT")."/wp-load.php");
//$currentpath = $_SERVER['DOCUMENT_ROOT'];
require_once('/nfs/c03/h04/mnt/56814/domains/insidepulse.com/html/wp-load.php');

$currentpath = $_SERVER['DOCUMENT_ROOT'];
$thisurl =  $_SERVER['HTTP_HOST'];

$currentpath_generatepath = $currentpath . "/generate/";

//general folders
$buildfilename_cat = $currentpath_generatepath . "category/";
$buildfilename_zone = $currentpath_generatepath . "zone/";
$buildfilename_author = $currentpath_generatepath . "author/";


//build sidebar category
$categories =  get_categories('');

foreach ($categories as $category) {
	$thiscategory_nicename = $category->category_nicename;
	$thiscat_name = $category->cat_name;


	$footer_cats .= "
		<li><a href=\"/category/$thiscategory_nicename\" title=\"$thiscat_name\">$thiscat_name</a></li>
	";



	$buildfilename_cat_ind = $buildfilename_cat . "r-cat-" . $thiscategory_nicename . ".html";
	$buildfilename_cat_ind2 = $buildfilename_cat . "l-cat-" . $thiscategory_nicename . ".html";
	//$postboxes_sidebar_cats[] = array("category_name=news&", "120", "3", News, "/category/news/");
	//$textcontent = buildpostsidebar($postboxes_sidebar_cats[0], $postboxes_sidebar_cats[1], $postboxes_sidebar_cats[2], $postboxes_sidebar_cats[3], $postboxes_sidebar_cats[4]);

	$textcontent = buildpostsidebar("category_name=".$thiscategory_nicename."&", "120", "3", $thiscat_name, "/category/".$thiscategory_nicename."/");

	//wp query by author here
	//build wordpress query
	$authorid= $_GET['authorid'];
	$the_query = new WP_Query('showposts=5&post_status=publish&category_name='.$thiscategory_nicename.'');

	$tempi = 0;
	$textcontent2 = "";
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$default120url = "http://media.insidepulse.com/shared/images/logos/default120_insidepulse.jpg";
	$default500url = "http://media.insidepulse.com/shared/images/logos/default500_insidepulse.jpg";

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory500x250){
		$topstory500x250 =  $default500avatarurl;
	}

	if(!$topstory120x120){
		$topstory120x120 = $default120avatarurl;
	}
	$thistitle = $post->post_title;
	$post_author = $post->post_author;
	$post_date = $post->post_date;
	$clickthru=get_permalink($thispostid);



	$textcontent2 .= "
		<li><a href=\"$clickthru\" title=\"Permanent Link to $thistitle\"><img src=\"$topstory120x120\" align=left>$thistitle</a></li>
	";


	$tempi++;
	endwhile;



	// fopen file thing etc
	$f = fopen ($buildfilename_cat_ind, 'w');
	fputs ($f, $textcontent);
	fclose ($f);

	echo "success - $buildfilename_cat_ind <br>";


	// fopen file thing etc
	$f = fopen ($buildfilename_cat_ind2, 'w');
	fputs ($f, $textcontent2);
	fclose ($f);

	echo "success - $buildfilename_cat_ind2 <br>";

}



$getallauthors = getinsiders('');
$authorurlslug = "insider";
if($thisurl=="diehardgamefan.com"){
	$authorurlslug = "diehard";
}

foreach($getallauthors as $eachauthorarray){
	$thisdisplay_name = $eachauthorarray['display_name'];
	$thisuser_nicename = $eachauthorarray['user_nicename'];
	$thisuser_ID = $eachauthorarray['ID'];

	if($thisurl=="diehardgamefan.com"){
		$slugvar = "diehard";
	}
	else{
		$slugvar = "insider";

	}

	$authorlink = "/" . $slugvar . "/" . $thisuser_nicename . "/";

	$allusermeta = getusermetawidro($thisuser_ID);
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



	$buildfilename_author_indl = $buildfilename_author . "l-author-" . $thisuser_ID . ".html";
	$buildfilename_author_indr = $buildfilename_author . "r-author-" . $thisuser_ID . ".html";
	$buildfilename_author_indr2 = $buildfilename_author . "r2-author-" . $thisuser_ID . ".html";

	$footer_authors .= "
		<li><a href=\"/$authorurlslug/$thisuser_nicename/\" title=\"$thisdisplay_name\">$thisdisplay_name</a></li>

	";
	$authorbox_content = "
		<a href=\"$authorlink\"><img border=\"0\" src=\"$insider_avatar120\"></a> <i>$insider_description</i>

	";

	//wp query by author here
	//build wordpress query
	$authorid= $_GET['authorid'];
	$the_query = new WP_Query('showposts=5&post_status=publish&author='.$thisuser_ID.'');
	$tempi = 0;
	$authorbox_content2 = "";
	while ($the_query->have_posts()) : $the_query->the_post();
	$do_not_duplicate = $post->ID;

	$default120url = "http://media.insidepulse.com/shared/images/logos/default120_insidepulse.jpg";
	$default500url = "http://media.insidepulse.com/shared/images/logos/default500_insidepulse.jpg";

	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory500x250){
		$topstory500x250 =  $default500avatarurl;
	}

	if(!$topstory120x120){
		$topstory120x120 = $default120avatarurl;
	}
	$thistitle = $post->post_title;
	$post_author = $post->post_author;
	$post_date = $post->post_date;
	$clickthru=get_permalink($thispostid);



	$authorbox_content2 .= "
		<li><a href=\"$clickthru\" title=\"Permanent Link to $thistitle\">$thistitle</a></li>
	";


	$tempi++;
	endwhile;



	// fopen file thing etc
	$f = fopen ($buildfilename_author_indl, 'w');
	fputs ($f, $authorbox_content);
	fclose ($f);

	echo "success - $buildfilename_author_indl <br>";

	$textcontent2 = buildinsider($thisuser_ID, '');


	// fopen file thing etc
	$f = fopen ($buildfilename_author_indr, 'w');
	fputs ($f, $textcontent2);
	fclose ($f);

	echo "success - $buildfilename_author_indr <br>";


	// fopen file thing etc
	$f = fopen ($buildfilename_author_indr2, 'w');
	fputs ($f, $authorbox_content2);
	fclose ($f);

	echo "success - $buildfilename_author_indr2 <br>";



}




$getallzones = getzones('');

foreach($getallzones as $eachzonearray){
	$thiszonename = $eachzonearray['name'];
	$thiszoneid = $eachzonearray['term_id'];
	$thiszoneslug = $eachzonearray['slug'];
	$thiszoneurl = $eachzonearray['oldurl'];

	$buildfilename_zone_indr = $buildfilename_zone . "r-zone-" . $thiszoneslug . ".html";



	$footer_zones .= "
		<li><a href=\"$thiszoneurl\" title=\"$thiszonename\">$thiszonename</a></li>

	";

	// fopen file thing etc
	$f = fopen ($buildfilename_zone_indr, 'w');
	fputs ($f, $textcontent);
	fclose ($f);

	echo "success - $buildfilename_zone_indr <br>";
}





















// if file exists, content is hooray
//$content = "new file of $type for id #$activeid has been created";


?>