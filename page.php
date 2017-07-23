<?php

//zone pages
if(is_page('home')||is_page('pulsecasts')||is_page('movies')||is_page('tv')||is_page('sports')||is_page('comics-nexus')||is_page('comics')||is_page('music')||is_page('commercials')||is_page('games')||is_page('figures')){
	include('page_zone.php');
}

//video pages
elseif(is_page('new-video')){
	include('page_alphabird.php');
}

elseif(is_page('the-ride-season-3-the-game-ifeadi-odenigbo')){
	include('page_alphabird.php');
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

