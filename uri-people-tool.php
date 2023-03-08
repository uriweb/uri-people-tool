<?php
/*
Plugin Name: URI People Tool
Plugin URI: 
Description: Create custom people post type for WordPress Department Sites
Version: 1.4
Author: URI Web Communications
Author URI: 
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

define( 'URI_PEOPLE_TOOL_PATH', plugin_dir_path( __FILE__ ) );


function uri_people_tool_enqueue() {
	wp_enqueue_style( 'uri-people-styles', plugins_url( 'assets/people.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'uri_people_tool_enqueue' );


/**
 * Create a shortcode for querying people.
 * The shortcode accepts arguments: group (the category slug), posts_per_page, before, after
 * e.g. [uri-people-tool group="faculty"]
 */
function uri_people_tool_shortcode($attributes, $content, $shortcode) {
    // normalize attribute keys, lowercase
    $attributes = array_change_key_case((array)$attributes, CASE_LOWER);
    
    // default attributes
    $attributes = shortcode_atts(array(
			'group' => 'faculty', // slug, slug2, slug3
			'id' => NULL,
			'posts_per_page' => 200,
			'thumbnail' => '',
			'link' => TRUE, // link to the people post
			'email' => TRUE, // display the person's email
			'phone' => TRUE, // display the person's phone
			'department' => TRUE, // display the person's phone
			'address' => FALSE, // display the person's website
			'website' => FALSE, // display the person's website
			'before' => '<div class="uri-people-tool">',
			'after' => '</div>',
    ), $attributes, $shortcode);
    
    // check the shortcode attributes for boolean falses, and convert from default if necessary
    foreach( array('link', 'email', 'phone', 'department', 'thumbnail') as $value ) {
			if( strtolower( $attributes[$value] ) == 'false' ) {
				$attributes[$value] = FALSE;
			}
    }

    // check the shortcode attributes for boolean trues, and convert from default if necessary
    foreach( array('address', 'website') as $value ) {
			if( strtolower( $attributes[$value] ) == 'true' ) {
				$attributes[$value] = TRUE;
			}
    }
    
		ob_start();
		uri_people_tool_get_people( $attributes );
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
		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'sortname',
				'compare' => 'EXISTS'
			),
			array(
				'key' => 'sortname',
				'compare' => '!=',
				'value' => ''
			),
		),

		'orderby' => array( 'meta_value' => 'ASC', 'date' => 'DESC' ),
	);

	// check for a numeric posts_per_page value
	if ( $args['posts_per_page'] && is_numeric( $args['posts_per_page'] ) ) {
		$default_args['posts_per_page'] = $args['posts_per_page'];
	}

	if ( NULL !== $args['id'] && is_numeric( $args['id'] ) ) {
		// we have an ID, get the person
		$default_args['p'] = $args['id'];
		//echo '<pre>',print_r($default_args, TRUE), '</pre>';
	} else if ( ! empty( $args['group'] ) ) {
		// we have a group, get its id and limit query to just the specified group
		// @todo: accept a comma-separated list of groups
		// get the term's id
		$term_id = NULL;
		$term = get_terms( 'peoplegroups', 'hide_empty=1&slug=' . sanitize_title( $args['group'] ) );
		$term_id = $term[0]->term_id;

		$default_args['tax_query'] = array(
			array(
				'taxonomy' => 'peoplegroups',
				'field' => 'id',
				'terms' => $term_id
			)
		);
	}

	echo html_entity_decode( $args['before'] );

	// kinda hacky... due to a WPQuery limitation
	// first, query the people with a sortname
	uri_people_tool_loop( $default_args, $args );
	

	// second, query the people without a sortname
	$default_args['meta_query'] = array(
			'relation' => 'OR',
			array(
				'key' => 'sortname',
				'compare' => 'NOT EXISTS'
			),
			array(
				'key' => 'sortname',
				'compare' => '=',
				'value' => ''
			),
		);
	$default_args['orderby'] = array( 'date' => 'DESC' );
	
	uri_people_tool_loop( $default_args, $args );

	echo html_entity_decode ( $args['after'] );

}



/**
 * Query and loop over people
 */
function uri_people_tool_loop( $query_args, $short_code_args ) {
	$loop = new WP_Query( $query_args );
	$i = 0;

	while ($loop->have_posts()) {
		$i++;
		$loop->the_post();
		uri_people_tool_get_template( 'person-card.php', $short_code_args );
	}	
	wp_reset_postdata();
}

/**
 * The "meet" page is just about always unstyled... redirect to people if it exists.
 */
function uri_people_tool_redirect_archive() {
	if( is_post_type_archive( 'people' ) ) {
		$page = get_page_by_path( 'people' );
		if( $page ) {
			wp_safe_redirect( home_url ('/people') , 301 );
			exit();
		}
	}
}
add_action( 'template_redirect', 'uri_people_tool_redirect_archive' );

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
		'show_in_rest' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'meet'),
		'query_var' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'supports' => array('title','thumbnail','editor','revisions','author','custom-fields'), // perhaps 'editor', 'excerpt'
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
			'show_admin_column' => true,
			'show_ui' => true,
			'show_in_rest' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'person'),
			'singular_label' => 'People Group'
		)
	);


}
add_action('init', 'uri_people_tool_post_type_maker', 9);


/**
 * Define a default image size for people thumbnails
 */
// function uri_people_tool_theme_setup() {
// 	add_image_size( 'peoplethumb', 200, 200 );
// }
// add_action( 'after_setup_theme', 'uri_people_tool_theme_setup' );
// 

// require the individual field definitions from a different file
require_once dirname(__FILE__) . '/inc/uri-people-fields.php';

// extend WordPress search to include metadata
require_once dirname(__FILE__) . '/inc/uri-people-extend-search.php';

// require the templating functions
require_once dirname(__FILE__) . '/inc/uri-people-templating.php';

// include the block editor files
require_once dirname(__FILE__) . '/inc/blocks/blocks.php';
