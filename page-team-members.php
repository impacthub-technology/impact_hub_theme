<?php get_header(); ?>
<div id="content" role="main" class="bg6">


    <section class="vc_section bg1">

        <div class="vc_row wpb_row vc_row-fluid">
          <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
              <div class="wpb_wrapper">
                  <div class="mdls area-team bg1">
                      <?php the_content(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="wpb_wrapper">
            <div class="mdls area-team bg1">
                  <div class="container">
                      <div class="row">

                        <?php

                        $args = array(
                            'post_type'       =>  array('team_member'),
                            'post_status'     =>  'publish'
                        );

                        $the_query            = new WP_Query( $args );

                        // echo '$wpdb->last_query'.$wpdb->last_query;

                        if ( $the_query->have_posts() ) {
                                // The Loop
                                while ( $the_query->have_posts() ) {
                                  $the_query->the_post();
                                    ?>

                                    <div class="item row col-md-6">
                                  			<div class="col-sm-6 col-xs-6 img" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>)"></div>
                                  			<div class="col-sm-6 col-xs-6 data">
                                  				<div class="name text-uppercase"><?php the_field( "first_name" ); ?></div>
                                  				<div class="name text-uppercase"><?php the_field( "last_name" ); ?></div>
                                  				<div class="bg2"></div>
                                  				<div class="pos"><?php the_field( "role" ); ?></div>
                                  				<div class="email bgc2 text-lowercase"><?php the_field( "email" ); ?></div>
                                  			</div>
                                              <a href="<?php echo get_the_permalink(); ?>">
                                                <button class="ih-btn btn2">More Info<svg class="arrow-r" xmlns="http://www.w3.org/2000/svg" viewBox="11067.266 447.763 12.149 21.415">
                                                  <defs>
                                                    <style>.arrow-r{fill:transparent;stroke:#fff;stroke-width:2px;}</style>
                                                  </defs>
                                                  <path d="M0-.5l9.167-10L20-.5" transform="translate(11067.5 448.5) rotate(90)"></path>
                                                </svg>
                                              </button>
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                        <?php
                              };
                          };
                        ?>
            <div class="clear"></div><button class="ih-btn btn2 addTeam">load more</button>
          </div>


                            <script>
                            	var cTeam = 0, tPagin = 4;
                                jQuery(".addTeam").click(function(){
                                    for ( var i = cTeam; i < cTeam+tPagin; i++ ) {
                                        jQuery(".area-team .row .item:eq("+i+")").removeClass("hide");
                                    }
                                    cTeam += tPagin;
                                    if ( jQuery(".area-team .row .item").length <= cTeam ) jQuery(".addTeam").remove();
                                }).click();
                          </script>



  </section>




<?php get_footer(); ?>
