<?php get_header(); ?>

<div class="container">
  <?php while ( have_posts() ) { the_post(); ?>
    <div class="container area-stories">
        <div id="sTitle">
            <div class="icon" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>)"></div>
            <div class="data">
                <div class="name"><?php echo get_the_title(); ?><div class="bg1"></div></div>
                <div class="meta bgc2"><?php the_field( "role" ); ?></div>

                <?php
                // check if the repeater field has rows of data
                if( have_rows('social_media') ):
                    echo '<div class="meta bgc2">

                    <div class="btn-group" role="group">';
                      while ( have_rows('social_media') ) : the_row();
                          echo '<a href="'.get_sub_field('social_media_url').'" class="btn btn-link btn-lg" style="position:relative">' . get_sub_field('social_media_icon') . '</a> ';
                      endwhile;
                    echo '</div>';
                      echo '</div>';
                else :
                    // no rows found
                endif;
                ?>

            </div>
        </div>
    </div>

	 <div id="single">
        <div class="container">
            <p><?php echo do_shortcode( get_the_content() ); ?></p>


        </div>
    </div>

    <style>
        #single h5, #single a {color:#075A61}
        .area-stories .arrow-l {stroke:#075A61!important}
    </style>







  <?php } ?>
</div>

<?php get_footer(); ?>
