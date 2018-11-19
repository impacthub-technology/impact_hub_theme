<?php get_header(); ?>

<div class="container">
  <?php while ( have_posts() ) { the_post(); ?>
    <div class="container area-stories">
        <div id="sTitle">
            <div class="icon" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>)"></div>
            <div class="data">
                <div class="name"><?php echo get_the_title(); ?><div class="bg1"></div></div>
                <div class="meta bgc2"></div>
            </div>
        </div>
    </div>

	 <div id="single">
        <div class="container">
            <!-- <h5><?php echo get_the_title(); ?></h5> -->
            <p><?php echo get_the_content(); ?></p>

            <ul class="list-unstyled">
                <li>Size <?php the_field( "room_size" ); ?> <?php the_field( "room_size_unit" ); ?></li>
                <li>Seating  <?php the_field( "seating_capacity" ); ?> <?php the_field( "seating_unit" ); ?></li>
                <li>Standing  <?php the_field( "standing_capacity" ); ?> <?php the_field( "standing_unit" ); ?></li>
            </ul>

                <?php
                // check if the repeater field has rows of data
                if( have_rows('amenities') ):
                    echo '<h5>Amenities</h5>';
                    echo '<ul>';
                    while ( have_rows('amenities') ) : the_row();
                        // display a sub field value
                        echo '<li>';
                        the_sub_field('amenity_title');
                        echo '</li>';
                    endwhile;
                    echo '</ul>';
                else :
                    // no rows found
                endif;
                ?>
                <?php
                // if( have_rows('gravity_forms') ):
                  // echo '<h5>Book Now</h5>';

                  $form_object = get_field('gravity_forms');
                  gravity_form_enqueue_scripts( $form_object['id'], true );
                  gravity_form( $form_object['id'], true, true, false, '', true, 1 );
                // endif;
                ?>

        </div>
    </div>

    <style>
        #single h5, #single a {color:#075A61}
        .area-stories .arrow-l {stroke:#075A61!important}
    </style>







  <?php } ?>
</div>

<?php get_footer(); ?>
