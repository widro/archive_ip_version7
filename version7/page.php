<?php

//zone pages
if(is_page('home')||is_page('pulsecasts')||is_page('movies')||is_page('tv')||is_page('sports')||is_page('comics-nexus')||is_page('comics')||is_page('music')||is_page('commercials')||is_page('games')||is_page('figures')){
//	include('page_zone.php');
	include('loader.php');
}

//video pages
elseif(is_page('dell2')||is_page('new-video')||is_page('silverado2')||is_page('the-ride-season-3-the-game-ifeadi-odenigbo')){
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
elseif(is_page('tv-show-madness')){
	include('page_full.php');
}
elseif(is_page('tv-show-madness-brackets')){
	include('page_full.php');
}
elseif(is_page('2013-inside-pulse-best-television-show-couple-tournament')){
	include('page_full.php');
}
elseif(is_page('2014-inside-pulse-best-tv-show-tournament-bracket')){
	include('page_full.php');
}


else{
	include('page_default.php');
}



?>

