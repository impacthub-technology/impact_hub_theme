<?php get_header(); ?>

    <div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="container area-stories">
                <div id="sTitle">
                    <div class="icon" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>)"></div>
                    <div class="data">
                        <div class="name"><?= get_the_title(); ?><div class="bg1"></div></div>
                        <div class="meta bgc2"></div>
                    </div>
                </div>
            </div>

            <div id="single">
                <div class="container">
                    <p><?= get_the_content(); ?></p>

                    <ul class="list-unstyled">
                        <li><?= __('Size', 'impact-hub-theme') ?> <?= get_field( "room_size" ) ?> <?= get_field( "room_size_unit" ) ?></li>
                        <li><?= __('Seating', 'impact-hub-theme') ?> <?= get_field( "seating_capacity" ) ?> <?= get_field( "seating_unit" ) ?></li>
                        <li><?= __('Standing', 'impact-hub-theme') ?> <?= get_field( "standing_capacity" ) ?> <?= get_field( "standing_unit" ) ?></li>
                    </ul>

					<?php if ( have_rows('amenities') ): ?>
                        <h5><?= __('Amenities','impact-hub-theme') ?></h5>
                        <ul>
							<?php while ( have_rows('amenities') ) : the_row(); ?>
                                <li><?= get_sub_field('amenity_title') ?></li>
							<?php endwhile; ?>
                        </ul>
					<?php endif; ?>

					<?php
					$form_object = get_field('gravity_forms');
					if($form_object) {
						gravity_form_enqueue_scripts( $form_object['id'], true );
						gravity_form( $form_object['id'], true, true, false, '', true, 1 );
					}
					?>
                </div>
            </div>
		<?php endwhile; ?>
    </div>
    <style>
        #single h5, #single a {color:#075A61}
        .area-stories .arrow-l {stroke:#075A61!important}
    </style>

<?php get_footer(); ?>