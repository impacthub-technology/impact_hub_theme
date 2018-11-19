<?php
# Template Name: Events Module
# Template Post Type: modules

function moduleEvents($id) {

	$pal = ( palette ) ? 1 : 3;
	$palBtn = ( palette ) ? 1 : '4 btn3';

	$count = get_field('events_count',$id);
	$events = [];
	switch ( get_field('show',$id) ) {
		case 'past' : $show = 'past'; break;
		case 'upcoming' : $show = 'upcoming'; break;
		default: $show = 'custom';
	}
	$event = tribe_get_events ([ 'post_type' => 'tribe_events', 'orderby' => 'meta_value', 'order' => 'ASC', 'meta_key' => '_EventStartDate', 'eventDisplay' => $show, 'suppress_filters' => false ]);

	foreach ( $event as $key ) {
		$start = date_create(get_post_meta($key->ID,'_EventStartDate',true));

		$date = getDateSF( get_post_meta($key->ID,'_EventStartDate',true), get_post_meta($key->ID,'_EventEndDate',true) );

		$events[ (int)date_format( $start, 'Ym' ) ][] = [
			'label' => date_format( $start, 'F Y' ),
			'title' => $key->post_title,
			'desc' => $key->post_excerpt,
			'img' => get_the_post_thumbnail_url($key->ID,'large'),
			'date' => $date,
			'link' => get_permalink($key->ID)
		];
	}

	$event = '';
	foreach ( $events as $key ) {
		$event .= '<div class="item"><div class="month">'. $key[0]['label'] .'</div>';

		$i = 0;
		foreach ( $key as $item ) {

			$i++;
			$cl = ( $count >= $i ) ? 'true' : '';
			$event .= '<div class="col-md-12 '.$cl.'">
				<div class="v-mid">
					<div class="vc-mid">
						<div class="data">
							<div class="name"><a href="'. $item['link'] .'">'. $item['title'] .'<div class="bg1'.$pal.'"></div></a></div>			
							'. $item['desc'] .'		
							<div class="meta">'. $item['date'] .'</div>
							<a href="'. $item['link'] .'"><button class="ih-btn btn'.$pal.'">view'. arrowR .'</button></a>		
						</div>
					</div>
					<div class="vc-mid img" style="background-image:url('. $item['img'] .')"></div>
				</div>
				<div style= padding-top:20px;></div>
			</div>';

		}

		if ( $i > $count ) $event .= '<p class="clear"><button class="showEvent ih-btn bg5 bgc'.$palBtn.'">load more</button></p>';
		$event .= '</div>';

	}

	return '
    <div class="mdls area-events bg'.$pal[2].'">
   		<div class="container">
            <div class="row">
        		<div class="slider-'. $id .' owl-carousel">'. $event .'</div>
        	</div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function(){
            jQuery(".slider-'. $id .'").owlCarousel({
            	nav: true,
            	navText: [ "", "" ],
	            items: 1,
	            mouseDrag: false,
	            pullDrag: false,
	            touchDrag: false
            });
        });
    </script>
    ';

}
