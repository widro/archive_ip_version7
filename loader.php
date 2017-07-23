<?php
/*
Template Name: Loader
*/
// get vars



if($_GET['page']){
	$currentpage = $_GET['page'];
}
else{
	$currentpage = 1;
}
if($_GET['view']){
	$view = $_GET['view'];
}
if($_GET['limit']){
	$limit = $_GET['limit'];
}
elseif(!$limit){
	$limit = "30";
}


if($_GET['zone']){
	$zone = $_GET['zone'];
}
if($_GET['cat']){
	$category= $_GET['cat'];
}
if($_GET['authorid']){
	$authorid= $_GET['authorid'];
}
if($_GET['tagname']){
	$tagname= $_GET['tagname'];
}


if($_GET['startdate']){
	$startdate= $_GET['startdate'];
}

if($_GET['enddate']){
	$enddate= $_GET['enddate'];
}

if(is_page('around3')){
	$limit = 3;
	$view="aroundthepulse";

	$category= "top-story";
}
elseif($view=="related"){
	$limit = 5;
}
elseif(is_page('latest-updates')){
	$limit = 50;
	$view="latest";

}

elseif(is_page('newsboard')){
	$limit = 50;
	$view="latest";

}


if($zone){
	$browselinkadd .= "&zone=$zone";
	$sqladd .= "&zone=$zone";
	$headerbuild .= "zone as $zone , ";
}

if($category){
	$browselinkadd .= "&category_name=$category";
	$sqladd .= "&category_name=$category";
	$headerbuild .= "category_name as $category , ";
}

if($authorid){
	$browselinkadd .= "&authorid=$authorid";
	$sqladd .= "&author=$authorid";
	$headerbuild .= "author as $author , ";
}

if($tagname){
	$tagname_array = explode("|",$tagname);
	$tagname_array_count = count($tagname_array);

	if($tagname_array_count==1){
		$tagname = $tagname_array[0];
		$browselinkadd .= "&tag=$tagname";
		$sqladd .= "&tag=$tagname";
		//$headerbuild .= "tag as $tagname , ";
		$headerbuild .= "More articles tagged as $tagname";
		$viewalllink = "<a href=/tag/$tagname>View All</a>";

	}
	else{
		$tagtemptype = $tagname_array[0];
		if($tagtemptype=="cat"){
			$category = $tagname_array[1];
			$browselinkadd .= "&category_name=$category";
			$sqladd .= "&category_name=$category";
			$headerbuild .= "More articles in the $category Category";
			$viewalllink = "<a href=/category/$category>View All</a>";

		}
		elseif($tagtemptype=="zone"){
			$zone = $tagname_array[1];
			$browselinkadd .= "&zone=$zone";
			$sqladd .= "&zone=$zone";
			$headerbuild .= "More articles in the $zone Zone";
			$viewalllink = "<a href=/zone/$zone>View All</a>";
		}
		elseif($tagtemptype=="auth"){
			$zone = $tagname_array[1];
			$browselinkadd .= "&zone=$zone";
			$sqladd .= "&zone=$zone";
			$headerbuild .= "More articles in the $zone Zone";
			$viewalllink = "<a href=/insider/$zone>View All</a>";
		}





	}
}


$sqladd .= "&showposts=" . $limit;

//build nav
$offset = (int)$page*(int)$limit+1;
for($i=0;$i<$totalpages; $i++){
	$thispage = $i+1;

	if($currentpage==$thispage){
		$numberlinks .= "<b>$thispage</b> | ";
	}
	else{
		$numberlinks .= "<a href=?page=$thispage>$thispage</a> | ";
	}

}

if($currentpage==1){
	$nextpage = $currentpage+1;
	$nextlink = "<a href=?page=$nextpage>Next</a>";
}
elseif($currentpage==$totalpages){
	$prevpage = $currentpage-1;
	$prevlink = "<a href=?page=$prevpage>Previous</a>";
}
else{
	$nextpage = $currentpage+1;
	$prevpage = $currentpage-1;
	$nextlink = "<a href=?page=$nextpage>Next</a>";
	$prevlink = "<a href=?page=$prevpage>Previous</a>";

}


if($startdate){

	//Create a new filtering function that will add our where clause to the query
	function filter_where($where = '') {
		global $startdate;
		global $zone;
		global $category;
		global $authorid;

		if($startdate){
			$where .= " AND wp_posts.post_date >= '" . $enddate . "'" . " AND wp_posts.post_date <= '" . $startdate . "'";
		}

		if($zone){
			$sqladd .= "&zone=$zone";
		}

		if($category){
			$sqladd .= "&category_name=$category";
		}

		if($authorid){
			$sqladd .= "&author=$authorid";
		}

		//$enddate = date('Y-m-d', strtotime('-60 days'));
		//$startdate = date('Y-m-d', strtotime('-30 days'));

		//posts for March 1 to March 15, 2009
		$where .= " AND wp_posts.post_date >= '" . $enddate . "'" . " AND wp_posts.post_date <= '" . $startdate . "'";
		return $where;
	}


	// Register the filtering function
	add_filter('posts_where', 'filter_where');

}



//build wordpress query
$the_query = new WP_Query('post_status=publish'. $sqladd);
$tempi = 0;
while ($the_query->have_posts()) : $the_query->the_post();
$do_not_duplicate = $post->ID;

//query_posts($sqladd);

$default120url = "http://media.insidepulse.com/shared/images/logos/default120_insidepulse.jpg";
$default500url = "http://media.insidepulse.com/shared/images/logos/default500_insidepulse.jpg";

$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
if($topstory500x250==""){
	$topstory500x250 = defaultimage("loader", "topstory500x250");
}

if($topstory120x120==""){
	$topstory120x120 = defaultimage("loader", "topstory120x120");
}
$thistitle = $post->post_title;
$thisdate = $post->post_date;
$clickthru=get_permalink($thispostid);
$thisexcerpt = $post->post_excerpt;
$thisexcerpt = substr($thisexcerpt, 0, 180);
//$author = $post->post_author;
$author = get_the_author();


if(!$thisexcerpt){
	$thisexcerpt = $post->post_content;
	$thisexcerpt = substr(strip_tags($thisexcerpt), 0, 300);
}


if(!$topstory500x250){
	$topstory500x250 =  $default500avatarurl;
}

if(!$topstory120x120){
	$topstory120x120 = $default120avatarurl;
}



	//$loaderoutput .= listingcell($post, "latest");
	$loaderoutput .=  listingcell($thistitle, $thisdate, $author, $clickthru, $thisexcerpt, $topstory120x120, $topstory500x250);

$tempi++;
endwhile;

?>



<?php get_header(); ?>
	<div class="content_left">

	<h3 class="icon2m bold" style="margin-top:2px;">Full <?php echo $thiscat_name; ?> Listing</span></h3>

<div class="listing_filter">
	<form action="/latest-updates/" method="get">
	<?php echo buildfilters("latest", $thisurl, $categoriesskiparray); ?>
	</form>
</div>


<?php echo $loaderoutput; ?>

<div class="pagelinks">
	<div class="pagelinks_left">
		<?php next_posts_link('&laquo; Previous') ?>
	</div>
	<div class="pagelinks_right">
		<?php previous_posts_link('Next &raquo;') ?>
	</div>
</div>



<?php include('sidebar.php'); ?>

<?php include('footer.php'); ?>