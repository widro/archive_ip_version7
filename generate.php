<?php


// include wordpress crap
//require_once(getenv("DOCUMENT_ROOT")."/wp-load.php");
//$currentpath = $_SERVER['DOCUMENT_ROOT'];
require_once('/nfs/c03/h04/mnt/56814/domains/insidepulse.net/html/wp-load.php');

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
	$thiscatslug = $category->slug;
	$thiscatname = $category->name;
	$thiscatslug = $category->category_nicename;
	$thiscatname = $category->cat_name;

	$relatedvalues2 = array('cat', $thiscatslug, $thiscatname, '/category/'.$thiscatslug);
	$create_related = createsection($relatedvalues2, "related");
	$relatedoutput = $create_related['header'];
	$relatedoutput .= $create_related['body'];

	$buildfilename_cat_ind = $buildfilename_cat . "l-cat-" . $thiscatslug . ".html";
	$buildfilename_cat_ind2 = $buildfilename_cat . "r-cat-" . $thiscatslug . ".html";

	// fopen file thing etc
	$f = fopen ($buildfilename_cat_ind, 'w');
	fputs ($f, $relatedoutput);
	fclose ($f);

	echo "success - $buildfilename_cat_ind <br>";


	// fopen file thing etc
	$f = fopen ($buildfilename_cat_ind2, 'w');
	fputs ($f, $textcontent2);
	fclose ($f);

	echo "success - $buildfilename_cat_ind2 <br>";

}



$getallauthors = getinsiders('');

foreach($getallauthors as $eachauthorarray){
	$thisdisplay_name = $eachauthorarray['display_name'];
	$thisuser_nicename = $eachauthorarray['user_nicename'];
	$thisuser_ID = $eachauthorarray['ID'];

	$create_singleauthbox = create_authbox($thisuser_ID, "singleauthbox");
	$create_right = create_authbox($thisuser_ID, "rightauthbox");

	$buildfilename_author_indl = $buildfilename_author . "l-author-" . $thisuser_ID . ".html";
	$buildfilename_author_indr = $buildfilename_author . "r-author-" . $thisuser_ID . ".html";






	// fopen file thing etc
	$f = fopen ($buildfilename_author_indl, 'w');
	fputs ($f, $create_singleauthbox);
	fclose ($f);

	echo "success - $buildfilename_author_indl <br>";


	// fopen file thing etc
	$f = fopen ($buildfilename_author_indr, 'w');
	fputs ($f, $create_right);
	fclose ($f);

	echo "success - $buildfilename_author_indr <br>";

}



// if file exists, content is hooray
//$content = "new file of $type for id #$activeid has been created";


?>