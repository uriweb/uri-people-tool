<?php
/**
 * The template for displaying oembed programs
 *
 * @package uri-modern
 */

function uri_people_tool_oembed_styles() {
	print '
	<style>
		@import url("' . get_stylesheet_uri() . '");
		@import url("' . plugins_url() . '/uri-component-library/css/cl.built.css");
	</style>
	';
}
//add_action( 'embed_head', 'uri_people_tool_oembed_styles' );

get_header( 'embed' );
?>
		<?php
		
		while ( have_posts() ) :
			the_post();
			$vars = array(
				'thumbnail' => '',
				'phone' => true,
				'email' => true,
				'website' => false,
				'link' => true,
				'department' => false,
				'address' => false,
			);
			uri_people_tool_get_template( 'person-card.php', $vars );

		?>

		<?php endwhile; // End of the loop. ?>

<?php
get_footer( 'embed' );
