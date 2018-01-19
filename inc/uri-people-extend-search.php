<?php

/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */



function uri_people_tool_filter_search_and_filter( $query_args, $sfid ) {
	
// 	$query_args['meta_key'] = 'peoplebio';
// 	$query_args['meta_value'] = 'geriatrics';
// 	$query_args['meta_compare'] = 'LIKE';
	
	
	$query_args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key' => 'peoplerresearch',
			'value' => 'geriatrics',
			'compare' => 'LIKE',
		),
		array(
			'key' => 'peoplerbio',
			'value' => 'geriatrics',
			'compare' => 'LIKE',
		)
	);
	

// 	echo '<pre>';
// 	var_dump($query_args);
// 	echo '</pre>';
	
	return $query_args;
}
//add_filter( 'sf_edit_query_args', 'uri_people_tool_filter_search_and_filter', 20, 2 );


/**
 * Join posts and postmeta tables
 * NOTE: This joins any post meta table associated with the post, and it may be overkill
 * ALSO: it doesn't check to see if such a join already exists, possibly leading to duplicate joins
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function uri_people_tool_search_join( $join ) {
	global $wpdb;

	if ( is_search() ) {
		$join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}

	return $join;
}
add_filter('posts_join', 'uri_people_tool_search_join' );



/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function uri_people_tool_search_where( $where ) {
	global $pagenow, $wpdb;

	if ( is_search() ) {
		$where = preg_replace(
			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
	}

	return $where;
}
add_filter( 'posts_where', 'uri_people_tool_search_where' );



/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function uri_people_tool_search_distinct( $where ) {
	global $wpdb;

	if ( is_search() ) {
		return "DISTINCT";
	}

	return $where;
}
add_filter( 'posts_distinct', 'uri_people_tool_search_distinct' );

