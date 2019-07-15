<?php get_header(); ?>

<?php while ( have_posts() ) { the_post(); ?>
    <?php

	$pal = ( palette ) ? 1 : 3;

	$id = get_the_ID();
	$venue = get_post_meta($id,'_EventVenueID',true);
	$start =  date_format( date_create(get_post_meta($id,'_EventStartDate',true)), 'M jS' );
	$end = date_format( date_create(get_post_meta($id,'_EventEndDate',true)), 'M jS' );
	$date = ( $start == $end ) ? $start : $start .' - '. $end;
	$loc = get_post($venue)->post_title;
	$url = get_post_meta($id,'_EventURL',true);
	if ( $url != '' ) {
	    $_url = explode('//',$url);
		$_url = ( isset($_url[1]) ) ? $_url[1] : $_url[0];
        $url = '<a href="'. $url .'">'. $_url .'</a>';
    }

    $table = [
        __('Date','impact-hub-theme') => $date,
	    __('Time','impact-hub-theme') => date_format( date_create(get_post_meta($id,'_EventStartDate',true)), 'G:i' ) . ' - ' . date_format( date_create(get_post_meta($id,'_EventEndDate',true)), 'G:i' ),
        __('Location','impact-hub-theme') => $loc,
    ];

	if(get_field('register') != null)
	    $table[__('Register','impact-hub-theme')] = '<a href="' . get_field('register') . '">' . __('Register','impact-hub-theme') . '</a>';

	$price = tribe_get_cost($id,true);
	if($price == null)
	    $price = __('Free', 'impact-hub-theme');

    ?>
	<div class="area-event">
		<a href="<?= PAGE_EVENTS; ?>"><?php svg('arrow-l'); ?></a>
		<div class="container">
			<div class="icon" style="background-image:url(<?= get_the_post_thumbnail_url(); ?>)"></div>
			<h2 class="title bgc<?= $pal; ?>"><?php the_title(); ?><div class="bg<?= $pal; ?>"></div></h2>
            <div class="row">
                <div class="col-md-6 text-left"><?php the_content(); ?></div>
                <div class="col-md-6 tbl">
                    <?php foreach ( $table as $key => $val ) { ?>
                        <div class="col-xs-4 col-sm-3">
                            <div class="v-mid">
                                <div class="vc-mid bg<?= $pal; ?>"><?= $key; ?></div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-9">
                            <div class="v-mid">
                                <div class="vc-mid"><?= $val; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="price bgc<?= $pal; ?>">
                        <div class="v-mid">
                            <div class="vc-mid"><?= __('Entry fee','impact-hub-theme') ?> <?= $price ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php dynamic_sidebar('event_footer'); ?>
            <?= $url; ?>
		</div>
	</div>

    <div class="area-events bg<?= $pal; ?>">
        <h2 class="title"><?= __('See other Events','impact-hub-theme') ?><div class="bg4"></div></h2>
        <div class="container"><div class="events"><div></div></div></div>
        <p class="clear">
            <button class="addEvent ih-btn btn5"><?= __('load more','impact-hub-theme') ?></button>
            <i class="glyphicon glyphicon-refresh gi-animate"></i>
        </p>
    </div>

	<style>
		.area-event h5, .area-event a {color:<?= ( palette ) ? bg1 : bg3; ?>}
		.area-event .arrow-l {stroke:<?= ( palette ) ? bg1 : bg3; ?>!important}
	</style>

    <script>
        events = ["<?= get_post_meta($id,'_EventStartDate',true); ?>",0];
        jQuery(document).ready(function(){jQuery('.addEvent').click()});
    </script>

<?php } ?>

<?php get_footer(); ?>
