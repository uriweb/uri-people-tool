<?php
	get_header();
	get_template_part( 'sidebar1' );
?>


<div class="grid-11">
	<div class="subcol">
		<div id="content_start" style="display : none ; "></div>

		<?php
			get_template_part( 'templates/partials/alert' );			
			if (have_posts()) : while (have_posts()) : the_post();
			$tagline = get_post_meta($post->ID, 'tagline', $single = true);
			$side = get_post_meta($post->ID, 'side', $single = true);

			get_template_part( 'templates/partials/title' );
		?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 <div class="entry">
				<div class="whoimage"><?php the_post_thumbnail('people-big'); ?></div>
				<ul class="wholist">
					<?php if(get_field('peopletitle')) { ?><li><?php the_field('peopletitle'); ?></li><?php } ?>
					<?php if(get_field('peopledepartment')) { ?><li><?php the_field('peopledepartment'); ?></li><?php } ?>
					<?php if(get_field('peoplephone')) { ?><li><strong>Phone:</strong> <?php the_field('peoplephone'); ?></li><?php } ?>
					<?php if(get_field('peoplefax')) { ?><li><strong>Fax:</strong> <?php the_field('peoplefax'); ?></li><?php } ?>
					<?php if(get_field('peopleemail')) { ?><li><strong>Email:</strong> <a href="mailto:<?php the_field('peopleemail'); ?>"><?php the_field('peopleemail'); ?></a></li><?php } ?>
					<?php if(get_field('peoplemail')) { ?><li><strong>Office Location:</strong> <?php the_field('peoplemail'); ?></li><?php } ?>
				</ul>

				<?php if(get_field('peoplebio')) { ?>
					<h3>Biography</h3>
					<?php the_field('peoplebio'); ?>
				<?php } ?>

				<?php if(get_field('peopleresearch')) { ?>
					<h3>Research</h3>
					<?php the_field('peopleresearch'); ?>
				<?php } ?>

				<?php if(get_field('peopleedu')) { ?>
					<h3>Education</h3>
					<?php the_field('peopleedu'); ?>
				<?php } ?>

				<?php if(get_field('peoplepubs')) { ?>
					<h3>Publications</h3>
					<?php the_field('peoplepubs'); ?>
				<?php } ?>

				<?php if(get_field('peoplecustom')) { ?>
					<?php $getcustom = get_field('peoplecustom'); apply_filters('the_content', $getcustom); echo wpautop($getcustom); ?>
				<?php } ?>

				<?php if(get_field('peopleurl')) { ?>
					<p><strong>Personal website:</strong> <a href="<?php the_field('peopleurl'); ?>"><?php the_field('peopleurl'); ?></a></p>
				<?php } ?>

				<p><?php the_tags(); ?></p>

			</div>
		</div>

		<?php
			if (get_site_option('uri_comments') ) {
				comments_template();
			}
		?>
		<?php endwhile; endif; ?>
		<?php // Above line ends the loop. Calls in Sidebar2 where the call to the custom field "side" will be made ?>
	</div><!-- /end two column -->
</div><!-- /end this middle column -->

<?php get_footer(); ?>