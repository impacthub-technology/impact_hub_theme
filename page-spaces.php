<?php get_header(); ?>

<section id="content" role="main" class="bg6">
	<div class="mdls area-stories bg6">
		<div class="container">
            <div class="mod-content"></div>
			         <div class="row">
                  <?php

                  $args = array(
                      'post_type'       =>  array('space'),
                      'post_status'     =>  'publish'
                  );

                  $the_query            = new WP_Query( $args );

                  if ( $the_query->have_posts() ) {
                          // The Loop
                          while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                  ?>
                                  <div class="col-md-6">
                              						<div class="img" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>)"></div>
                              						<div class="data">
                              							<div class="name"><?php echo get_the_title(); ?><div class="bg1"></div></div>
                              							<?php echo get_the_excerpt(); ?>
                              							<a href="<?php echo get_the_permalink(); ?>"><button class="ih-btn btn2">view<svg class="arrow-r" xmlns="http://www.w3.org/2000/svg" viewBox="11067.266 447.763 12.149 21.415"><defs><style>.arrow-r{fill:transparent;stroke:#fff;stroke-width:2px;}</style></defs><path d="M0-.5l9.167-10L20-.5" transform="translate(11067.5 448.5) rotate(90)"></path></svg></button></a>
                              						</div>
                      					</div>
                      <?php
                      };
                    };
                    ?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
