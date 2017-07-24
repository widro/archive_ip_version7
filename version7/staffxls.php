<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php
/*
Template Name: Staff XLS
*/


$getallauthors = getinsiders('');

$outputtable .= "<table>";
$outputtable .= "<tr>";
$outputtable .= "<td>ID</td>";
$outputtable .= "<td>Display Name</td>";
$outputtable .= "<td>Nice Name</td>";
$outputtable .= "<td>Email</td>";
$outputtable .= "</tr>";

foreach($getallauthors as $eachauthorarray){

	$outputtable .= "<tr>";
	$thisuser_ID = $eachauthorarray['ID'];
	$outputtable .= "<td>" . $thisuser_ID . "</td>";
	$thisdisplay_name = $eachauthorarray['display_name'];
	$outputtable .= "<td>" . $thisdisplay_name . "</td>";
	$thisuser_nicename = $eachauthorarray['user_nicename'];
	$outputtable .= "<td>" . $thisuser_nicename . "</td>";
	$thisuser_email = $eachauthorarray['user_email'];
	$outputtable .= "<td>" . $thisuser_email . "</td>";
	$outputtable .= "</tr>";
}

$outputtable .= "</table>";
?>


<div class=container_basic>

	<?php echo $outputtable ?>

</div>
