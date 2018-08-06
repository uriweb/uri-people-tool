<?php
	get_header();
?>

<main>
	<article>

			<?php the_title('<div class="title"><h1>', '</h1></div>'); ?>
		

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry">
					<div class="whoimage"><?php the_post_thumbnail('people-big'); ?></div>
					<ul class="wholist">
						<?php if(get_field('peopletitle')) { ?><li><?php the_field('peopletitle'); ?></li><?php } ?>
						<?php if(get_field('peopledepartment')) { ?><li><?php the_field('peopledepartment'); ?></li><?php } ?>
						<?php if(get_field('peoplephone')) { ?><li><strong class="screen-reader-text">Phone:</strong> <?php the_field('peoplephone'); ?></li><?php } ?>
						<?php if(get_field('peoplefax')) { ?><li><strong>Fax:</strong> <?php the_field('peoplefax'); ?></li><?php } ?>
						<?php if(get_field('peopleemail')) { ?><li><strong class="screen-reader-text">Email:</strong> <a href="mailto:<?php the_field('peopleemail'); ?>"><?php the_field('peopleemail'); ?></a></li><?php } ?>
						<?php if(get_field('peoplemail')) { ?><li><strong class="screen-reader-text">Office Location:</strong> <?php the_field('peoplemail'); ?></li><?php } ?>
					</ul>

					<?php
						the_content();
					?>

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
					
					<hr>

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

	</article>
</main>

<?php get_footer(); ?>