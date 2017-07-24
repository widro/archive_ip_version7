<?php
/*
Template Name: Ajax
*/
// get vars



if($_GET['currentpage']){
	$currentpage = $_GET['currentpage'];
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


?>

dinkers