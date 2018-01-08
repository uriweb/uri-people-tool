<?php
/*
Plugin Name: URI People Tool
Plugin URI: http://www.uri.edu
Description: Create custom post types for WordPress Department Sites
Version: 0.2
Author: John Pennypacker
Author URI: 
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');


/**
 * Create a shortcode for querying people.
 * The shortcode accepts arguments: group (the category slug), posts_per_page
 * e.g. [uri-people-tool group="faculty"]
 */
function uri_people_tool_shortcode($attributes, $content, $shortcode) {
    // normalize attribute keys, lowercase
    $attributes = array_change_key_case((array)$attributes, CASE_LOWER);
    
    // default attributes
    $attributes = shortcode_atts(array(
			'group' => 'faculty', // slug, slug2, slug3
			'posts_per_page' => -1,
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
					'terms' => $term_id
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
		uri_people_tool_get_template( 'person-card.php' );
	}
	
	wp_reset_postdata();

}


/**
 * Locate page template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/templates/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/uri-people-tool/templates/$template_name.
 *
 * http://jeroensormani.com/how-to-add-template-files-in-your-plugin/
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string	Path to the template file.
 */
function uri_people_tool_locate_template( $template_name, $template_path = '', $default_path = '' ) {

// 	echo '<pre>Template Name: ';
// 	var_dump( $template_name );
// 	echo '</pre>';

	// Set variable to search in woocommerce-plugin-templates folder of theme.
	if ( ! $template_path ) :
		$template_path = 'templates/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = plugin_dir_path( __FILE__ ) . 'templates/'; // Path to the template folder
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'uri_people_tool_locate_template', $template, $template_name, $template_path, $default_path );

}

/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see wcpt_locate_template()
 *
 * @param string 	$template_name			Template to load.
 * @param array 	$args					Args passed for the template file.
 * @param string 	$string $template_path	Path to templates.
 * @param string	$default_path			Default path to template files.
 */
function uri_people_tool_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {

	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;

	$template_file = uri_people_tool_locate_template( $template_name, $tempate_path, $default_path );

	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;


	include $template_file;

}


/**
 * Template loader.
 *
 * The template loader will check if WP is loading a template
 * for a specific Post Type and will try to load the template
 * from out 'templates' directory.
 *
 *
 * @param	string	$template	Template file that is being loaded.
 * @return	string				Template file that should be loaded.
 */
function uri_people_tool_template_loader( $template ) {
	
	if ( is_single() && get_post_type() === 'people' ) {
	
		// if it's a people page, then override $template with the custom one
		// use "people" instead of "person" for backwards compatability.
		$file = 'single-people.php';

		if ( file_exists( uri_people_tool_locate_template( $file ) ) ) {
			$template = uri_people_tool_locate_template( $file );
		}

	}

	return $template;

}
add_filter( 'template_include', 'uri_people_tool_template_loader', 99 );




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