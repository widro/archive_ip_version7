<?php
add_filter( 'manage_posts_columns', 'govid_columns' ); //Filter out Post Columns with 2 custom columns

function govid_columns($defaults) {
    //$defaults['language'] = __('Language'); //Language and Films is name of column
    $defaults['zone'] = __('Zones');
    return $defaults;
}

add_action('manage_posts_custom_column', 'govid_custom_column', 10, 2); //Just need a single function to add multiple columns

function govid_custom_column($column_name, $post_id) {
    global $wpdb;
    if( $column_name == 'zone' ) {
		$tags = get_the_terms($post->ID, 'zone'); //lang is the first custom taxonomy slug
		if ( !empty( $tags ) ) {
			$out = array();
			foreach ( $tags as $c )
				$out[] = "<a href='edit.php?zone=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'lang', 'display')) . "</a>";
			echo join( ', ', $out );
		} else {
			_e('No Zones??.');  //No Taxonomy term defined
		}
	}  else {
		echo '<i>'.__('None').'</i>'; //Only 2 columns, blank now.
	}
}







function in_zone( $zonetocheck, $_post = null ) {
	if ( empty( $zonetocheck ) )
		return false;

	if ( $_post ) {
		$_post = get_post( $_post );
	} else {
		$_post =& $GLOBALS['post'];
	}

	if ( !$_post )
		return false;

	$r = is_object_in_term( $_post->ID, 'zone', $zonetocheck );
	if ( is_wp_error( $r ) )
		return false;
	return $r;
}



// Custom Taxonomy Code
add_action( 'init', 'build_taxonomies', 0 );
function build_taxonomies() {
	$labels1 = array(
		'name' => _x( 'Zones', 'taxonomy general name' ),
		'singular_name' => _x( 'Zone', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Zones' ),
		'all_items' => __( 'All Zones' ),
		'parent_item' => __( 'Parent Zone' ),
		'parent_item_colon' => __( 'Parent Zone:' ),
		'edit_item' => __( 'Edit Zone' ),
		'update_item' => __( 'Update Zone' ),
		'add_new_item' => __( 'Add New Zone' ),
		'new_item_name' => __( 'New Zone Name' ),
	);

	register_taxonomy(
		'zone',
		'post',
		array(
			'hierarchical' => true,
			'labels' => $labels1,
			'public' => TRUE,
			'show_ui' => TRUE,
			'query_var' => 'zone',
			'rewrite' => true
		)
	);
}






































































function getusermetawidro($userid){

	$sqltemp = "
	SELECT meta_key, meta_value
	FROM wp_usermeta
	WHERE user_id = '$userid'
	";

	$resulttemp = mysql_query($sqltemp);
	$totalrows = mysql_num_rows($resulttemp);


	$thumbnailurl = $rowtemp['meta_value'];

	while($rowtemp = mysql_fetch_array($resulttemp)){
		$meta_key = $rowtemp['meta_key'];
		$content[$meta_key] = $rowtemp['meta_value'];
	}

	return $content;

}

function getpostmetawidro($post_id){

	$sqltemp = "
	SELECT meta_key, meta_value
	FROM wp_postmeta
	WHERE post_id = '$post_id'
	";

	$resulttemp = mysql_query($sqltemp);
	$totalrows = mysql_num_rows($resulttemp);


	$thumbnailurl = $rowtemp['meta_value'];

	while($rowtemp = mysql_fetch_array($resulttemp)){
		$meta_key = $rowtemp['meta_key'];
		$content[$meta_key] = $rowtemp['meta_value'];
	}

	return $content;

}



?>