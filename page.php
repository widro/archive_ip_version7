<?php

if(is_page('movies')){
	include('zone.php');
}


//movies zone
elseif(is_page('movies')){
	include('zone.php');
}






//authors
elseif(is_page('widro')){
	include('author.php');
}



//slides
elseif(is_page('advertising')){
	include('page_slide.php');
}
elseif(is_page('contribute')){
	include('page_slide.php');
}
elseif(is_page('about')){
	include('page_slide.php');
}
elseif(is_page('media-kit')){
	include('page_slide.php');
}



else{
	include('page_default.php');
}



?>

