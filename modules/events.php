<?php
# Template Name: Events Module
# Template Post Type: modules

function moduleEvents($id) {

	switch ( get_field('show', $id) ) {
		case 'past' :
			$show = 'past';
			break;
		case 'upcoming' :
			$show = 'upcoming';
			break;
		default:
			$show = 'custom';
	}

	$events = tribe_get_events ([
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_key' => '_EventStartDate',
		'eventDisplay' => $show,
		'suppress_filters' => false
	]);

	if($show == 'past')
		$events = array_reverse($events);

	$events_per_months = [];
	foreach ( $events as $event ) {
		$start = date_create(get_post_meta($event->ID,'_EventStartDate',true));
		$end = date_create(get_post_meta($event->ID,'_EventEndDate',true));


		$events_per_months[ (int)date_format( $start, 'Ym' ) ][] = [
			'label' => date_format( $start, 'F Y' ),
			'title' => $event->post_title,
			'desc' => $event->post_excerpt,
			'img' => get_the_post_thumbnail_url($event->ID,'large'),
			'date' => getDateSF( $start,  $end),
			'link' => get_permalink($event->ID)
		];
	}

	set_query_var('events_per_months', $events_per_months);
	set_query_var('module_id', $id);
	set_query_var('show', $show);

	ob_start();
	get_template_part('templates/event-calendar');

	return ob_get_clean();

}
