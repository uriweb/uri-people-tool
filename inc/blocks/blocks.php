<?php
/**
 *	URI People Tool blocks
 */


/**
 * Add a block pattern for people.
 */
function uri_people_tool_add_block_patterns() {

	if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return false;
	}
	
	include( URI_PEOPLE_TOOL_PATH . '/inc/blocks/patterns/headline-people.php' );

	register_block_pattern(
		'uri-cl/headline-people',
		array(
			'title'       => $title,
			'content'     => $pattern,
			'description' => ( isset( $description ) ? $description : '' ),
			'keywords'    => ( isset( $keywords ) ? $keywords : 'uri' ),
			'categories'  => ( isset( $categories ) ? $categories : array( 'uri' ) )
		)
	);


}
add_action( 'init', 'uri_people_tool_add_block_patterns', 80 );

