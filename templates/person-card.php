<?php

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
	<div class="header">
		<h3 class="p-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	</div>
	<div class="inside">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('people-thumb', array( 'class' => 'u-photo' )); ?></a>
		<?php else : ?>
		<a href="<?php the_permalink() ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/default/uri80.gif" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
		<?php endif; ?>

		<p><?php the_field('peopletitle'); ?></p>
		
		<p class="people-department"><?php the_field('peopledepartment'); ?></p>

		<?php if(!empty( $misc )): ?>
			<p><?php print $misc ?></p>
		<?php endif; ?>

		<div style="clear:both;"></div>
	</div>
</div>
