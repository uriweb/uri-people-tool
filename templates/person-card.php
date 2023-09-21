<?php
/**
 * This mucky HTML is to match the department theme
 * @todo: modernize this.
 */
 
 	$has_thumbnail = ( $args['thumbnail'] !== FALSE && has_post_thumbnail() ) ? TRUE : FALSE;

	// put together a string of miscellaneous custom fields
	$misc = array();
	
	if( $args['phone'] === TRUE && get_field('peoplephone') ) {
		$misc[] = '<span class="p-tel">' . get_field('peoplephone') . '</span>';
	}
	if( $args['email'] === TRUE && get_field('peopleemail') ) {
		$misc[] = '<a class="u-email" href="mailto:' . get_field('peopleemail') . '">' . get_field('peopleemail') . '</a>';
	}
	
	// uncomment the below to add website after phone and email
	if( $args['website'] === TRUE && get_field('peopleurl') ) {
		$misc[] = '<span class="u-url"><a href="' . get_field('peopleurl') . '">website</a>';
	}

	if( $args['accepting_students'] === TRUE && get_field('peopleacceptingstudents') === 'Not at this time') {
		$misc[] = '<span class="u-accepting-students">Accepting Students: ' . get_field('peopleacceptingstudents') . '</span>';
	}

	if( $args['accepting_students'] === TRUE && get_field('peopletypestudent')) {
		$misc[] = '<span class="u-accepting-students">Accepting Students: ' . implode(' , ', get_field('peopletypestudent')) . '</span></p>';
	}

	if( $args['accepting_students'] === TRUE && get_field('peopleacceptingstudents') === 'Yes' && !get_field('peopletypestudent')) {
		$misc[] = '<span class="u-accepting-students">Accepting Students: ' . get_field('peopleacceptingstudents') . '</span></p>';
	}
	$misc = implode( ' &ndash; ', $misc );
	

?><div class="peopleitem h-card <?php if ( $has_thumbnail ) { echo 'has-thumbnail'; } ?>">
	<header>
		<div class="header">
			<?php if ( $has_thumbnail ) : ?>
			<figure>
				<?php if ( $args['link'] === TRUE ): ?>
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( $args['thumbnail'], array( 'class' => 'u-photo ' . $args['thumbnail'] )); ?></a>
				<?php else: ?>
					<?php the_post_thumbnail( $args['thumbnail'], array( 'class' => 'u-photo ' . $args['thumbnail'] )); ?>
				<?php endif; ?>
			</figure>
			<?php endif; ?>

			<?php if ( $args['link'] === TRUE ): ?>
				<h3 class="p-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
			<?php else: ?>
				<h3 class="p-name"><?php the_title(); ?></h3>
			<?php endif; ?>

			
		</div>
	</header>
	<div class="inside">

		<p class="people-title p-job-title"><?php the_field('peopletitle'); ?></p>
		
		<?php if ( $args['department'] ) : ?>
		<p class="people-department"><?php the_field('peopledepartment'); ?></p>
		<?php endif; ?>

		<?php if ( $args['address'] ) : ?>
		<p class="people-address p-street-address"><?php the_field('peoplemail'); ?></p>
		<?php endif; ?>

		<?php if(!empty( $misc )): ?>
			<p class="people-misc"><?php print $misc ?></p>
		<?php endif; ?>

		<div style="clear:both;"></div>
	</div>
</div>
