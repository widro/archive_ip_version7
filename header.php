<?php

//global 3 variables for default 120, 500, 120 avatar

global $default120url;
global $default120avatarurl;
global $default500url;
global $default500avatarurl;

$default120url = "http://media.insidepulse.com/shared/images/logos/default120_insidepulse.jpg";
$default500url = "http://media.insidepulse.com/shared/images/logos/default500_insidepulse.jpg";
$default120avatarurl .= "http://media.insidepulse.com/shared/images/v6/default120avatar.jpg";
$default500avatarurl = "http://media.insidepulse.com/shared/images/v6/default500.jpg";



?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>

<?php bloginfo('name'); ?>

<?php
	if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) {
	?>
	|
	<?php } ?>

	<?php wp_title(''); ?>
</title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?<?php echo rand(0,10000000); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
var currentvalue = 1;
</script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/version7.js"></script>
<link rel="shortcut icon" href="http://www.insidepulse.net/favicon.ico" type="image/vnd.microsoft.icon" />

<?php wp_head(); ?>

</head>


<body class="font1">
<div class="top">
	<div class="inner">
		<div class="top_tabs" id="t10" name="t10">

			<div id="nav1" name="nav1" class="tab_cell_nav_on">
				<div class="left">
					<a class="font2" href="/"><img src="/wp-content/themes/version7/images/homeicon.png"></a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav2" name="nav2" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/movies/">Movies</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav3" name="nav3" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/tv/">TV</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav4" name="nav4" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/comics-nexus/">Comics</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav5" name="nav5" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/wrestling/">Wrestling</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav6" name="nav6" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/games/">Video Games</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav7" name="nav7" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/inside-fights/">MMA/Boxing</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav8" name="nav8" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/music/">Music</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav9" name="nav9" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="/zone/sports/">Sports</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav10" name="nav10" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">More</a>
				</div>
				<div class="right"></div>
			</div>

		</div>
		<div class="top_search">
			<?php display_search_box(DISPLAY_RESULTS_AS_POP_UP); ?>


		</div>

	</div>


</div>
<div class="top_sub">
	<div class="inner submenu">
		<li><a href="#">Home</a> &middot;</li>
		<li><a href="#">News</a> &middot;</li>
		<li><a href="#">Reviews</a> &middot;</li>
		<li><a href="#">Twilight</a> &middot;</li>
		<li><a href="#">Survivor</a> &middot;</li>
		<li><a href="#">Full Listing</a></li>

	</div>
</div>

<div class="bar">
	<div class="inner">
		<div class="bar_logo">
			<a href="/"><img src="/wp-content/themes/version7/images/logo.png"></a>
		</div>
		<div class="bar_ad">
			<a href="#"><img src="/wp-content/themes/version7/images/ad728.png"></a>
		</div>
	</div>

</div>



<div class="inner content">

