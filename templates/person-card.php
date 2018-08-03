<?php
/**
 * This mucky HTML is to match the department theme
 * @todo: modernize this.
 */

	// put together a string of miscellaneous custom fields
	$misc = array();
	
	if(get_field('peoplephone')) {
		$misc[] = '<span class="p-tel">' . get_field('peoplephone') . '</span>';
	}
	if(get_field('peopleemail')) {
		$misc[] = '<a class="u-email" href="mailto:' . get_field('peopleemail') . '">' . get_field('peopleemail') . '</a>';
	}
	
	// uncomment the below to add website after phone and email
	/*
	if(get_field('peopleurl')) {
		$misc[] = '<span class="u-url"><a href="' . get_field('peopleurl') . '">website</a></p>';
	}
	*/
	
	$misc = implode( ' &ndash; ', $misc );
	

?><div class="peopleitem h-card">
	<header>
		<div class="header">
			<h3 class="p-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
		</div>
	</header>
	<div class="inside">
		<?php if ( ! empty( $args['thumbnail'] ) && has_post_thumbnail() ) : ?>
		<figure>
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( $args['thumbnail'], array( 'class' => 'u-photo ' . $args['thumbnail'] )); ?></a>
		</figure>
		<?php endif; ?>

		<p class="people-title"><?php the_field('peopletitle'); ?></p>
		
		<p class="people-department"><?php the_field('peopledepartment'); ?></p>

		<?php if(!empty( $misc )): ?>
			<p class="people-misc"><?php print $misc ?></p>
		<?php endif; ?>

		<div style="clear:both;"></div>
	</div>
</div>
