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

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

</head>


<body class="font1">

<div class="top">
	<div class="inner">
		<div class="top_tabs" id="t10" name="t10">

			<div id="nav1" name="nav1" class="tab_cell_nav_on">
				<div class="left">
					<a class="font2" href="#"><img src="/wp-content/themes/version7/images/homeicon.png"></a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav2" name="nav2" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Movies</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav3" name="nav3" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">TV</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav4" name="nav4" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Comics</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav5" name="nav5" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Wrestling</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav6" name="nav6" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Video Games</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav7" name="nav7" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">MMA/Boxing</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav8" name="nav8" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Music</a>
				</div>
				<div class="right"></div>
			</div>

			<div id="nav9" name="nav9" class="tab_cell_nav_off">
				<div class="left">
					<a class="font2" href="#">Sports</a>
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
			<input type="text" class="enter_email">
		</div>

	</div>



</div>

<div class="bar">
	<div class="inner">
		<div class="bar_logo">
			<a href="#"><img src="/wp-content/themes/version7/images/logo.png"></a>
		</div>
		<div class="bar_ad">
			<a href="#"><img src="/wp-content/themes/version7/images/ad728.png"></a>
		</div>
	</div>

</div>



<div class="inner content">

	<div class="content_left">