<?php
get_header();
$get = htmlspecialchars($_GET['s']);

$pal = ( palette ) ? 1 : 3;

$search_posts = (new WP_Query())->query('post_type=post&nopaging=true&suppress_filters=0&s='. $get);
#$search_pages = (new WP_Query())->query('post_type=page&nopaging=true&s='. $get);
$search_event = (new WP_Query())->query('post_type=tribe_events&nopaging=true&suppress_filters=0&s='. $get);
?>


<?php if ( count($search_posts) > 0 ) { ?>
<div class="mdls area-stories search bg1">
	<div class="container">
        <div class="title">Blog Posts<div class="bg2"></div></div>
		<div class="row">
			<?php
			foreach ( $search_posts as $key ) {
			    if ( strripos($key->post_title, $get) === false and strripos($key->post_content, $get) === false ) continue;
				echo '<div class="col-md-6">
					<div class="img" style="background-image:url('. get_the_post_thumbnail_url($key->ID,'full') .')"></div>
					<div class="data">
						<div class="name">'. $key->post_title .'<div class="bg1"></div></div>			
						'. $key->post_excerpt .'		
						<div class="meta bgc2">'. get_the_date( 'd/m/Y', $key ) .' - '. get_the_author_meta('display_name',$key->post_author) .'</div>
						<a href="'. get_permalink($key->ID) .'"><button class="ih-btn btn2">view'. arrowR .'</button></a>		
					</div>
		        </div>';
			}
			?>
		</div>
	</div>
</div>
<?php } ?>


<?php if ( count($search_event) > 0 ) { ?>
    <div class="mdls area-events bg3">
        <div class="container">
            <div class="title">Events<div class="bg4"></div></div>
            <div class="row">
                <div></div>
				<?php
				foreach ( $search_event as $key ) {
					if ( strripos($key->post_title, $get) === false and strripos($key->post_content, $get) === false ) continue;

					$date = getDateSF( get_post_meta($key->ID,'_EventStartDate',true), get_post_meta($key->ID,'_EventEndDate',true) );
					echo '<div class="col-md-6">
                        <div class="v-mid">
                            <div class="vc-mid">
                                <div class="data">
                                    <div class="name">'. $key->post_title .'<div class="bg'.$pal.'"></div></div>			
                                    '. $key->post_excerpt .'		
                                    <div class="meta bgc'.$pal.'">'. $date .'</div>
                                    <a href="'. get_permalink($key->ID) .'"><button class="ih-btn btn4">view'. arrowR .'</button></a>		
                                </div>
                            </div>
                            <div class="vc-mid img" style="background-image:url('. get_the_post_thumbnail_url($key->ID,'large') .')"></div>
                        </div>
                    </div>';
				}
				?>
            </div>
        </div>
    </div>
<?php } ?>


<?php if ( count($search_posts) + count($search_event) < 1 ) { ?>
<div class="mdls area-stories bg3">
    <div class="container">
        <p>You are searching for "<?= $get; ?>"</p>
        <h2>Nothing Found</h2>
    </div>
</div>
<?php } ?>

<?php get_footer(); ?>