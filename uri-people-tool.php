<?php
/*
Plugin Name: URI People Tool
Plugin URI: http://www.uri.edu
Description: Create custom post types for WordPress Department Sites
Version: 0.1
Author: John Pennypacker
Author URI: 
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');


/**
 * Create a shortcode for querying people.
 * The shortcode accepts one argument: the category slug
 * e.g. [uri-people-tool group="faculty"]
 */
function uri_people_tool_shortcode($attributes, $content, $shortcode) {
    // normalize attribute keys, lowercase
    $attributes = array_change_key_case((array)$attributes, CASE_LOWER);
    
    // default attributes
    $attributes = shortcode_atts(array(
			'group' => 'faculty', // slug, slug2, slug3
    ), $attributes, $shortcode);
    
		ob_start();
		uri_people_tool_get_people($attributes);
		$output = ob_get_clean();
		return $output;
		
}
add_shortcode( 'uri-people-tool', 'uri_people_tool_shortcode' );



/**
 * Print a list of people
 * Wrapper for WP_Query with some baked in defaults
 * @param arr $args @see https://codex.wordpress.org/Class_Reference/WP_Query
 */
function uri_people_tool_get_people($args) {

	$default_args = array(
		'post_type' => 'people',
		'posts_per_page' => -1,
		'order' => 'DESC',
		'orderby' => array('date' => 'DESC' ),
	);

	// we have a group, get its id and limit query to just the specified group
	if ( $args['group'] ) {
		// get the term's id
		$term = get_terms( 'peoplegroups', 'hide_empty=1&slug=' . sanitize_title( $args['group'] ) );
		$term_id = $term[0]->term_id;
		if ( $term_id ) {
			$default_args['tax_query'] = array(
				array(
					'taxonomy' => 'peoplegroups',
					'field' => 'id',
					'terms' => $term[0]->term_id
				)
			);
		}
	}

// 	echo '<pre>';
// 	var_dump( $args );
// 	echo '</pre>';
	
	$loop = new WP_Query( $default_args );
	
// 	echo '<pre>';
// 	var_dump( $loop );
// 	echo '</pre>';

	$i = 0;
	while ($loop->have_posts()) {
		$i++;
		$loop->the_post();

		// if there's a template in the theme, use it.  Otherwise, use our default.
		if( is_file( get_stylesheet_directory() . '/' . 'templates/partials/person-card.php' ) ) {
			include get_stylesheet_directory() . '/' . 'templates/partials/person-card.php';
		} else {
			include plugin_dir_path( __FILE__ ) . '/' . 'templates/person-card.php';
		}

	}
	wp_reset_postdata();

}

/**
 * Define the custom people post type
 */
function uri_people_tool_post_type_maker() {

	register_post_type('people', array(
		'label' => 'People',
		'description' => 'For faculty, staff, and others.',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'meet'),
		'query_var' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'supports' => array('title','thumbnail',),
		'labels' => array (
			'name' => 'People',
			'singular_name' => 'Person',
			'menu_name' => 'People',
			'add_new' => 'Add Person',
			'add_new_item' => 'Add New Person',
			'edit' => 'Edit',
			'edit_item' => 'Edit Person',
			'new_item' => 'New Person',
			'view' => 'View Person',
			'view_item' => 'View Person',
			'search_items' => 'Search People',
			'not_found' => 'No People Found',
			'not_found_in_trash' => 'No People Found in Trash',
			'parent' => 'Parent Person',
		),
		'menu_icon'   => 'dashicons-id-alt',
	));

	register_taxonomy('peoplegroups', array (
		0 => 'people'
		), array(
			'hierarchical' => true,
			'label' => 'People Groups',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'person'),
			'singular_label' => 'People Group'
		)
	);


}
add_action('init', 'uri_people_tool_post_type_maker');


// require the individual field definitions from a different file
require_once dirname(__FILE__) . '/inc/uri-people-fields.php';